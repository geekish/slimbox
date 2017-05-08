# Slimbox

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-coveralls]][link-coveralls]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Bringing [mindplay/unbox][link-unbox] into [Slim Framework][link-slim].

## Install

Via [Composer][link-composer]:

``` bash
composer require geekish/slimbox
```

## Usage

### Service Provider

The most important class in this package is `Geekish\Slimbox\DefaultServicesProvider`.
It ensures the same services [required by Slim](https://www.slimframework.com/docs/concepts/di.html#required-services) are available through Unbox.
Besides the change in container, it differs from `Slim\DefaultServicesProvider` by registering services under their FQCN first, then registers aliases by their interfaces, and finally the short aliases used by slim (e.g. "router", "foundHandler"). Registering services by their class name enables Unbox to automatically inject them as dependencies as needed by other classes.

The service provider is _not_ automatically registered for you, so you need to do this yourself:

```php
use Geekish\Slimbox\DefaultServicesProvider;
use mindplay\unbox\ContainerFactory;

$factory = new ContainerFactory;
$factory->add(new DefaultServicesProvider);

$container = $factory->createContainer();
```

### Settings

Also included is `Geekish\Slimbox\Settings`, which extends from `Slim\Collection`. This class replaces the simple array that Slim registers under "settings" (see: [Slim Default Settings][link-slim-default-settings]).

Settings may be provided via the constructor of the `DefaultServicesProvider`:

```php
$factory->add(new DefaultServicesProvider([
    "outputBuffering" => "prepend",
]));
```

Or via the `configure()` method on `ContainerFactory`:

```php
$factory->configure(
    Settings::class,
    function (Settings $settings) {
        $settings['displayErrorDetails'] = true;
        return $settings;
    }
);
```

### Container and Container Factory (Optional)

This package contains an extended (final) Container and ContainerFactory from [Unbox][link-unbox]. Usage is almost exactly the same as using Unbox directly, except the extended Container _partially_ implements [ArrayAccess](http://php.net/manual/en/class.arrayaccess.php). This allows you to use the Container like an array to _access_ services; however, due to the fact that Unbox uses a factory class to create the container, you cannot use array notation to set/configure services on the Container.

To use the extended ContainerFactory:

``` php
use Geekish\Slimbox\ContainerFactory;
use Geekish\Slimbox\DefaultServicesProvider;
use Slim\App;

$factory = new ContainerFactory;
$factory->add(new DefaultServicesProvider([
    "outputBuffering" => "prepend",
]));

$container = $factory->createContainer();
```

Usage of the packaged `Container` and `ContainerFactory` is entirely optional; they are included purely for convenience and consistency with Slim's packaged `Container`. Simply replace `Geekish\Slimbox\ContainerFactory` in the snippet above with `mindplay\unbox\ContainerFactory`.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hannahwarmbier@gmail.com instead of using the issue tracker.

## Credits

- [Hannah Warmbier][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/geekish/slimbox.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/geekish/slimbox/master.svg?style=flat-square
[ico-coveralls]: https://coveralls.io/repos/github/geekish/slimbox/badge.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/geekish/slimbox.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/geekish/slimbox.svg?style=flat-square

[link-slim]: //github.com/slimphp/Slim
[link-slim-required-services]: //www.slimframework.com/docs/concepts/di.html#required-services
[link-slim-default-settings]: //www.slimframework.com/docs/objects/application.html#slim-default-settings
[link-composer]: //getcomposer.org
[link-unbox]: //github.com/mindplay-dk/unbox
[link-packagist]: //packagist.org/packages/geekish/slimbox
[link-travis]: //travis-ci.org/geekish/slimbox
[link-coveralls]: //coveralls.io/github/geekish/slimbox
[link-code-quality]: //scrutinizer-ci.com/g/geekish/slimbox
[link-downloads]: //packagist.org/packages/geekish/slimbox
[link-author]: //github.com/geekish
[link-contributors]: ../../contributors
