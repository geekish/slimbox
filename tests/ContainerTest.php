<?php
/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/slimphp/Slim
 * @copyright Copyright (c) 2011-2016 Josh Lockhart
 * @license   https://github.com/slimphp/Slim/blob/master/LICENSE.md (MIT License)
 */
namespace Geekish\Slimbox;

use BadMethodCallException;
use Interop\Container\Exception\NotFoundException;
use mindplay\unbox\Container as UnboxContainer;
use mindplay\unbox\ContainerFactory as UnboxFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Handlers;
use Slim\Interfaces;

/**
 * ContainerTest
 * Blatantly copypasta'd from \Slim\Tests\ContainerTest
 */
class ContainerTest extends TestCase
{
    /**
     * @var Container
     */
    protected $container;

    public function setUp()
    {
        $containerFactory = new ContainerFactory;
        $containerFactory->add(new DefaultServicesProvider);
        $this->container = $containerFactory->createContainer();
    }

    /**
     * Test using UnboxFactory
     */
    public function testUnboxFactory()
    {
        $unboxFactory = new UnboxFactory;
        $unboxFactory->add(new DefaultServicesProvider);
        $container = $unboxFactory->createContainer();

        $this->assertInstanceOf(UnboxContainer::class, $container);
    }

    /**
     * Test `get()` returns existing item
     */
    public function testGet()
    {
        $this->assertInstanceOf(Interfaces\Http\EnvironmentInterface::class, $this->container->get('environment'));
    }

    /**
     * Test container has settings
     */
    public function testGetSettings()
    {
        $this->assertInstanceOf(Settings::class, $this->container->get('settings'));
    }

    /**
     * Test `get()` throws error if item does not exist
     */
    public function testGetWithValueNotFoundError()
    {
        $this->expectException(NotFoundException::class);

        $this->container->get('foo');
    }

    /**
     * Test `set()` throws exception
     */
    public function testCannotArrayAccessSetOnContainer()
    {
        $this->expectException(BadMethodCallException::class);

        $this->container['foo'] = 'bar';
    }

    /**
     * Test `set()` throws exception
     */
    public function testCannotSetOnContainer()
    {
        $this->expectException(BadMethodCallException::class);

        $this->container->set('foo', 'bar');
    }

    /**
     * Test ArrayAccess offsetUnset on container throws exception
     */
    public function testCannotArrayAccessUnsetOnContainer()
    {
        $this->expectException(BadMethodCallException::class);

        unset($this->container['settings']);
    }

    /**
     * Test that we can check container has via ArrayAccess
     */
    public function testOffestHasOnContainer()
    {
        $this->assertTrue(isset($this->container['settings']));
    }

    /**
     * Test container has request
     */
    public function testGetRequest()
    {
        $this->assertInstanceOf('\Psr\Http\Message\RequestInterface', $this->container['request']);
    }

    /**
     * Test container has response
     */
    public function testGetResponse()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->container['response']);
    }

    /**
     * Test container has router
     */
    public function testGetRouter()
    {
        $this->assertInstanceOf(Interfaces\RouterInterface::class, $this->container['router']);
    }

    /**
     * Test container has foundHandler
     */
    public function testGetFoundHandler()
    {
        $this->assertInstanceOf(Interfaces\InvocationStrategyInterface::class, $this->container['foundHandler']);
    }

    /**
     * Test container has errorHandler
     */
    public function testGetErrorHandler()
    {
        $this->assertInstanceOf(Handlers\Error::class, $this->container['errorHandler']);
    }

    /**
     * Test container has phpErrorHandler
     */
    public function testGetPhpErrorHandler()
    {
        $this->assertInstanceOf(Handlers\PhpError::class, $this->container['phpErrorHandler']);
    }

    /**
     * Test container has notAllowedHandler
     */
    public function testGetNotAllowedHandler()
    {
        $this->assertInstanceOf(Handlers\NotAllowed::class, $this->container['notAllowedHandler']);
    }

    /**
     * Test container has callableResolver
     */
    public function testGetCallableResolver()
    {
        $this->assertInstanceOf(Interfaces\CallableResolverInterface::class, $this->container['callableResolver']);
    }

    /**
     * Test settings can be edited
     */
    public function testSettingsCanBeEdited()
    {
        $this->assertSame('1.1', $this->container->get('settings')['httpVersion']);

        $this->container->get('settings')['httpVersion'] = '1.2';
        $this->assertSame('1.2', $this->container->get('settings')['httpVersion']);
    }

    public function testRouteCacheDisabledByDefault()
    {
        $this->assertFalse($this->container->get('settings')['routerCacheFile']);
    }
}
