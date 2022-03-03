<?php

namespace PhpValueObjects\Tests;

use Faker\Factory;
use Faker\Generator;

abstract class BaseUnitTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Generator
     */
    private $faker;

    /**
     * @return Generator
     */
    protected function faker()
    {
        return $this->faker = $this->faker ?: Factory::create();
    }
}
