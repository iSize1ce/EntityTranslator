<?php

namespace EntityTranslator\Type;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @covers StringType
 */
class StringTypeTest extends TestCase
{
    public function testTranslateForDb()
    {
        $expected = 'hello, world!';
        $actual = (new StringType())->translateForDb('hello, world!');

        $this->assertEquals($expected, $actual);
    }

    public function testTranslateForEntity()
    {
        $expected = 'hello, world!';
        $actual = (new StringType())->translateForEntity('hello, world!');

        $this->assertEquals($expected, $actual);
    }
}