# Элементы (Items)

## Api::item — действия для одиночных элементов

### Создание элемента

```php
use Comindware\Tracker\API\Model\Item;

// Create new Item.
$item = new Item();
$item->set('title', 'Foo');
$item->set('description', '<h1>Foo</h1> <p>Bar baz.</p>');

// Post it to Tracker.
// $api — instance of Comindware\Tracker\API\Api
$itemId = $api->item()->createItem('tracker.123', $item);
```

См. также:

- [examples/basic.php](examples/item-create.php)
