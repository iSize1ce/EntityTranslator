<?php

namespace EntityTranslator\Type;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @covers IntType
 */
class IntTypeTest extends TestCase
{
    public function testTranslateForDb()
    {
        $expected = '123';
        $actual = (new IntType())->translateForDb(123);

        $this->assertEquals($expected, $actual);
    }

    public function testTranslateForEntity()
    {
        $expected = 123;
        $actual = (new IntType())->translateForEntity('123');

        $this->assertEquals($expected, $actual);
    }
}