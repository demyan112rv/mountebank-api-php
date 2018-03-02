<?php

declare(strict_types=1);

namespace Demyan112rv\MountebankPHP\Response\Behavior\Config;

use Demyan112rv\MountebankPHP\Response\Behavior\Config;

/**
 * Class Copy
 * @package Demyan112rv\MountebankPHP\Response\Behavior\Config
 * @see http://www.mbtest.org/docs/api/behaviors#behavior-lookup
 * @since 0.8
 */
class Lookup implements Config
{
    /**
     * A list of objects specifying the key (copied from a request field),
     * the data source, and the response token
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
     * @return Lookup
     */
    public function setValues(array $values): Lookup
    {
        $this->values = $values;
        return $this;
    }
}