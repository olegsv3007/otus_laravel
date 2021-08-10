# Домашнее задание 2

1. Скопировать файлы конфигурации окружиния для laravel и laradock
```shell
cp .env.example .env
cp .env.laradock ./laradock/.env
```

2. Запустить docker compose
```shell
docker-compose -f ./laradock/dicker-compose.yml up -d nginx mysql redis
```

3. Перейти в командную строку контейнера workspace
```shell
docker-compose -f ./laradock/docker-compose.yml exec --user=laradock workspace bash
```

4. Установить зависимости composer
```shell
composer install
```

5. Установить зависимости npm и скомпилировать скрипты и стили
```shell
nmp install
npm run dev // для разработки
npm run prod // для продакшена
```

6. Выполнить миграции бд
```shell
php artisan migrate
```
