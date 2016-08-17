# Учётные записи (Accounts)

## Получение всех учётных записей

```php
// $api — instance of Comindware\Tracker\API\Api
$accounts = $api->accounts()->getAll();
```

Возвращает массив [Account](models.ru.md#Account).

## Получение учётной записи

```php
// $api — instance of Comindware\Tracker\API\Api
$account = $api->accounts()->get('account.123');
```

Возвращает [Account](models.ru.md#Account).
