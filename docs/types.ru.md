# Прочие типы данных

## Структуры данных

Структуры расположены в пространстве имён `Comindware\Tracker\API\Struct` и соответствуют некоторым
структурам, возвращаемым сервером.

### FileStruct

Описывает файл, получаемый с сервера.


## Вспомогательные типы

### File

`Comindware\Tracker\API\Util\File\File`

Интерфейс файлов, загружаемых на сервер. Этот интерфейс реализуется следующими классами.

#### LocalFile

`Comindware\Tracker\API\Util\File\LocalFile`

Позволяет загружать файлы, расположенные в локальной файловой системе клиента.

Пример:

```php
use Comindware\Tracker\API\Util\File\LocalFile;

$file = new LocalFile('/path/to/file', 'foo.jpg');
```
См. также [Вложения (Attachments)](api-attachment.ru.md).