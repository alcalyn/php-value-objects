<?php


namespace PhpValueObjects\Tests\Scalar;


class StringNullableValueObjectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function itShouldReturnNull()
    {
        $nullable = new StringNullableValueObject(null);

        $this->assertNull($nullable->value());
    }
}
