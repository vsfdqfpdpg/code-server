### 1. Create some directories for docker volumes. 
> $ mkdir code-server\docker_volumes\extensions   
> $ mkdir code-server\docker_volumes\go    
> $ mkdir code-server\docker_volumes\virtualenvs  
> $ mkdir code-server\cert  
> $ touch code-server\config.yaml   
> $ mkdir project

### 2. SSL setup
Install [mkcert](https://github.com/FiloSottile/mkcert)   
Created a new local CA 
> $ mkcert -install   

Created a new certificate valid for the following names   
> $ mkcert localhost 127.0.0.1 ::1 192.168.1.128   

### /home/coder/.config/code-server/config.yaml
```yml
bind-addr: 127.0.0.1:8080
auth: password
cert: /home/coder/.config/code-server/cert/localhost.pem
cert-key: /home/coder/.config/code-server/cert/localhost-key.pem
```

### Setup password
> create a `.env` file and put your password in it.
```env
PASSWORD=your secret password
```
### 3. Install vscode extensions and go modules
```bash
./installation.sh
```

### 4. Installed software.   
PHP |                NODE        |     JAVA       |  PYTHON    
--- | ----------- | -------    | --------------  
[php -v](https://www.php.net/manual/en/langref.php) | [node -v](https://nodejs.org/api/) | [java --version](https://docs.oracle.com/en/java/javase/11/docs/api/index.html) | [python3 -V](https://docs.python.org/3/reference/index.html)   
[composer -V](https://getcomposer.org/doc/04-schema.md#repositories) | [npm -v](https://docs.npmjs.com/packages-and-modules) | [mvn -v](https://maven.apache.org/guides/index.html) | [pip -V](https://packaging.python.org/tutorials/packaging-projects/)   
[laravel -V](https://laravel.com/docs/)  | nodemon -v | javac --version | [python3 -m django --version](https://docs.djangoproject.com/)     
[phpunit --version](https://phpunit.readthedocs.io/) | [json-server -v](https://www.npmjs.com/package/json-server) | [spring --version](https://docs.spring.io/spring-boot/docs/current/reference/html/spring-boot-cli.html#cli-init) | [scrapy version](https://docs.scrapy.org/en/latest/)   
[zephir -V](https://docs.zephir-lang.com/) | [http-server -v](https://www.npmjs.com/package/http-server) | |[virtualenvwrapper](https://virtualenvwrapper.readthedocs.io/en/latest/command_ref.html)    
[pecl version](https://pecl.php.net/packages.php) |||   
pecl config-show |||   
phpize -v |||   

 GOLANG         | RUBY
---------  |  --------
[go version](https://golang.org/ref/spec) |   [ruby -v](https://docs.ruby-lang.org/en/2.7.0/) 
[bee version](https://beego.me/docs/intro/) | [gem -v](https://guides.rubygems.org/command-reference/)
|| [rbenv -v](https://github.com/rbenv/rbenv)
|| [rails -v](https://guides.rubyonrails.org/)
### other software
command|
--- |  
nginx -v |
lua -v |
[sqlite3 --version](https://www.sqlitetutorial.net/) |

### Install geoip for centos
> yum install mod_geoip GeoIP GeoIP-devel GeoIP-data zlib-devel   