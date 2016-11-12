<?php

namespace Geekish\Slimbox;

use Slim\Collection;

final class Settings extends Collection
{
    /**
     * Default settings
     *
     * @var array
     */
    private $defaultSettings = [
        'httpVersion' => '1.1',
        'responseChunkSize' => 4096,
        'outputBuffering' => 'append',
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => false,
        'addContentLengthHeader' => true,
        'routerCacheFile' => false,
    ];

    /**
     * @param array $userSettings Slim-specific settings
     */
    public function __construct(array $userSettings = [])
    {
        parent::__construct(array_merge($this->defaultSettings, $userSettings));
    }
}
