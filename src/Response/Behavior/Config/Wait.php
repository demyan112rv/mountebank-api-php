<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Response\Behavior\Config;

use Demyan112rv\MountebankPHP\Response\Behavior\Config;

/**
 * Class Wait
 * @package Demyan112rv\MountebankPHP\Response\Behavior\Config
 * @see http://www.mbtest.org/docs/api/behaviors#behavior-wait
 * @since 0.8
 */
class Wait implements Config
{
    /**
     * If a number is passed in, mountebank will wait that number of milliseconds before returning.
     */
    private ?int $value = null;

    /**
     * If a string is passed in, it is expected to be a parameterless JavaScript function
     * that returns the number of milliseconds to wait.
     * The --allowInjection command line flag must be set to support passing in a JavaScript function
     */
    private ?string $js = null;

    /**
     * @return int
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): Wait
    {
        $this->value = $value;
        return $this;
    }

    public function getJs(): ?string
    {
        return $this->js;
    }

    public function setJs(string $js): Wait
    {
        $this->js = $js;
        return $this;
    }
}