<?php
/**
 * Slim Framework (http://slimframework.com)
 *
 * @link      https://github.com/slimphp/Slim
 * @copyright Copyright (c) 2011-2016 Josh Lockhart
 * @license   https://github.com/slimphp/Slim/blob/master/LICENSE.md (MIT License)
 */
namespace Geekish\Slimbox;

use Interop\Container\Exception\NotFoundException;
use mindplay\unbox\ContainerFactory as UnboxFactory;
use PHPUnit\Framework\TestCase;

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

        $this->assertInstanceOf('\mindplay\unbox\Container', $container);
    }

    /**
     * Test `get()` returns existing item
     */
    public function testGet()
    {
        $this->assertInstanceOf('\Slim\Interfaces\Http\EnvironmentInterface', $this->container->get('environment'));
    }

    /**
     * Test container has settings
     */
    public function testGetSettings()
    {
        $this->assertInstanceOf('\Geekish\Slimbox\Settings', $this->container->get('settings'));
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
        $this->expectException(\BadMethodCallException::class);

        $this->container['foo'] = 'bar';
    }

    /**
     * Test `set()` throws exception
     */
    public function testCannotSetOnContainer()
    {
        $this->expectException(\BadMethodCallException::class);

        $this->container->set('foo', 'bar');
    }

    /**
     * Test ArrayAccess offsetUnset on container throws exception
     */
    public function testCannotArrayAccessUnsetOnContainer()
    {
        $this->expectException(\BadMethodCallException::class);

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
        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $this->container['response']);
    }

    /**
     * Test container has router
     */
    public function testGetRouter()
    {
        $this->assertInstanceOf('\Slim\Interfaces\RouterInterface', $this->container['router']);
    }

    /**
     * Test container has foundHandler
     */
    public function testGetFoundHandler()
    {
        $this->assertInstanceOf('\Slim\Interfaces\InvocationStrategyInterface', $this->container['foundHandler']);
    }

    /**
     * Test container has errorHandler
     */
    public function testGetErrorHandler()
    {
        $this->assertInstanceOf('\Slim\Handlers\Error', $this->container['errorHandler']);
    }

    /**
     * Test container has phpErrorHandler
     */
    public function testGetPhpErrorHandler()
    {
        $this->assertInstanceOf('\Slim\Handlers\PhpError', $this->container['phpErrorHandler']);
    }

    /**
     * Test container has notAllowedHandler
     */
    public function testGetNotAllowedHandler()
    {
        $this->assertInstanceOf('\Slim\Handlers\NotAllowed', $this->container['notAllowedHandler']);
    }

    /**
     * Test container has callableResolver
     */
    public function testGetCallableResolver()
    {
        $this->assertInstanceOf('\Slim\Interfaces\CallableResolverInterface', $this->container['callableResolver']);
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
