<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Response\Behavior\Config;

use Demyan112rv\MountebankPHP\Response\Behavior\Config;

/**
 * Class Copy
 * @package Demyan112rv\MountebankPHP\Response\Behavior\Config
 * @see http://www.mbtest.org/docs/api/behaviors#behavior-copy
 * @since 0.8
 */
class Copy implements Config
{
    /**
     * A list of objects specifying the request field and response token,
     * as well as a way of selecting the value from the request field
     *
     * @var array<string, mixed>
     */
    private array $values;

    /**
     * @param array<string, mixed> $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return array<string, mixed>
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @deprecated now used __construct()
     * @param array<string, mixed> $values
     */
    public function setValues(array $values): Copy
    {
        $this->values = $values;
        return $this;
    }
}