# Вложения (Attachments)

## Создание вложения

Метод API: `POST /Api/Attachment/{id}`

```php
public function AttachmentService::create(string $itemId, File $file): string
```

### Список параметров

- **$itemId** — Идентификатор элемента, в котором создать вложение.
- **$file** — [Файл](types.ru.md#file).

### Возвращаемые значения

Идентификатор созданного вложения.

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendrequest).

### Пример

```php
use Comindware\Tracker\API\Util\File\LocalFile;

// $api — instance of Comindware\Tracker\API\Api
$attachmentId = $api->attachments()->create(
    '123456', // Item id
    new LocalFile('/path/to/file', 'foo.txt')
 );
```
### См. также:

- [examples/item-create.php](examples/item-create.php)

## Получение содержимого файла

Метод API: `POST /Api/Attachment/Content/{revisionId}`

```php
public function AttachmentService::getContent((string $revisionId): Psr\Http\Message\StreamInterface
```

### Список параметров

- **$revisionId** — Идентификатор версии вложения, содержимое которой надо получить.

### Возвращаемые значения

Экземпляр `Psr\Http\Message\StreamInterface` для содержимого запрошенного файла. 

### Ошибки

Исключения, вбрасываемые [Client::sendRequest](client.ru.md#sendrequest).

### Пример

```php
// $api — instance of Comindware\Tracker\API\Api
$stream = $api->attachments()->getContent('rev.123456');
file_put_contents('/path/to/file', (string) $stream);
```
