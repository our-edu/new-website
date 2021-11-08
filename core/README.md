# <service-name>


## To Run the project

- docker network create ouredu-service-app `docker network create <extenal network name>`
- Copy the core/.env.example to core/.env
- `docker-compose up` you may need to use `sudo`
#### IF You are running multiple projects make sure to change the services ports in every project to avoid conflicts with others services running
- in another terminal tab run `docker ps` and choose the Container ID for '<service-name>'
- `docker exec -it 'Container ID' bash` you may need to use `sudo`
- run `composer install` maybe not
- run this commands:
  - `chown -R www-data:www-data ./storage/framework/cache/ && chmod 777 -R .`
- do your work


### browse [http://localhost:8077](http://localhost:<service-port>) for the service

### when changing any configuration in the Dockerfile or docker-compose you have to run `sudo docker-compose build`

#Run the following from inside the service container :
## To Run The Unit Tests
- run `./vendor/bin/phpunit ./tests/Feature/ExampleTest.php`
## To Run The psalm
-run `./vendor/bin/psalm --no-cache`
## To Run the code sniffer checks
-run `./vendor/bin/phpcs`
## To Run the compser checks code style
-run `composer check-style`
