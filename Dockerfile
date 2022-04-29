FROM composer:2.3 AS composer

RUN adduser -D -g '' appuser

COPY --chown=appuser:appuser composer.json /app/composer.json
COPY --chown=appuser:appuser composer.lock /app/composer.lock

RUN composer install --prefer-dist --no-interaction --no-scripts --optimize-autoloader --ignore-platform-reqs

FROM php:8.1-fpm-alpine3.15

RUN adduser -D -g '' appuser

WORKDIR /app

USER appuser

COPY --chown=appuser:appuser --from=composer /app/vendor /app/vendor
COPY --chown=appuser:appuser test_runner.sh /app/
COPY --chown=appuser:appuser ./src/ /app/src/
COPY --chown=appuser:appuser ./tests/ /app/tests/
RUN chmod +x /app/test_runner.sh

CMD ./test_runner.sh