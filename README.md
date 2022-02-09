### Требования

Минимально рекомендуемая версия `docker` - `17.06.0`, совместимая с используемым в проекте `docker-compose.yml`.   
Если ваша версия ниже, изменить `version` в `docker-compose.yml` в соотвестсвии
с [таблицей совместимости](https://docs.docker.com/compose/compose-file/compose-versioning/#compatibility-matrix "Docker documentation")
.

## Запуск проекта

Для запуска проекта выполнить

```bash
docker-compose up --build
```

### Инициализация

Для тестирования функционала необходимо выполнить некоторые предварительные действия:

- установить зависимости
- создать структуру базы данных
- заполнить базу тестовыми данными

Дальнейшие действия необходимо выполнить внутри контейнера `php`.

Зайти в контейнер `php`:

```bash
docker-compose exec php bash
```

Установить все зависимости:

```bash
composer install
```

Запустить миграции

```bash
vendor/bin/phinx migrate
```

Заполнить базу данных тестовыми данными

```bash
vendor/bin/phinx seed:run
```

## Конфигурация

### nginx

Конфигурационный файл виртуального хоста находится в [`nginx/default.conf`](nginx/default.conf)

### php-fpm

Конфигурационный файл `xdebug` размещен в [`php-fpm/xdebug.ini`](php-fpm/xdebug.ini)

## More info

[Спецификация проекта на SwaggerHub](https://app.swaggerhub.com/apis/ulngollm/demo)
