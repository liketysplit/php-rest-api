# php-rest-api
A basic rest API using PHP and Laravel

# Setup
   ## compose (default) 
        - composer install
        - ./vendor/bin/sail up
        - ./vendor/bin/sail artisan migrate || php artisan migrate
        - ./vendor/bin/sail artisan migrate:rollback (only if wanting to dump the tables)
   ## sqlite (does not support date modified on update)
        - docker build -t php-rest-api .
        - docker run -it -d --rm -p 80:8000 --name php-rest-api php-rest-api

# Commands

 ### Migration Setup for DB
    - php artisan migrate
    - php artisan migrate:rollback

 ### Migrations New
    - "php artisan make:model <Model Name> --migration"

 ### Controllers New
    - "php artisan make:controller <Controller Name> --api"

# Testing
   Done within Rest Client in VScode or used within Postman. Generic requests where stored in *.http files for ease of use.
   - Users.http
   - Topics.http
   - Replies.http
   - Watchers.http
