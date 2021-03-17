FROM codercom/code-server:latest

SHELL ["/bin/bash", "-c"]

ARG SPRING_BOOT_CLI_URL=https://repo.spring.io/release/org/springframework/boot/spring-boot-cli/2.3.6.RELEASE/spring-boot-cli-2.3.6.RELEASE-bin.tar.gz
ARG GO_GOOGLE_URL=https://dl.google.com/go/go1.15.4.linux-amd64.tar.gz
ARG GO_URL=https://studygolang.com/dl/golang/go1.15.4.linux-amd64.tar.gz
ARG NODE_URL=https://deb.nodesource.com/setup_14.x
ARG PHP_VERSION=7.4
ARG PYTHON_VERSION=3.7
ARG PHPUNIT_URL=https://phar.phpunit.de/phpunit-9.phar
ARG HOME=/home/coder
ARG GEOLITE2_COUNTRY=https://download.maxmind.com/app/geoip_download?edition_id=GeoLite2-Country&license_key=vP65qsGQCxfewnTs&suffix=tar.gz
ARG GEOLITE2_CITY=https://download.maxmind.com/app/geoip_download?edition_id=GeoLite2-City&license_key=vP65qsGQCxfewnTs&suffix=tar.gz

# Set environment variables
ENV WORKON_HOME=$HOME/Envs GOROOT=/usr/local/go GOPATH=$HOME/go GOPROXY=https://goproxy.io GO111MODULE=on \
    PATH=$PATH:$HOME/go/bin:/usr/local/go/bin:$HOME/.rbenv/bin:$HOME/.rbenv/plugins/ruby-build/bin:$HOME/.composer/vendor/bin:$HOME/.local/bin:$HOME/.rbenv/shims:$HOME/.config/composer/vendor/bin \
    VIRTUALENVWRAPPER_PYTHON=/usr/bin/python3

RUN sudo apt-get update && sudo apt-get install -y \
    apt-utils wget git curl unzip zip sqlite3 \
    && sudo rm -rf /var/lib/apt/lists/*

# Setup repository mirror
RUN sudo mv /etc/apt/sources.list /etc/apt/sources.list.back && \
    echo -e '\n\
deb https://mirrors.tuna.tsinghua.edu.cn/debian/ buster main contrib non-free \n\
deb https://mirrors.tuna.tsinghua.edu.cn/debian/ buster-updates main contrib non-free \n\
deb https://mirrors.tuna.tsinghua.edu.cn/debian/ buster-backports main contrib non-free \n\
deb https://mirrors.tuna.tsinghua.edu.cn/debian-security buster/updates main contrib non-free \n\
' | sudo tee /etc/apt/sources.list

# Install java and javac
RUN sudo apt-get update && sudo apt-get install -y \
    default-jre default-jdk \
    && sudo rm -rf /var/lib/apt/lists/*

# Install spring cli tool
RUN wget -q -O spring-boot-cli.tar.gz ${SPRING_BOOT_CLI_URL} && \
    sudo mkdir /usr/local/share/spring && sudo tar -xzvf spring-boot-cli.tar.gz -C /usr/local/share/spring  --strip 1 && \
    sudo ln -s /usr/local/share/spring/bin/spring /usr/local/bin/spring && \
    rm spring-boot-cli.tar.gz

# Install java sdk manager
RUN curl -s "https://get.sdkman.io" | bash

# Install gradle
RUN sdk install gradle

# Install some tools
RUN sudo apt-get update && sudo apt-get install -y \
    gnupg2 ca-certificates apt-transport-https \
    jq rsync supervisor re2c \
    geoip-bin geoip-database lua5.3 \
    && sudo rm -rf /var/lib/apt/lists/*

# Install Geoip database
RUN curl ${GEOLITE2_COUNTRY} -o GeoLite2-Country.tar.gz && \
    tar -xzvf GeoLite2-Country.tar.gz &&\
    sudo mkdir -p /usr/share/GeoIP/ && \
    sudo mv GeoLite2-Country_*/GeoLite2-Country.mmdb /usr/share/GeoIP/GeoLite2-Country.mmdb && \
    rm GeoLite2-Country.tar.gz && rm -rf GeoLite2-Country_*

RUN wget -q https://packages.sury.org/php/apt.gpg -O- | sudo APT_KEY_DONT_WARN_ON_DANGEROUS_USAGE=1 apt-key add - && \
    echo "deb https://packages.sury.org/php/ buster main" | sudo tee /etc/apt/sources.list.d/php.list

# Install build tools
RUN sudo apt-get update && sudo apt-get install -y \
    libssl-dev libreadline-dev zlib1g-dev \
    autoconf bison build-essential libyaml-dev \
    libreadline-dev libncurses5-dev libffi-dev libgdbm-dev \
    && sudo rm -rf /var/lib/apt/lists/*

# Setup node repo
RUN curl -sL ${NODE_URL} -o nodesource_setup.sh && sudo bash nodesource_setup.sh \
    && rm nodesource_setup.sh

RUN sudo apt-get update && sudo apt-get install -y \
    maven nodejs nginx libnginx-mod-http-lua libnginx-mod-http-geoip libnginx-mod-http-echo \
    python${PYTHON_VERSION} python3-pip \ 
    && sudo rm -rf /var/lib/apt/lists/*

# Install php and some extensions
RUN sudo apt-get update && sudo apt-get install -y \
    php$PHP_VERSION php$PHP_VERSION-cli php$PHP_VERSION-common php$PHP_VERSION-curl php$PHP_VERSION-gd \
    php$PHP_VERSION-json php$PHP_VERSION-mbstring php$PHP_VERSION-mysql php$PHP_VERSION-xml php$PHP_VERSION-zip \
    php$PHP_VERSION-pdo php$PHP_VERSION-dev php$PHP_VERSION-fpm php$PHP_VERSION-xdebug \
    php$PHP_VERSION-dom php$PHP_VERSION-simplexml php$PHP_VERSION-ssh2 php$PHP_VERSION-xmlreader \
    php$PHP_VERSION-exif  php$PHP_VERSION-ftp php$PHP_VERSION-sockets php$PHP_VERSION-sqlite3 php$PHP_VERSION-dev \
    php$PHP_VERSION-pgsql php$PHP_VERSION-soap \
    && sudo rm -rf /var/lib/apt/lists/*

# Install php extension swoole
RUN sudo printf "\n" | sudo pecl install swoole && \
    echo "extension=swoole.so" | sudo tee /etc/php/${PHP_VERSION}/cli/conf.d/30-swoole.ini

# Install php extension zephir 
RUN git clone git://github.com/phalcon/php-zephir-parser.git  && \
    cd php-zephir-parser && \ 
    /usr/bin/phpize && \
    ./configure --with-php-config=/usr/bin/php-config && \
    make && \
    sudo make install && \
    echo "extension=zephir_parser.so" | sudo tee /etc/php/${PHP_VERSION}/cli/conf.d/30-zephir.ini && \
    cd .. && \
    rm -rf php-zephir-parser 

# Install composer
RUN curl -sL -o composer-setup.php https://getcomposer.org/installer && \
    sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer && php -r "unlink('composer-setup.php');" && \
    sudo composer self-update --clean-backups

# RUN composer config -g repo.packagist composer https://packagist.phpcomposer.com
# use aliyun composer
RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ && \
    composer global require consolidation/cgr && \
    cgr laravel/installer && \
    cgr phalcon/zephir && \
    wget -q -O phpunit ${PHPUNIT_URL} && \
    chmod +x phpunit && sudo mv phpunit /usr/local/bin/

# Install golang
RUN wget -q ${GO_URL} \ 
    && tar -xzvf go1.*.linux-amd64.tar.gz && sudo mv go /usr/local/go && sudo mkdir -p ${GOPATH} \
    && mkdir ${HOME}/Envs \
    && rm go1.*.linux-amd64.tar.gz

# Install ruby 2.7.1
RUN git clone https://github.com/rbenv/rbenv.git ~/.rbenv && \ 
    git clone https://github.com/rbenv/ruby-build.git ~/.rbenv/plugins/ruby-build && \
    sed -i s/cache.ruby-lang.org/cache.ruby-china.com/ ~/.rbenv/plugins/ruby-build/share/ruby-build/2.7.1 && \
    sudo ~/.rbenv/plugins/ruby-build/install.sh && \
    rbenv install 2.7.1 && rbenv global 2.7.1 && \
    eval "$(rbenv init -)" && gem sources --add https://gems.ruby-china.com/ --remove https://rubygems.org/ && \ 
    gem install bundler rails solargraph minitest

RUN python3 -m pip install install pip -U && \
    pip3 config set global.index-url https://pypi.tuna.tsinghua.edu.cn/simple && \ 
    python3 -m pip install install django scrapy virtualenvwrapper pylint autopep8 pytest mkdocs mkdocs-material mkdocs-macros-plugin

RUN npm config set registry https://registry.npm.taobao.org
RUN sudo npm install -g nodemon json-server http-server @vue/cli jest

RUN sudo apt-get clean && sudo apt-get remove -y \
        build-essential libssl-dev libreadline-dev \
        zlib1g-dev libyaml-dev libreadline-dev \
        libncurses5-dev libffi-dev libgdbm-dev autoconf bison

# ENV PS1="\u@\h \[\033[32m\]\w\[\033[33m\]\$(git branch 2>/dev/null | grep '^*' | colrm 1 2)\[\033[00m\] \$ "
RUN echo -e '\n\
alias ll="ls -l" \n\
parse_git_branch() { \n\
     git branch 2> /dev/null | sed -e '"'"'/^[^*]/d'"'"' -e '"'"'s/* \(.*\)/ (\1)/'"'"' \n\
} \n\
export PS1="\u@\h \[\033[32m\]\w\[\033[33m\]\$(parse_git_branch)\[\033[00m\] $ " \n\
source /home/coder/.local/bin/virtualenvwrapper.sh \n\
' | sudo tee -a /etc/profile /root/.bashrc /root/.bash_profile /root/.profile $HOME/.bashrc $HOME/.bash_profile $HOME/.profile

WORKDIR /home/coder/project

EXPOSE 3000 80 443 8080 8000 8001 8002 8003 9000 5000 5500 3306

# docker inspect --format='{{range .Config.Env}}{{println .}}{{end}}' vscode
# docker exec -it vscode printenv

# echo exit | strace bash -li |& grep '^open'