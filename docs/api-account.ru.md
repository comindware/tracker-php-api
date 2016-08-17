# Учётные записи (Accounts)

## Получение учётной записи

```php
// $api — instance of Comindware\Tracker\API\Api
$account = $api->accounts()->get('account.123');
```

Возвращает модель [Account](models.ru.md#Account).
