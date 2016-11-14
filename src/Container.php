<?php

namespace Geekish\Slimbox;

use ArrayAccess;
use BadMethodCallException;
use mindplay\unbox\Configuration;
use mindplay\unbox\Container as Unbox;
use mindplay\unbox\ContainerException;

final class Container extends Unbox implements ArrayAccess
{
    /**
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        parent::__construct($config);
    }

    /********************************************************************************
     * ArrayAccess interface
     *******************************************************************************/

    /**
     * @inheritDoc
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($key, $value)
    {
        throw new BadMethodCallException(sprintf(
            "%s does not support ArrayAccess::offsetSet",
            __CLASS__
        ));
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($key)
    {
        throw new BadMethodCallException(sprintf(
            "%s does not support ArrayAccess::offsetUnset",
            __CLASS__
        ));
    }

    /********************************************************************************
     * Slim Container "compatibility"
     *******************************************************************************/

    /**
     * @inheritDoc
     */
    public function set($key, $value)
    {
        throw new BadMethodCallException(sprintf(
            "%s does not support set() method, you must use %s to configure and create the container",
            __CLASS__,
            ContainerFactory::class
        ));
    }
}
