# Change Log

## Unreleased

### Added

- #14: Class `Expression`
- Method `Api::setLogger()`.
- Argument `$logger` to `Service\Service::__construct()` .

### Changed

- Improved logging.
- `Struct\PropertySetStruct::exportItems()` now groups all custom properties under the "properties"
  key.
- In `Service\ItemService::query()` $orderBy made optional; swapped $orderBy and $properties
  arguments.


## 0.2 - 2016-08-23

### Added

- Class `Struct\PropertySetStruct`.
- #2: Method `Service\AttachmentService::getContent()`.
- #8: Method `Service\ItemService::query()`.
- Method `Model\Application::getWorkspaces()`.

### Changed

- Method `Client::sendRequest()` now can return instance of `Psr\Http\Message\StreamInterface`.
- Method `Service\AppService::getApplication()` renamed to `get`.
- Method `Service\AppService::getApplications()` renamed to `getAll`.


## 0.1 - 2016-08-17

First development release.
