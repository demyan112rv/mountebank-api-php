<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Response\Behavior\Config;

use Demyan112rv\MountebankPHP\Response\Behavior\Config;

/**
 * Class ShellTransform
 * @package Demyan112rv\MountebankPHP\Response\Behavior\Config
 * @see http://www.mbtest.org/docs/api/behaviors#behavior-shellTransform
 * @since 0.8
 */
class ShellTransform implements Config
{
    /**
     * Represents the path to a command line application.
     * The application should retrieve the JSON-encoded request
     * and response from the environment and print out the transformed response to stdout.
     *
     * The --allowInjection command line flag must be set to support this behavior.
     */
    private string $value;

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValues(string $value): ShellTransform
    {
        $this->value = $value;
        return $this;
    }
}