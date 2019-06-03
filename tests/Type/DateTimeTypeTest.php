<?php

namespace EntityTranslator\Type;

use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @covers DateTimeType
 */
class DateTimeTypeTest extends TestCase
{
    public function testTranslateForDb()
    {
        $expected = '2019-06-03 23:30:12';
        $actual = (new DateTimeType())->translateForDb(
            new DateTime('2019-06-03 23:30:12')
        );

        $this->assertEquals($expected, $actual);
    }

    public function testTranslateForEntity()
    {
        $expected = new DateTime('2019-06-03 23:30:12');
        $actual = (new DateTimeType())->translateForEntity('2019-06-03 23:30:12');

        $this->assertEquals($expected, $actual);
    }
}