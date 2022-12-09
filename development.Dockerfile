FROM laravelphp/vapor:php74

RUN apk --update add ffmpeg

RUN docker-php-ext-install xmlrpc

COPY . /var/task
