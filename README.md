# Домашнее задание 1

1. Скопировать файлы конфигурации окружиния для laravel и laradock
```shell
cp .env.example .env
cp .env.laradock ./laradock/.env
```

2. Запустить docker compose
```shell
docker-compose -f ./laradock/dicker-compose.yml up -d nginx mysql redis
```

3. Установить зависимости composer
```shell
docker-compose -f ./laradock/docker-compose.yml exec workspace composer install
```
