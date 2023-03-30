## About Assignment
### Purpose
This assignment that was built for [RoomVu](https://www.roomvu.com/) is part of their recruitment process.

### Description
We are going to have a micro-service to keep all data of user wallet. We need to have two API
to expose them to other micro-services.

### Entities
- Transaction Model
- UserBalance Model

### Technologies And Concepts

- Laravel 10
- Docker by Laravel Sail
- PHP 8.1
- Mysql

### How To Build
- To clone the project run `git clone git@github.com:sezarsaman/roomvu.git`
- `cd roomvu`
- To build by docker run `docker run --rm -v $(pwd):/opt -w /opt laravelsail/php81-composer:latest composer install`
- To give Permissions run `sudo chown -R $USER: .`
- To make the .env file run `cp .env.example .env`
- Set proper mysql variables and don't forget to change DB_HOST variable. It should be `DB_HOST=mysql`
- To open the bash run `vendor/bin/sail bash`
- To generate the key run `php artisan key:generate`
- To migrate and seed the DB run `php artisan migrate:fresh --seed`
- To see the swagger UI run `php artisan l5-swagger:generate`
- You should see laravel home by visiting `http://localhost` and API Documentation by visiting `http://localhost/api/documentation` in the browser now


### How To USE
- You don't need postman to test two APIs. Of course that is a choice for you! but you can navigate to `http://localhost/api/documentation` to test via swagger UI.
- with postman or any other API test tools we got two APIs:
- - `http://localhost/add-money` POST Request
- - `http://localhost/get-balance/{user_id}` GET Request
- Also you can check the daily command for calculating the total and daily transactions per user or all the users by opening the bash and entering this command with or without user id:
- - `php artisan app:transactions:calculate-transactions {user_id}`


### How To Test
- Run `php artisan test` (I used the same development database for tests, obviously we are not going to do that on a real project!)
