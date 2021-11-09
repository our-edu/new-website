# automatic-payment



## To Run the project

- docker network create our-edu-automatic-payment `docker network create our-edu-automatic-payment`
- Copy the core/.env.example to core/.env
- `docker-compose up` you may need to use `sudo`
#### IF You are running multiple projects make sure to change the services ports in every project to avoid conflicts with others services running
- in another terminal tab run `docker ps` and choose the Container ID for `automatic-payment`
- `docker exec -it 'Container ID' bash` you may need to use `sudo`
- run `composer install` maybe not
- run this commands:
  - `chown -R www-data:www-data ./storage/framework/cache/ && chmod 777 -R .`
- do your work


### browse [http://localhost:8030](http://localhost:8030) for the service

### when changing any configuration in the Dockerfile or docker-compose you have to run `sudo docker-compose build`

#Run the following from inside the service container :
## To Run The Unit Tests
- run `./vendor/bin/phpunit ./tests/Feature/ExampleTest.php`
## To Run The psalm
-run `./vendor/bin/psalm --no-cache`
## To Run the code sniffer checks
-run `./vendor/bin/phpcs --warning-severity=6`
## To Run the compser checks code style
-run `composer check-style`
