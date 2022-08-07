FROM php:8.1-apache

# 依存解決用のツール (コミュニティサポート)
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# Install PHP extentions.
# install-php-extensions is used resolve dependencies required for PHP extention installation
RUN apt-get update && \
    apt-get install -y \
        git && \
    install-php-extensions \
        gd \
        mbstring \
        pdo_mysql \
        xdebug \
        zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*


# Enabling Apache mod_rewrite
# RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled \
#   && /bin/sh -c a2enmod rewrite
RUN ln --symbolic /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load && \
    /bin/sh -c a2enmod rewrite

# Setting up Document Root
COPY ./services/app/apache2.conf /etc/apache2/apache2.conf
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy composer executable binary from Composer official image
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN mkdir -m 777 var
COPY ./src/composer* /var/www/html
RUN composer install --no-scripts

COPY src/ ./
