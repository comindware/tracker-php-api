# Ошибки

Сервер может возвращать следующие типы ошибок (все классы расположены в пространстве имён
`Comindware\Tracker\API\Exception`).

- `WebApiClientException` — Ошибка со стороны клиента.
  - `AccessDeniedWebApiException` — Доступ к ресурсу запрещён.
  - `NotAuthorizedWebApiException` — Пользователь не идентифицирован или учётная запись отключена.
  - `ObjectNotFoundWebApiException` — Запрошенный объект не найден.
