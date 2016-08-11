# Элементы (Items)

## Api::item — действия для одиночных элементов

### Создание элемента

```php
// Create new Item.
$item = new Item();
$item->set('title', 'Foo');
$item->set('description', '<h1>Foo</h1> <p>Bar baz.</p>');

// Post it to Tracker.
$itemId = $api->item()->createItem('tracker.123', $item);
```

См. также:

- [examples/basic.php](examples/item-create.php)
