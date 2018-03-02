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
     * @var int|null
     */
    protected $value;

    /**
     * If a string is passed in, it is expected to be a parameterless JavaScript function
     * that returns the number of milliseconds to wait.
     * The --allowInjection command line flag must be set to support passing in a JavaScript function
     * @var string|null
     */
    protected $js;

    /**
     * @return int
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Wait
     */
    public function setValue(int $value): Wait
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getJs(): ?string
    {
        return $this->js;
    }

    /**
     * @param string $js
     * @return Wait
     */
    public function setJs(string $js): Wait
    {
        $this->js = $js;
        return $this;
    }
}