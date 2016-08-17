# Учётные записи (Accounts)

Класс `Comindware\Tracker\API\Service\AccountService`.

## Получение аватар

**Метод API**: `POST /Api/Account/Avatar`

```php
public function AccountService::getAvatars(array $accounts): FileStruct[]
```
### Список параметров

- **$accounts** — Массив учётных записей, чьи аватары надо получить. Элементами массива могут быть
  идентификаторы или экземпляры [Account](models.ru.md#Account) (можно смешивать в одном запросе оба
  типа).

### Возвращаемые значения

Массив [FileStruct](types.ru.md#FileStruct).

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendRequest).

`Comindware\Tracker\API\Exception\UnexpectedValueException` если сервер вернул неожиданное значение.

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$files = $api->accounts()->getAvatars(['account.123', 'account.456']);
```


## Получение всех учётных записей

**Метод API**: `GET /Api/Account`

```php
public function AccountService::getAll(): Account[]
```
### Возвращаемые значения

Массив [Account](models.ru.md#Account).

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendRequest).

`Comindware\Tracker\API\Exception\UnexpectedValueException` если сервер вернул неожиданное значение.

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$accounts = $api->accounts()->getAll();
```


## Получение учётной записи

**Метод API**: `GET /Api/Account/{id}`

```php
public function AccountService::get(string $id): Account
```
### Список параметров

- **$id** — Идентификатор учётной записи.

### Возвращаемые значения

[Account](models.ru.md#Account).

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendRequest).

`Comindware\Tracker\API\Exception\UnexpectedValueException` если сервер вернул неожиданное значение.

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$account = $api->accounts()->get('account.123');
```
