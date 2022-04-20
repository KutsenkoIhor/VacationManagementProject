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
