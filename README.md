# TMC Laravel Application Publisher

## Installation

- clone this repository
- copy `.env.example` file and rename with `.env`
- run `composer install`
- setup database and queue connection on `.env` file
- run database migration with command `php artisan migrate`
- run the application with command `php artisan serve`

## Authentication
This API using Laravel Sanctum for authentication. <br>
You can simply register new user to get Bearer token and put on `Authorization` headers : <br>
POST `localhost:8000/api/users/register` with body request `name, email and password`.

## Testing
#### this app using Pest for default testing framework.
#### please install Pest with `php artisan pest:install`

