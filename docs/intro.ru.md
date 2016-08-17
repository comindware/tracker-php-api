# Введение

Библиотека предоставляет два уровня взаимодействия с Comindware Tracker:

1. `Comindware\Tracker\API\Client` — низкоуровневый клиент, позволяющий выполнять произвольные
   запросы.
2. `Comindware\Tracker\API\Api` — набор высокоуровневых интерфейсов к методам API. Является
   надстройкой над `Client`.

Для работы с HTTP `Client` использует библиотеки [PHP-HTTP](http://php-http.org/). Подробнее читайте
в разделе [Установка](install.ru.md).

Какой бы способ вы не выбрали, подготовка будет одинакова:
 
```php
use Comindware\Tracker\API\Client;

$client = new Client(
    $baseUri, // Адрес вашего Comindware Tracker, например «http://tracker.example.com».
    $token, // Авторизационная метка. Создаётся в административном интерфейсе Comindware Tracker.
    $httpClient, // Http\Client\HttpClient
    $httpMessageFactory, // Http\Message\MessageFactory
    $httpStreamFactory // Http\Message\StreamFactory
);
```

Обратите внимание на последние три аргумента, передаваемые в конструктор. Вы можете создать эти
объекты самостоятельно (подробнее см. на сайте [PHP-HTTP](http://php-http.org/)), либо
воспользоваться пакетом [Discovery](http://php-http.org/en/latest/discovery.html). В последнем
случае код будет выглядеть так:

```php
use Comindware\Tracker\API\Client;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\StreamFactoryDiscovery;

$client = new Client(
    $baseUri, // Адрес вашего Comindware Tracker, например «http://tracker.example.com».
    $token, // Авторизационная метка. Создаётся в административном интерфейсе Comindware Tracker.
    HttpClientDiscovery::find(),
    MessageFactoryDiscovery::find(),
    StreamFactoryDiscovery::find()
);
```

Подробнее об использовании низкоуровневого интерфейса читайте в разделе
[Низкоуровневый клиент](client.ru.md).

Для использования интерфейса более высокого уровня потребуется дополнительное действие:

```php
use Comindware\Tracker\API\Api;
// ...
$tracker = new Api($client);
```

Список возможностей этого интерфейса см. в [оглавлении](index.ru.md).

См. также:

- [examples/basic.php](examples/basic.php)
