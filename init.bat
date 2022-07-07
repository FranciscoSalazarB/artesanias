@echo off
echo Iniciando instalacion, asegurese de tener lista la base de datos y el archivo .env
composer install 
npm install
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
php artisan storage:link
echo Instalacion terminada :3