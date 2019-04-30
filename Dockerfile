FROM php:7.2-apache

ARG MONGODB_URL
ENV MONGODB_URL ${MONGODB_URL}

ARG OAUTH_DISCORD_CLIENT_ID
ENV OAUTH_DISCORD_CLIENT_ID ${OAUTH_DISCORD_CLIENT_ID}

ARG OAUTH_DISCORD_CLIENT_SECRET
ENV OAUTH_DISCORD_CLIENT_SECRET ${OAUTH_DISCORD_CLIENT_SECRET}

ARG MAILER_URL
ENV MAILER_URL ${MAILER_URL}

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"

RUN apt update && apt install util-linux zip libpng-dev git mongodb autoconf libssl-dev -y && \
    docker-php-ext-install pcntl mysqli pdo gd zip

RUN pecl install mongodb

RUN docker-php-ext-enable mongodb

COPY . /var/www/html/

RUN cd /var/www/html/ && \
    cp .env.prod .env && \
    ./composer.phar install

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e 's!ErrorLog!#ErrorLog!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!CustomLog!#CustomLog!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!ErrorLog!#ErrorLog!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e 's!CustomLog!#CustomLog!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN chown -R www-data:www-data /var/www

RUN a2enmod rewrite && a2ensite default-ssl

EXPOSE 80/tcp
EXPOSE 443/tcp

CMD apachectl -D FOREGROUND
