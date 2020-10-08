web: vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:work redis --sleep=3 --tries=3 --daemon
php artisan queue:work database --tries=3
worker: php artisan queue:restart
