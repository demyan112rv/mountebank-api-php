<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Response\Behavior\Config;

use Demyan112rv\MountebankPHP\Response\Behavior\Config;

/**
 * Class Repeat
 * @package Demyan112rv\MountebankPHP\Response\Behavior\Config
 * @see http://www.mbtest.org/docs/api/behaviors#behavior-repeat
 * @since 0.8
 */
class Repeat implements Config
{
    /**
     * The number of times to repeat this response.
     *
     * @var int
     */
    protected $value;

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Repeat
     */
    public function setValue(int $value): Repeat
    {
        $this->value = $value;
        return $this;
    }
}