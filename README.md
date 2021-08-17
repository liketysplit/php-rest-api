# php-rest-api
A basic rest API using PHP and Laravel

# Setup
    - create database.sqlite in the /database folder
    - setup .env file if not using sqlite
    - run 
        - php artisan migrate
        - docker build -t php-rest-api .
        - docker run -it --rm --name php-rest-api php-rest-api

     

## Commands

 ### Migration Setup for DB
    - php artisan migrate
    - php artisan migrate:rollback

 ### Migrations New
    - "php artisan make:model <Model Name> --migration"

 ### Controllers New
    - "php artisan make:controller <Controller Name> --api"
