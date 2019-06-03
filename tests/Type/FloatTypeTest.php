<?php

namespace EntityTranslator\Type;

use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @covers FloatType
 */
class FloatTypeTest extends TestCase
{
    public function testTranslateForDb()
    {
        $expected = '5325325.32532';
        $actual = (new FloatType())->translateForDb(5325325.32532);

        $this->assertEquals($expected, $actual);
    }

    public function testTranslateForEntity()
    {
        $expected = 5325325.32532;
        $actual = (new FloatType())->translateForEntity('5325325.32532');

        $this->assertEquals($expected, $actual);
    }
}