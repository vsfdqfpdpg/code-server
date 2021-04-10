[wsl lemp](https://www.chanhvuong.com/3389/install-lemp-on-ubuntu-wsl-on-windows-10/){ target=_blank }   
[code server](https://bitlaunch.io/blog/how-to-setup-code-server-on-ubuntu-20-04-lts/){ target=_blank }     
[start-stop-daemon](https://man7.org/linux/man-pages/man8/start-stop-daemon.8.html){ target=_blank }    

!!! data "start-stop-daemon"
    === "wsl"
        ``` {.bash data-play="false"}
        # PowerShell (admin)
        Restart-Service LxssManager

        # or CMD (admin)
        net stop LxssManager
        net start LxssManager
        ``` 

    === "code-server"
        ``` {.bash data-play="false"}
        #!/bin/bash

        # sudo touch /etc/init.d/code-server
        # sudo chmod +x /etc/init.d/code-server
        # sudo kill -9 $(pgrep -f 'node /usr/lib/code-server' -l | awk '{print $1}')
        # sudo setcap 'cap_net_bind_service=+ep' /usr/lib/code-server/lib/node

        set -e
        umask 022

        NAME="code server"
        PIDFILE=/var/run/code-server.pid
        LOGFILE=/var/log/code-server.log
        DAEMON=/usr/bin/code-server
        DAEMON_OPTS="--user-data-dir /home/fumei/.local/share/code-server --config /home/fumei/.config/code-server/config.yaml"
        DAEMON_USER=root

        . /lib/lsb/init-functions

        is_running(){
        [ -f "$PIDFILE" ] && ps -p `cat $PIDFILE` > /dev/null 2>&1
        }

        function start() {
        if is_running; then
            log_daemon_msg "code server already running."
        else
            log_daemon_msg "Starting code server"
            start-stop-daemon -SCqbm --chuid $DAEMON_USER --pidfile $PIDFILE --exec $DAEMON -- $DAEMON_OPTS >> $LOGFILE 2>&1
        fi
        }

        function stop() {
        log_daemon_msg "Stop code server"
        start-stop-daemon -Kqo --remove-pidfile --pidfile $PIDFILE
        }

        function status(){
        status_of_proc -p $PIDFILE $DAEMON $NAME && exit 0 || exit $?
        }

        case "$1" in 
        start)
            start
            case "$?" in
                0|1) log_end_msg 0 ;;
                2)   log_end_msg 1 ;;
            esac
            ;;
        stop)
            stop
            case "$?" in
                0|1) log_end_msg 0 ;;
                2)   log_end_msg 1 ;;
            esac
            ;;
        restart)
            stop
            start
            ;;
        status)
            status
            ;;
        *)
            log_action_msg "Usage: $0 {start|stop|status|restart}" || true
        esac

        exit 0 

        ```

    === "mkdocs"
        ``` {.bash data-play="false"}
        #!/bin/bash

        # sudo touch /etc/init.d/mkdocs
        # sudo chmod +x /etc/init.d/mkdocs

        # sudo kill -9 $(pgrep -l mkdocs | awk '{print $1}')
        # cat /var/run/mkdocs.pid

        set -e
        umask 022

        NAME=mkdocs
        PIDFILE=/var/run/mkdocs.pid
        LOGFILE=/var/log/mkdocs.log
        DAEMON=/usr/bin/python3
        DAEMON_OPTS="-m mkdocs serve"
        DAEMON_USER=fumei

        dir="/home/fumei/code-server/docs/languages"

        . /lib/lsb/init-functions

        check_port () {
        /mnt/c/Windows/System32/netstat.exe -ano -p tcp | grep "LISTENING" | grep $1 | awk '{print $5}'
        }

        is_running(){
        [ -f "$PIDFILE" ] && ps -p `cat $PIDFILE` > /dev/null 2>&1
        }

        function start() {
        if is_running; then
            log_daemon_msg "mkdocs server already running."
        else
            log_daemon_msg "Starting mkdocs server"
            start-stop-daemon -SCqbm --chuid $DAEMON_USER --chdir $dir --pidfile $PIDFILE --exec $DAEMON -- $DAEMON_OPTS >> $LOGFILE 2>&1
        fi
        }

        function stop() {
        log_daemon_msg "Stop mkdocs server"
        start-stop-daemon -Kqo --remove-pidfile --pidfile $PIDFILE
        }

        function status(){
        status_of_proc -p $PIDFILE $DAEMON $NAME && exit 0 || exit $?
        }

        case "$1" in 
            start)
            start
            case "$?" in
                    0|1) log_end_msg 0 ;;
                    2)   log_end_msg 1 ;;
                esac
            ;;
            stop)
            stop
            case "$?" in
                    0|1) log_end_msg 0 ;;
                    2)   log_end_msg 1 ;;
                esac
            ;;
            restart)
            stop
            start
            ;;
            status)
            status
            ;;
            *)
            log_action_msg "Usage: $0 {start|stop|status|restart}" || true
        esac

        exit 0
        ```

    === "init.wsl"
        ``` {.bash data-play="false"}
        #! /bin/sh
        /etc/init.d/cron $1
        /etc/init.d/ssh $1
        /etc/init.d/code-server $1
        /etc/init.d/mkdocs $1
        /etc/init.d/nginx $1
        /etc/init.d/php8.0-fpm $1
        ```

    === "mkdocs-api.conf"
        ``` {.nginx data-play="false"}
        server {
            listen 5000;
        
            server_name _;
            root /home/fumei/code-server/docs/api;
            index index.php index.html index.htm index.nginx-debian.html;

            location / {                 

                    if ($request_method = 'OPTIONS') {
                            add_header 'Access-Control-Allow-Origin' '*';
                            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
                            add_header 'Access-Control-Allow-Headers' 'Origin, X-Requested-With, Content-Type, Accept, Authorization';
                            add_header 'Content-Type' 'text/plain; charset=utf-8';
                            add_header 'Content-Length' 0;
                            return 204;
                    }
                    if ($request_method = 'POST') {
                            add_header 'Access-Control-Allow-Origin' '*';
                            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
                            add_header 'Access-Control-Allow-Headers' 'Origin, X-Requested-With, Content-Type, Accept, Authorization';
                            add_header 'Access-Control-Expose-Headers' 'Content-Length,Content-Range';
                    }
                    if ($request_method = 'GET') {
                            add_header 'Access-Control-Allow-Origin' '*';
                            add_header 'Access-Control-Allow-Methods' 'GET, POST, OPTIONS';
                            add_header 'Access-Control-Allow-Headers' 'Origin, X-Requested-With, Content-Type, Accept, Authorization';
                            add_header 'Access-Control-Expose-Headers' 'Content-Length,Content-Range';
                    }

                try_files $uri $uri/ /index.php?$args =404;      

            } 

            location ~ \.php$ {
            
                    include snippets/fastcgi-php.conf;

                    # Make sure unix socket path matches PHP-FPM configured path above
                    fastcgi_pass unix:/run/php/php8.0-fpm.sock;

                    # Prevent ERR_INCOMPLETE_CHUNKED_ENCODING when browser hangs on response
                    fastcgi_buffering off;
            }
        }

        ```

    === "wsl_start.vbe"
        ``` {.shell data-play="false"}
        ' shell:startup
        Set ws = WScript.CreateObject("WScript.Shell")
        ws.run "wsl -u root sudo /etc/init.wsl start", vbhide
        Set ws = Nothing
        WScript.quit
        ```