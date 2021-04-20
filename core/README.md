# ouredu-boilerplate


## To Run the project

- docker network create pub_sub_network `docker network create pub_sub_network`
- Copy the .env.local to .env
- `docker-compose up -d` you may need to use `sudo`
- `docker-compose exec kafka_php sh` you may need to use `sudo`
- `composer install`
- `php artisan migrate`
- `php artisan kafka:consume` make sure you are subscribing to the wanted topic in the consumeCommand file

### browse [http://localhost:8787](http://localhost:8787) for the app