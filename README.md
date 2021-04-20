# ouredu-dashboardbe


## To Run the project

- docker network create ouredu-service-app `docker network create ouredu-service-app`
- Copy the core/.env.example to core/.env
- `docker-compose up` you may need to use `sudo`
#### IF You are running multiple projects make sure to change the services ports in every project to avoid conflicts with others services running
- in another terminal tab run `docker ps` and choose the Container ID for 'printing-pressbe_printing-pressbe'
- `docker exec -it 'Container ID' bash` you may need to use `sudo`
- run `composer install` maybe not
- run this commands:
  - chown -R www-data:www-data ./storage/framework/cache/ 
  - chmod 777 -R ./storage
- do your work 

## Don't forget to compose up the ouredu-db project, since the project db is there.

### browse [http://localhost:8077](http://localhost:8777) for the app

### when changing any configuration in the Dockerfile or docker-compose you have to run `sudo docker-compose build`

## To Run The Unit Tests
- run `./vendor/bin/phpunit ./tests/Feature/ExampleTest.php`