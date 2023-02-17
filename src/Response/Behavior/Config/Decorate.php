<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Response\Behavior\Config;

use Demyan112rv\MountebankPHP\Response\Behavior\Config;

/**
 * Class Decorate
 * @package Demyan112rv\MountebankPHP\Response\Behavior\Config
 * @see http://www.mbtest.org/docs/api/behaviors#behavior-decorate
 * @since 0.8
 */
class Decorate implements Config
{
    /**
     * The decorate function accepts the request, response, and the logger.
     * It either changes the response directly and returns nothing, or returns a new response object.
     * If you return a new response, all fields that you want included must be set;
     * it will not be merged with the old response.
     * The --allowInjection command line flag must be set to support passing in a JavaScript function
     * @var string
     */
    private string $js;

    public function getJs(): string
    {
        return $this->js;
    }

    public function setJs(string $js): Decorate
    {
        $this->js = $js;
        return $this;
    }
}