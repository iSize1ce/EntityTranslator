<?php

namespace EntityTranslator\Type;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @covers BoolType
 */
class BoolTypeTest extends TestCase
{
    public function testTranslateForDb()
    {
        $expected = '1';
        $actual = (new BoolType())->translateForDb(true);

        $this->assertEquals($expected, $actual);
    }

    public function testTranslateForEntity()
    {
        $expected = true;
        $actual = (new BoolType())->translateForEntity('1');

        $this->assertEquals($expected, $actual);
    }
}