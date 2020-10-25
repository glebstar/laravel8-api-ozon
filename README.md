# Laravel 8 API Ozon

## Установка проекта

+ Склонируйте проект
+ Перейдите в консоли в директорию с проектом
+ `composer install`
+ `cp .env.example .env`
+ В файле .env настройте параметры OZON_
+ `php artisan key:generate`
+ Настройте ваш веб-сервер для работы с сайтом
+ Выполните тесты `php artisan test`

## Методы API

+ `/api/add-products` Добавление продуктов на Ozon, параметры запроса смотрите в документации API Ozon https://api-seller.ozon.ru/apiref/ru/#t-title_product_import
+ `/api/product-info` Информация о загруженном на Ozon товаре, параметры запроса смотрите в документации API Ozon https://api-seller.ozon.ru/apiref/ru/#t-title_products_info
+ Примеры работы с API можно посмотреть в прилагаемых тестах
