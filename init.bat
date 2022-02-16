@echo off
echo Iniciando instalacion, asegurese de tener lista la base de datos y el archivo .env
composer install 
npm install
php artisan key:generate
php artisan migrate:fresh
echo Instalacion terminada :3