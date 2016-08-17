# Вложения (Attachments)

## Создание вложения

```php
use Comindware\Tracker\API\Util\File\LocalFile;

// $api — instance of Comindware\Tracker\API\Api
$attachmentId = $api->attachment()->create(
    '123456', // Item id
    new LocalFile('/path/to/file', 'foo.txt')
 );
```

См. также:

- [examples/item-create.php](examples/item-create.php)
