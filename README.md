Laravel Restful API project


# STEPS to setup the app
Please run the commands below in the same sequence:

1.	composer install
2.	php artisan key:generate
3.	Update Database info in .env file
4.	php artisan migrate
5.	php artisan passport:install
6.	php artisan db:seed 

7.  Please refer "users" table to get Admin user details such as email and password (password is password, generated from seeder)



