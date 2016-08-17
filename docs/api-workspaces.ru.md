# Рабочие пространства (Workspaces)

Класс `Comindware\Tracker\API\Service\WorkspaceService`.


## Получение всех рабочих пространств

Метод API: `GET /Api/Workspace`

```php
public function WorkspaceService::getAll(): Workspace[]
```
### Возвращаемые значения

Массив [Workspace](models.ru.md#workspace) — рабочие пространства.

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendrequest).

`Comindware\Tracker\API\Exception\UnexpectedValueException` если сервер вернул неожиданное значение.

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$workspaces = $api->workspaces()->getAll();
```


## Получение рабочего пространства

Метод API: `GET /Api/Workspace/{id}`

```php
public function WorkspaceService::get(string $id): Workspace
```
### Список параметров

- **$id** — Идентификатор рабочего пространства.

### Возвращаемые значения

[Workspace](models.ru.md#workspace) — запрошенное рабочее пространство.

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendrequest).

`Comindware\Tracker\API\Exception\UnexpectedValueException` если сервер вернул неожиданное значение.

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$workspace = $api->workspaces()->get('ws.123');
```
