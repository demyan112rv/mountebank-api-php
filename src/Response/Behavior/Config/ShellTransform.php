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
     * Each array element represents the path of a command line application.
     * The application should accept the JSON-encoded request and response as arguments
     * and print out the transformed response to stdout.
     *
     * @var array
     */
    protected $values;

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array $values
     * @return ShellTransform
     */
    public function setValues(array $values): ShellTransform
    {
        $this->values = $values;
        return $this;
    }
}