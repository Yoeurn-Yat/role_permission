// Command

git clone https://github.com/Yoeurn-Yat/role_permission.git

composer install

cp .example.env .env
//fix routes api
if routes api.php no cache: please into folder bootstrap and open file app.php include this text
"api: __DIR__.'/../routes/api.php'," to withRouting ,
Or run cammand
php artisan install:api

//install spatie
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
//install passport
composer require laravel/passport
php artisan migrate
php artisan passport:install

php artisan key:generate

php artisan migrate:fresh

php artisan passport:client --personal

php artisan serve
