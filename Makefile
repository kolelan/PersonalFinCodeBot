init: build docker-down docker-up

build:
	docker-compose build --pull

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans -v

run:
	docker-compose run --rm prod php app dummy

composer:
	docker-compose run --rm cli composer install

composer-dump:
	docker-compose run --rm cli composer dump-autoload

require-nutgram:
	docker-compose run --rm cli composer require nutgram/nutgram

