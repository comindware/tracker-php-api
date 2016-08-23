# Элементы (Items)

## Выборка элементов, удовлетворяющих выражению

Метод API: `POST /Api/Item/Query`

```php
public function ItemService::query(string $expression, array $orderBy,
                    array $properties [ , int $limit [ , int $offset ]] ): Item[]
```

### Список параметров

- **$expression** — Выражение на [Comindware Expression
  Language](http://kb.comindware.com/comindware-tracker/1.0/comindware-expression-language-how-to/).
- **$orderBy** — Параметры сортировки в виде массива ['поле' => 'направление'], где «поле» — имя
  поля, а «направление» — «Ascending» или «Descending». На данный момент сортировка возможна только
  по одному полю.
- **$properties** — Список свойств элемента, которые надо вернуть. Обратите внимание, что если вам
  нужны системные (встроенные) свойства [Item](models.ru.md#item), то их тоже надо указывать в этом
  аргументе.
- **$limit** — Наибольшее количество элементов, которые надо вернуть (по умолчанию 100).
- **$offset** — Сколько элементов пропустить от начала.

### Возвращаемые значения

Массив [Item](models.ru.md#item). Обратите внимание, что в моделях будут заполнены только те
свойства, которые были указаны в аргументе `$properties`.

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendrequest).

### Пример

- [examples/query-items.php](examples/query-items.php)


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

### Список параметров

- **$containerId** — Идентификатор контейнера, в котором создать элемент.
- **$item** — [Модель](models.ru.md#item) создаваемого элемента.

### Возвращаемые значения

Идентификатор созданного элемента.

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
