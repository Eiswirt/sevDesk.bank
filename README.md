<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## About Demo

sevDesk.Bank Demo 
- Checking account with basic functionality (deposite, withdraw, store and show)
- Credit account with basic functionality (payment, store and show)
- Passbook with basic functionality

## Docker

The `docker-compose.yml` is located in the root directory. The associated Dockerfile and the configuration of Mysql and Nginx are located in the Docker folder.

Steps: 

1. `docker-compose up -d`
2. `docker-compose exec app bash`
3. `php artisan migrate`

Application is now available at `localhost`


