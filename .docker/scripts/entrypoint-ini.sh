#!/bin/sh

# Verifica se /usr/local/etc/php/php.ini existe, se não, copia php.ini-development para php.ini
##if [ ! -f /usr/local/etc/php/php.ini ]; then
##    cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
##fi

# Verifica se /usr/local/etc/php/conf.d/xdebug.ini existe, se não, copia xdebug.ini-base para conf.d/xdebug.ini
##if [ ! -f /usr/local/etc/php/conf.d/xdebug.ini ]; then
##    cp /usr/local/etc/php/xdebug.ini-base /usr/local/etc/php/conf.d/xdebug.ini
##fi

# Executa composer install para instalar as dependências do PHP
echo ">>>composer install"
composer install

# Executa o comando passado como argumento para este script
exec "$@"
