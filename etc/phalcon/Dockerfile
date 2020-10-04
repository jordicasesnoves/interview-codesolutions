ARG PHP_VERSION

FROM php:$PHP_VERSION
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ARG PHALCON_VERSION
ARG PSR_VERSION=1.0.0
ARG PHALCON_EXT_PATH=php7/64bits

RUN set -xe && \
        curl -LO https://github.com/jbboehr/php-psr/archive/v${PSR_VERSION}.tar.gz && \
        tar xzf ${PWD}/v${PSR_VERSION}.tar.gz

RUN set -xe && \
        # Compile Phalcon
        curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz && \
        tar xzf ${PWD}/v${PHALCON_VERSION}.tar.gz && \
        docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) \
        ${PWD}/php-psr-${PSR_VERSION} \
        ${PWD}/cphalcon-${PHALCON_VERSION}/build/${PHALCON_EXT_PATH}

RUN apt-get update && \
		apt-get install -y libzip-dev && \ 
        apt-get install -y zlib1g-dev && \ 
        apt-get install -y libpng-dev && \
        apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev && \
        apt-get install -y libicu-dev && \
        apt-get install -y git && \
		apt-get install -y unzip && \
		apt-get install -y nodejs && \
		apt-get install -y npm

RUN docker-php-ext-install zip
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-enable phalcon
	
RUN pecl install -o -f mongodb
RUN docker-php-ext-enable mongodb