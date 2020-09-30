## Product Management
This project is use for place the order with restricted country.
## Installation
> Create .env file and copy keys from .env.example and then run following commands to generate app key and create database structure using migration scripts
```bash
composer install
php artisan key:generate
```
## Run the Project
```bash
php artisan serve
```

## Run migration and seeder
```bash
php artisan migrate
php artisan db:seed 
or
php artisan migrate --seed
```

## Run Unit Test cases
```bash
vendor/bin/phpunit
```
## Completed all below points
- Added 20 products through seeder
- Added option to add place oder with required validation. 
- Order emails are send to visitor and admin. Emails are send through and Event Dispatch with queued.
- Order information is stored into database
- Used the https://freegeoip.app API to check the visitor's IP and restricted to place the order.
- Added tests cases for product module

