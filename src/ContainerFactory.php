<?php

namespace Geekish\Slimbox;

use mindplay\unbox\ContainerFactory as UnboxFactory;

final class ContainerFactory extends UnboxFactory
{
    /**
     * Create and bootstrap a new `Container` instance
     *
     * @return Container
     */
    public function createContainer()
    {
        return new Container($this);
    }
}
