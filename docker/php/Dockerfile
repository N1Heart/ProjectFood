# Começa a partir da imagem base que já usávamos
FROM php:8.1-apache

# Instala as extensões PHP necessárias para falar com o MySQL
# pdo_mysql -> É o driver do PDO que estava faltando
# mysqli    -> É o driver do MySQLi (bom ter para o futuro)
RUN docker-php-ext-install pdo_mysql mysqli