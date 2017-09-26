FROM php:7.0-fpm
RUN  apt-get update &&  apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libmcrypt-dev \
		libpng12-dev \
		libxml2-dev \
	&& docker-php-ext-install -j$(nproc) iconv mcrypt \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd \
  && docker-php-ext-install pdo_mysql mbstring xml  json pdo mysqli mcrypt  \
  && rm -rf /var/lib/apt/lists/*
COPY ./config/php.ini /usr/local/etc/php/conf.d/
