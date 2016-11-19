# Slimbox

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Bringing [mindplay/unbox][link-unbox] into [Slim Framework][link-slim].

## Install

Via Composer

``` bash
$ composer require geekish/slimbox
```

## Usage

This package contains an extended (final) Container and ContainerFactory from [Unbox][link-unbox]. Usage is almost exactly the same, except the extended Container _partially_ implements ArrayAccess. What this means is that you may use array notation to _access_ services in the Container; however, due to the fact that Unbox uses a factory class to create the container, you cannot use array notation to set/configure services on the Container.

Also provided is a default service provider, registering all the same services required by Slim. All services are registered under their class name, with aliases by interface and Slim-specific short name (e.g. "router", "foundHandler"). The default services provider is _not_ automatically registered for you, so you need to do this yourself.

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
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/geekish/slimbox.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/geekish/slimbox.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/geekish/slimbox.svg?style=flat-square

[link-slim]: //github.com/slimphp/Slim
[link-unbox]: //github.com/mindplay-dk/unbox
[link-packagist]: //packagist.org/packages/geekish/slimbox
[link-travis]: //travis-ci.org/geekish/slimbox
[link-scrutinizer]: //scrutinizer-ci.com/g/geekish/slimbox/code-structure
[link-code-quality]: //scrutinizer-ci.com/g/geekish/slimbox
[link-downloads]: //packagist.org/packages/geekish/slimbox
[link-author]: //github.com/geekish
[link-contributors]: ../../contributors
