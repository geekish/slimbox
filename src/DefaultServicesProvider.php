<?php

namespace Geekish\Slimbox;

use mindplay\unbox\ContainerFactory as UnboxFactory;
use mindplay\unbox\ProviderInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\CallableResolver;
use Slim\Handlers\PhpError;
use Slim\Handlers\Error;
use Slim\Handlers\NotFound;
use Slim\Handlers\NotAllowed;
use Slim\Handlers\Strategies\RequestResponse;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Interfaces\Http\EnvironmentInterface;
use Slim\Interfaces\InvocationStrategyInterface;
use Slim\Interfaces\RouterInterface;
use Slim\Router;

/**
 * Slim's default Service Provider.
 */
class DefaultServicesProvider implements ProviderInterface
{
    /**
     * @var array
     */
    protected $settings = [];

    /**
     * @param array $settings
     */
    public function __construct(array $settings = [])
    {
        $this->settings = $settings;
    }

    /**
     * Register Slim's default services.
     *
     * @param UnboxFactory $factory
     */
    public function register(UnboxFactory $factory)
    {
        $factory->set(
            Settings::class,
            new Settings($this->settings)
        );

        $factory->alias(
            'settings',
            Settings::class
        );

        $factory->register(
            Environment::class,
            function () {
                return new Environment($_SERVER);
            }
        );

        $factory->alias(
            EnvironmentInterface::class,
            Environment::class
        );

        $factory->alias(
            'environment',
            EnvironmentInterface::class
        );

        $factory->register(
            Request::class,
            function (Environment $environment) {
                return Request::createFromEnvironment($environment);
            }
        );

        $factory->alias(
            ServerRequestInterface::class,
            Request::class
        );

        $factory->alias(
            'request',
            Request::class
        );

        $factory->register(
            Response::class,
            function (Settings $settings) {
                $headers = new Headers(['Content-Type' => 'text/html; charset=UTF-8']);
                $response = new Response(200, $headers);

                return $response->withProtocolVersion($settings['httpVersion']);
            }
        );

        $factory->alias(
            ResponseInterface::class,
            Response::class
        );

        $factory->alias(
            'response',
            Response::class
        );

        $factory->register(
            Router::class,
            function (Settings $settings) {
                $routerCacheFile = false;
                if ($settings->has('routerCacheFile') && file_exists($settings['routerCacheFile'])) {
                    $routerCacheFile = $settings['routerCacheFile'];
                }
                return (new Router)->setCacheFile($routerCacheFile);
            }
        );

        $factory->alias(
            RouterInterface::class,
            Router::class
        );

        $factory->alias(
            'router',
            Router::class
        );

        $factory->register(
            RequestResponse::class
        );

        $factory->alias(
            InvocationStrategyInterface::class,
            RequestResponse::class
        );

        $factory->alias(
            'foundHandler',
            RequestResponse::class
        );

        $factory->register(
            PhpError::class,
            function (Settings $settings) {
                return new PhpError($settings['displayErrorDetails']);
            }
        );

        $factory->alias(
            'phpErrorHandler',
            PhpError::class
        );

        $factory->register(
            Error::class,
            function (Settings $settings) {
                return new Error($settings['displayErrorDetails']);
            }
        );

        $factory->alias(
            'errorHandler',
            Error::class
        );

        $factory->register(
            NotFound::class
        );

        $factory->alias(
            'notFoundHandler',
            NotFound::class
        );

        $factory->register(
            NotAllowed::class
        );

        $factory->alias(
            'notAllowedHandler',
            NotAllowed::class
        );

        $factory->register(
            CallableResolver::class,
            function (ContainerInterface $container) {
                return new CallableResolver($container);
            }
        );

        $factory->alias(
            CallableResolverInterface::class,
            CallableResolver::class
        );

        $factory->alias(
            'callableResolver',
            CallableResolverInterface::class
        );
    }
}
