# Slimbox

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-coveralls]][link-coveralls]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Bringing [mindplay/unbox][link-unbox] into [Slim Framework][link-slim].

## Install

Via Composer

``` bash
$ composer require geekish/slimbox
```

## Usage

This package contains an extended (final) Container and ContainerFactory from [Unbox][link-unbox]. Usage is almost exactly the same as using Unbox directly, except the extended Container _partially_ implements ArrayAccess. What this means is that you may use array notation to _access_ services in the Container; however, due to the fact that Unbox uses a factory class to create the container, you cannot use array notation to set/configure services on the Container.

Also provided is `DefaultServicesProvider`, registering all the same services required by Slim. All services are registered under their class name, with aliases by interface and Slim-specific short name (e.g. "router", "foundHandler"). The default services provider is _not_ automatically registered for you, so you need to do this yourself.

The service provider accepts an array of settings that Slim uses to configure various services (see: [Slim Default Settings](//www.slimframework.com/docs/objects/application.html#slim-default-settings)). These are injected into a provided Settings class, so you may type hint against it in your classes for injection.

``` php
use Geekish\Slimbox\ContainerFactory;
use Geekish\Slimbox\DefaultServicesProvider;
use Slim\App;

$factory = new ContainerFactory;
$factory->add(new DefaultServicesProvider([
    "outputBuffering" => "prepend",
]));

$container = $factory->createContainer();

$app = new App($container);

// register your routes on App

$app->run();
```

Usage of the packaged `Container` and `ContainerFactory` is entirely optional; they are included purely for convenience and consistency with Slim's packaged `Container`. Simply swap out `Geekish\Slimbox\ContainerFactory` in the snippet above for `mindplay\unbox\ContainerFactory`.

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
[link-unbox]: //github.com/mindplay-dk/unbox
[link-packagist]: //packagist.org/packages/geekish/slimbox
[link-travis]: //travis-ci.org/geekish/slimbox
[link-coveralls]: //coveralls.io/github/geekish/slimbox
[link-code-quality]: //scrutinizer-ci.com/g/geekish/slimbox
[link-downloads]: //packagist.org/packages/geekish/slimbox
[link-author]: //github.com/geekish
[link-contributors]: ../../contributors
