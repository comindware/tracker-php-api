# Приложения (Applications)

Класс `Comindware\Tracker\API\Service\AppService`.


## Получение всех приложений

Метод API: `GET /Api/App`

```php
public function AppService::getAll(): Application[]
```
### Возвращаемые значения

Массив [Application](models.ru.md#application) — рабочие пространства.

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendrequest).

`Comindware\Tracker\API\Exception\UnexpectedValueException` если сервер вернул неожиданное значение.

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$applications = $api->apps()->getAll();
```


## Получение рабочего пространства

Метод API: `GET /Api/Application/{id}`

```php
public function AppService::get(string $id): Application
```
### Список параметров

- **$id** — Идентификатор рабочего пространства.

### Возвращаемые значения

[Application](models.ru.md#application) — запрошенное рабочее пространство.

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendrequest).

`Comindware\Tracker\API\Exception\UnexpectedValueException` если сервер вернул неожиданное значение.

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$application = $api->apps()->get('tracker.123');
```
