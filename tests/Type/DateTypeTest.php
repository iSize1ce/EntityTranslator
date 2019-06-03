<?php

namespace EntityTranslator\Type;

use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @covers DateType
 */
class DateTypeTest extends TestCase
{
    public function testTranslateForDb()
    {
        $expected = '2019-06-03';
        $actual = (new DateType())->translateForDb(
            new DateTime('2019-06-03 00:00:00')
        );

        $this->assertEquals($expected, $actual);
    }

    public function testTranslateForEntity()
    {
        $expected = new DateTime('2019-06-03 00:00:00');
        $actual = (new DateType())->translateForEntity('2019-06-03');

        $this->assertEquals($expected, $actual);
    }
}