from alpine:3.7

MAINTAINER ahmad ardiansyah "<ahmad.ardiansyah@carsworld.id>"

ENV TIMEZONE="Asia/Jakarta"

RUN set -x \
    && apk add --update --no-cache wget ca-certificates \
    openrc nginx dcron tzdata && \
    
    #add repository php7.0, sebaiknya pake php7.2 https://symfony.fi/entry/php-7-1-vs-7-2-benchmarks-with-docker-and-symfony-flex
    wget -O /etc/apk/keys/phpearth.rsa.pub https://repos.php.earth/alpine/phpearth.rsa.pub && \
    echo "https://repos.php.earth/alpine/v3.7" >> /etc/apk/repositories && apk update && \
    
    #default install php library
    apk add --update --no-cache \
    php7.2-fpm \
    php7.2-xml \
    php7.2-simplexml \
    php7.2-iconv \
    php7.2-bz2 \
    php7.2-curl \
    php7.2-mcrypt \
    php7.2-json \
    php7.2-openssl \
    php7.2-pdo \
    php7.2-intl \
    php7.2-pdo_mysql \
    php7.2-mysqlnd \
    php7.2-mysqli \
    php7.2-mbstring \
    php7.2-opcache \
    php7.2-memcached \
    php7.2-ctype \
    php7.2-bcmath \
    php7.2-zip \
    php7.2-zlib \
    php7.2-dom \
    php7.2-gd \
    php7.2-phar \
    php7.2-tokenizer \
    php7.2-xmlreader \
    php7.2-xmlwriter \
    php7.2-xdebug \
    php7.2-redis \
    php7.2-fileinfo \
    php7.2-pgsql \
    php7.2-pdo_pgsql \
    openssh-server \
    supervisor \
    git \
    curl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

#custome php and other template config
RUN sed -i -e "s/;\?listen\s*=\s*.*/listen = 127.0.0.1:9000/g" /etc/php/7.2/php-fpm.d/www.conf && \
    sed -i -e "s/;\?pid\s*=\s*.*/pid = \/run\/php-fpm7.2\/php-fpm7.2.pid/g" /etc/php/7.2/php-fpm.conf && \
    sed -i -e "s/;\?upload_max_filesize\s*=\s*.*/upload_max_filesize = 30M/g" /etc/php/7.2/php.ini && \
    sed -i -e "s/;\?post_max_size\s*=\s*.*/post_max_size = 250M/g" /etc/php/7.2/php.ini && \
    sed -i -e "s/;\?memory_limit\s*=\s*.*/memory_limit = 300M/g" /etc/php/7.2/php.ini && \
    sed -i -e "s/;\?max_execution_time\s*=\s*.*/max_execution_time = 60/g" /etc/php/7.2/php.ini && \
    sed -i -e "s/;session.save_path/session.save_path/g" /etc/php/7.2/php.ini 

RUN s="/var/www:/sbin/nologin" && \
    r="/opt/www:/bin/sh" && \
    sed -i -e "s~$s~$r~g" /etc/passwd

#WORKDIR /etc
#RUN mkdir supervisor.d
#COPY api-worker.ini supervisor.d/

#edit user defautl
WORKDIR /etc/nginx
RUN sed -i -e "s/user nginx;/user www-data;/g" nginx.conf && rm conf.d/default.conf 

#copy file to docker
COPY default.conf conf.d/default.conf

#running service @booting process
RUN rc-update add dcron default && \
    rc-update add nginx default && \
    rc-update add sshd default && \
    rc-update add supervisord default && \
    rc-update add php-fpm7.2 default && \

    echo 'null::respawn:/sbin/syslogd -n -S -D -O /proc/1/fd/1' >> /etc/inittab && \
    rm -fr /var/cache/apk/* \
    # Disable getty's
    && sed -i 's/^\(tty\d\:\:\)/#\1/g' /etc/inittab \
    && sed -i \
        # Change subsystem type to "docker"
        -e 's/#rc_sys=".*"/rc_sys="docker"/g' \
        # Allow all variables through
        -e 's/#rc_env_allow=".*"/rc_env_allow="\*"/g' \
        # Start crashed services
        -e 's/#rc_crashed_stop=.*/rc_crashed_stop=NO/g' \
        -e 's/#rc_crashed_start=.*/rc_crashed_start=YES/g' \
        # Define extra dependencies for services
        -e 's/#rc_provide=".*"/rc_provide="loopback net"/g' \
        /etc/rc.conf \
    # Remove unnecessary services
    && rm -f /etc/init.d/hwdrivers \
            /etc/init.d/hwclock \
            /etc/init.d/hwdrivers \
            /etc/init.d/modules \
            /etc/init.d/modules-load \
            /etc/init.d/modloop \
    # Can't do cgroups
    && sed -i 's/cgroup_add_service /# cgroup_add_service /g' /lib/rc/sh/openrc-run.sh \
    && sed -i 's/VSERVER/DOCKER/Ig' /lib/rc/sh/init.sh

RUN rm -rf /etc/localtime \
    && ln -s /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    && sed -i "s|;*date.timezone =.*|date.timezone = ${TIMEZONE}|i" /etc/php/7.2/php.ini

#change permission
RUN mkdir -p /opt/www && chown -R www-data:www-data /opt

WORKDIR /opt/www

COPY . .
RUN cek=`find . -name composer.json` && \
    if [ -z $cek ];then echo "can't find composer json";else `composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader`;fi && chmod 777 -R storage bootstrap && chown -R www-data:www-data /var/tmp && \
    chown -R www-data:www-data /opt && echo -e "cyberlink\ncyberlink" | passwd www-data

ARG app_env

COPY $app_env .env

CMD ["/sbin/init"]

#remove hashtag if you want binding port to host
EXPOSE 80 
