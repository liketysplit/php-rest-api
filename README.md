# php-rest-api
A basic rest API using PHP and Laravel

# Setup
   - compose (default) 
        - composer install
        - ./vendor/bin/sail up
        - ./vendor/bin/sail artisan migrate || php artisan migrate
    - sqlite (does not support date modified on update)
        - docker build -t php-rest-api .
        - docker run -it -d --rm -p 80:8000 --name php-rest-api php-rest-api

## Commands

 ### Migration Setup for DB
    - php artisan migrate
    - php artisan migrate:rollback

 ### Migrations New
    - "php artisan make:model <Model Name> --migration"

 ### Controllers New
    - "php artisan make:controller <Controller Name> --api"

 ### Testing
   - Users.http
   - Topics.http
   - Replies.http
   - Watchers.http
