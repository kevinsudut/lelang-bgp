## How to run the application

1. Clone the repository
2. Make sure you have php version 8 and composer
3. Make sure the database using mysql
4. Recommendation using XAMPP
5. Create database with name "laravel"
6. Run this command to copy env file: cp .env.example .env
7. Run this command to generate app key: php artisan key:generate
8. Run this command to download vendor: composer install
9. Run this command to migrate the database: php artisan migrate:fresh
10. Open two terminal. One for run php server and another to run cron
11. Run this command to run php server: php artisan serve
12. Run this command to run cron: php artisan queue:work
