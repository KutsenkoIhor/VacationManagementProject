## Install composer packages

```sh
$ cd laravel-socialite
$ composer install
```

## Create and setup .env file

- #### make a copy of .env.example and rename to .env command:
```sh
$ copy .env.example .env
$ php artisan key:generate
```
- #### put database credentials in .env file

## Installation

- #### For deploying the project you can use [Docker](https://www.docker.com/) command:
```sh
docker-compose up -d
```

- #### After that, open the Main Page by navigating to your server address:
```sh
127.0.0.1:80
```
## Unit Tests

- #### To run tests you can run docker commands for test environment:
```sh
docker-compose -f docker-compose-test.yml up
```
```sh
 docker-compose -f docker-compose-test.yml exec app-test bash
```
```sh 
 vendor/bin/phpunit
```
