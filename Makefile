## Initialize the application
init: composer.phar
	php composer.phar install --no-interaction --optimize-autoloader --prefer-dist

## Installs composer locally
composer.phar:
	curl -sS https://getcomposer.org/installer | php

## Test the application
test: phpcs test-spec

## Run PHP specification tests
test-spec:
	vendor/bin/phpspec run

## Run php code sniffer
phpcs:
	vendor/bin/phpcs --standard=PSR2 ./src

## Fix php syntax with code sniffer
phpcs-fix:
	vendor/bin/phpcbf --standard=PSR2 ./src

## Generate new migration
db-migration-generate:
	vendor/bin/doctrine-migrations migrations:generate --db-configuration=./config/migrations-db.php --configuration=./config/migrations.yml

## Run migrations
db-migrations:
	vendor/bin/doctrine-migrations migrations:migrate -n --db-configuration=./config/migrations-db.php --configuration=./config/migrations.yml

## Cleans the environment
clean:
	-rm -rf vendor/
	-rm composer.phar


