// Command

git clone https://github.com/Yoeurn-Yat/role_permission.git

composer install

cp .example.env .env

//install spatie
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
//install passport
composer require laravel/passport
php artisan migrate
php artisan passport:install

php artisan key:generate

php artisan migrate

php artisan passport:client --personal

php artisan serve
