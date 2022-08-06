## Algoriza TASK

- Laravel 9.0

## Requirments:

- PHP 8.1 or later.
- MySQL 5.7 or later.

## installation Steps

- Step 1: git clone url project.
- Step 2: `composer install` for download the required packages.
- Step 3: create database with name "algoriza_task"
- Step 4: `cp .env.example .env` to copy env file.
- Step 5: `php artisan key:generate` to generate new app key.
- Step 6: `php artisan migrate` to run database migration.
- Step 7: `php artisan db:seed` to run database seeder for create default user.
- Step 8: `npm install && npm run build` for compiling your fresh scaffolding.
- Step 9: `php artisan serve` to deploy the module

### NOTE

if you get any errors in this steps, when seeding the database, related to existing data, please run the following:

- run `php artisan config:cache` to reset setting to is last good case.
- run `chmod -R 777 storage` to give permissions to storage folder for read/wire actions.
- run `chown www-data -R storage` for the same reason described above.
