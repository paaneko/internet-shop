init: build up copy-env gen-key migrate storage-link npm-install npm-run

build:
	docker run --rm \
         -u "$$(id -u):$$(id -g)" \
         -v "$$(pwd):/var/www/html" \
         -w /var/www/html \
         laravelsail/php82-composer:latest \
         composer install --ignore-platform-reqs

up:
	./vendor/bin/sail up -d

gen-key:
	./vendor/bin/sail artisan key:generate

migrate:
	./vendor/bin/sail artisan migrate:fresh --seed

storage-link:
	./vendor/bin/sail artisan storage:link

copy-env:
	cp .env.example .env

npm-install:
	./vendor/bin/sail npm install

npm-run:
	./vendor/bin/sail npm run dev
