# URL Shortener

A Simple URL Shortener app using Symfony and React.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

* Docker

### Installing
1. Build and run docker
 ```
 docker-compose up -d --build
 ```
2. Open bash from php container and install composer packages
```
docker-compose exec php /bin/bash

composer install
```
3. Copy .env to .env.local
```
cp .env .env.local
```
4. Run migrations
```
php bin/console doctrine:migrations:migrate

php bin/console doctrine:migrations:migrate (Update(quick fix): Please run this command again to migrate LinkVisit table)
```
5. Install yarn packages and compile assets
```
yarn install

yarn encore dev
```

## Running the app
Visit ```http://localhost:8080```


