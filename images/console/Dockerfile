FROM php:7.0-fpm
RUN  apt-get update &&  apt-get install -y libfreetype6-dev git  curl zip \
  && docker-php-ext-install  zip \
  && docker-php-ext-enable zip  \
  && rm -rf /var/lib/apt/lists/*
RUN  git config   --global  user.name "cailei" \
&&  git config  --global user.email "1215850394@qq.com"
