# Changelog

All Notable changes to `geekish\slimbox` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## 0.3.0 - 2016-12-01

### Added
- Even more comprehensive unit tests

### Deprecated
- Nothing

### Fixed
- Typehint against `Interop\Container\ContainerInterface` instead of `Geekish\Slimbox\Container` when registering `Slim\CallableResolver`; this fixes `unable to resolve parameter: $container (Geekish\Slimbox\Container)` and makes usage of `Geekish\Slimbox\{Container, ContainerFactory}` optional

### Removed
- Nothing

### Security
- Nothing

## 0.2.0 - 2016-11-13

### Added
- "Dummy" set() method on `Geekish\Slimbox\Container` that throws a more helpful exception
- More comprehensive unit tests

### Deprecated
- Nothing

### Fixed
- `Slim\CallableResolver` class was not imported in `Geekish\Slimbox\DefaultServicesProvider`

### Removed
- Nothing

### Security
- Nothing


## 0.1.0 - 2016-11-12

### Added
- Extended Unbox `Container` & `ContainerFactory`
- Slim service provider `DefaultServicesProvider`
- `Settings` class for type-hinting

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing
