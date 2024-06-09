# Install guide

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Installation

1. **Clone the repository**

   ```bash
   git clone https://gitlab.com/paaneko/internet-shop.git
   
   cd internet-shop

   cp .env.example .env

2. **Run**

- if you don't have installed composer:
   ```bash
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
- if you have installed composer:
    ```bash
    composer install

3. **Run container**

    ```bash
   ./vendor/bin/sail up -d

4. **Set up environment**

    ```bash
    ./vendor/bin/sail artisan key:generate
    ./vendor/bin/sail artisan migrate:fresh --seed
    ./vendor/bin/sail artisan storage:link

5. **Set up npm**
    ```bash
    ./vendor/bin/sail npm install
    ./vendor/bin/sail npm run dev
