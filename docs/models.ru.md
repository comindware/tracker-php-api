# Модели данных

Все модели располагаются в пространстве имён `Comindware\Tracker\API\Model`.

Для каждого свойства у модели существует два метода — для чтения и для записи. Например, для
свойства `foo` это будут `getFoo` и `setFoo` соответственно.

## Account

Учётная запись.

**Свойства**

- **id**: string — Идентификатор (пример: «account.123»).
- **fullName**: string — Полное имя.

## Application

Приложение — это коллекция элементов одного вида. Есть три вида приложений:

TODO Перевести на русский.

1. workflow app which creates and stores workflow tasks processed by a workflow;
2. tasks app which creates and stores different tasks scattered across your team;
3. documents app which creates and stores documents of the same type.

**Свойства**

- **id**: string — Идентификатор (пример: «tracker.123»).
- **name**: string — Имя.
- **description**: string — Описание.
- **type**: string — Вид элемента: «Task», «Document» или «Tracker».

## Attachment

Вложение (прикрепленный файл).

**Свойства**

- **id**: string — Идентификатор (пример: «rev.39088»).
- **name**: string — Имя файла.
- **uri**: string — Адрес файла относительно корня трекера.
- **createdAt**: DateTimeImmutable — Время создания.
- **imageWidth**: int — Ширина изображения (если это изображение).
- **imageHeight**: int — Высота изображения (если это изображение).
- **author**: [Account](#account) — Создатель вложения.

## Item

Элемент (запрос).

**Свойства**

- **id**: string — Идентификатор (пример: «123456»).
- **applicationId**: string — Идентификатор [приложения](#application), к которому относится
  элемент.
- **prototypeId**: string — Идентификатор прототипа.
- **type**: string — Вид элемента: «Task», «Document» или «Tracker».
- **creator**: [Account](#account) — Создатель элемента.
- **createdAt**: DateTimeImmutable — Время создания.
- **updatedAt**: DateTimeImmutable — Время последнего изменения.

Кроме этого у элемента могут быть и иные свойства. Для чтения/записи этих свойств предназначены
методы `Item:get(<имя свойства>)` и `Item:set(<имя свойства>, <значение>)` соответственно.

## Workspace

Рабочее пространство — это команда или проект, которые содержат [приложения](#application).

**Свойства**

- **id**: string — Идентификатор (пример: «ws.123»).
- **name**: string — Имя.
- **description**: string — Описание.
- **containerId**: string — Идентификатор контейнера, содержащего это пространство.
