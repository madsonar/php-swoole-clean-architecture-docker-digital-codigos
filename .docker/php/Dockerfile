FROM php:8.2.11-cli

# Argumentos para o nome do usuário, UID e GID
ARG USER
ARG UID
ARG GID

# Add user and permissions
RUN groupadd -g ${GID} ${USER}
RUN useradd -u ${UID} -g ${GID} -m -d /home/${USER} -s /bin/bash ${USER}

RUN    chown -R ${USER}:${USER} /var/www

# Atualizar a lista de pacotes e instalar as dependências necessárias
RUN apt-get update && apt-get install -y
RUN apt-get install -y autoconf
RUN apt-get install -y bison
RUN apt-get install -y curl
RUN apt-get install -y gcc
RUN apt-get install -y git
RUN apt-get install -y libbz2-dev
RUN apt-get install -y libcurl4-openssl-dev
RUN apt-get install -y libpq-dev
RUN apt-get install -y libicu-dev
RUN apt-get install -y libjpeg-dev
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libonig-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libreadline-dev
RUN apt-get install -y libssl-dev
RUN apt-get install -y libtidy-dev
RUN apt-get install -y libxml2
RUN apt-get install -y libxml2-dev
RUN apt-get install -y libxslt1-dev
RUN apt-get install -y libzip-dev
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y make
RUN apt-get install -y openssl
RUN apt-get install -y re2c
RUN apt-get install -y unzip
RUN apt-get install -y wget
RUN apt-get clean \
 && rm -rf /var/lib/apt/lists/*

# Copiar php.ini-development ou php.ini-production para php.ini
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
# RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# Instalar extensões PHP,
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_pgsql

# Instalar a extensão openswoole via PECL e habilitar
RUN pecl install openswoole-22.0.0 && docker-php-ext-enable openswoole

# Criar o arquivo xdebug.ini
# RUN touch /usr/local/etc/php/xdebug.ini-base

# Setando valores XDebug
# RUN   echo "zend_extension=xdebug.so" >> /usr/local/etc/php/xdebug.ini-base && \
#      echo "xdebug.mode=develop,debug,coverage" >> /usr/local/etc/php/xdebug.ini-base && \
#      echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/xdebug.ini-base && \
#      echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/xdebug.ini-base && \
#      echo "xdebug.client_port=9003" >> /usr/local/etc/php/xdebug.ini-base && \
#      echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/xdebug.ini-base && \
#      echo "xdebug.log=/var/log/xdebug.log" >> /usr/local/etc/php/xdebug.ini-base

#RUN cp /usr/local/etc/php/xdebug.ini-base /usr/local/etc/php/conf.d/xdebug.ini

# Instalar o Xdebug
#RUN pecl install xdebug
#RUN docker-php-ext-enable xdebug

# Instalar Composer
#COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia o script entrypoint.sh para dentro do container
COPY .docker/scripts/entrypoint-ini.sh /usr/local/bin/entrypoint-ini.sh

# Torna o script executável
RUN chmod +x /usr/local/bin/entrypoint-ini.sh

# ENTRYPOINT
ENTRYPOINT ["/usr/local/bin/entrypoint-ini.sh"]
CMD ["php -a"]
USER ${USER}
WORKDIR "/var/www/"