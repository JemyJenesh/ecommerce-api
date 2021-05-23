# About Project

E-commerce api

## Installation guide

1. composer install (link https://getcomposer.org/download/)
2. copy env.example to a new env file
3. setup a database in your machine (you can use laragon https://laragon.org/download/ or xamp or anything)
4. config database in env file ( database name )
5. run `php artisan migrate` to migrate tables in your database
   `php artisan migrate:fresh` to drop and create new tables
   `php artisan migrate[:fresh] --seed` to migrate tables with seeds
   `php aritsan route:list` for all the routes
6. run `php artisan serve` to start the server
