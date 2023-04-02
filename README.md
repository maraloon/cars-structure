## Единая структура моделей автомобилей для проектов Avangard

### Установка
#### composer.json:
```
"repositories": [
        {
            "type": "vcs",
            "url": "git@git.avangard-mb.ru:avangard/cars-structure.git"
        }
    ]
```

#### Терминал:

```
composer require avangard/cars-structure
php artisan migrate
php artisan cars:models:copy
```

### Использование

После установки в вашем проекте появятся пустые модели `App/Models/Cars`, которые наследуются от моделей в пакете `src/Models`. Таким образом на момент
установки у вас есть структура автомобилей в базе и в проекте. А так же есть возможность расширять структуру, изменяя модели из `App/Models/Cars`

после выполнения команды ``php artisan cars:models:copy`` появятся конфигурационые файлы

```
config/cars_colors.php
config/cars_structure.php
```

В файле `cars_structure` содержатся список Моделей с ключами для связей

Есть готовые решения в тестах
