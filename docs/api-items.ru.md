# Элементы (Items)

## Получение элемента

Метод API: `GET /Api/Item/{id}`

```php
public function ItemService::get(string $id): Item
```
### Список параметров

- **$id** — Идентификатор элемента.

### Возвращаемые значения

[Item](models.ru.md#item) — элемент.

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendrequest).

`Comindware\Tracker\API\Exception\UnexpectedValueException` если сервер вернул неожиданное значение.

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$item = $api->items()->get('123456');
```

## Создание элемента

Метод API: `POST /Api/Item/{id}`

```php
public function ItemService::create(string $containerId, Item $item): string
```
### Возвращаемые значения

Идентификатор созданного элемента

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendrequest).

`InvalidArgumentException` если у `$item` не задано ни одного свойства. 

### Пример

```php
use Comindware\Tracker\API\Model\Item;

// Create new Item.
$item = new Item();
$item->set('title', 'Foo');
$item->set('description', '<h1>Foo</h1> <p>Bar baz.</p>');

// Post it to Tracker.
// $api — instance of Comindware\Tracker\API\Api
$itemId = $api->items()->create('tracker.123', $item);
```

### См. также:

- [examples/item-create.php](examples/item-create.php)
