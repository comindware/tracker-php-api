# Вложения (Attachments)

### Создание вложения

```php
// $api — instance of Comindware\Tracker\API\Api
$attachmentId = $api->attachment()->create(
    '123456', // Item id
    '/path/to/file'
 );
```

См. также:

- [examples/item-create.php](examples/item-create.php)
