# Учётные записи (Accounts)

Класс `Comindware\Tracker\API\Service\AccountService`.

## Получение аватар

**Метод API**: `POST /Api/Account/Avatar`

```php
public function AccountService::getAvatars(array $accounts): FileStruct[]
```
### Список параметров

### Возвращаемые значения

Массив [FileStruct](types.ru.md#FileStruct).

### Ошибки

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$files = $api->accounts()->getAvatars(['account.123', 'account.456']);
```

## Получение всех учётных записей

`GET /Api/Account`

```php
// $api — instance of Comindware\Tracker\API\Api
$accounts = $api->accounts()->getAll();
```

Возвращает массив [Account](models.ru.md#Account).

## Получение учётной записи

`GET /Api/Account/{id}`

```php
// $api — instance of Comindware\Tracker\API\Api
$account = $api->accounts()->get('account.123');
```

Возвращает [Account](models.ru.md#Account).
