<?php

namespace EntityTranslator\Type;

use PHPUnit\Framework\TestCase;

/**
 * @group unit
 * @covers JsonType
 */
class JsonTypeTest extends TestCase
{
    public function testTranslateForDb()
    {
        $expected = '{"test":true,"hello":"world"}';
        $actual = (new JsonType())->translateForDb([
            'test' => true,
            'hello' => 'world'
        ]);

        $this->assertEquals($expected, $actual);
    }

    public function testTranslateForEntity()
    {
        $expected = [
            'test' => true,
            'hello' => 'world'
        ];
        $actual = (new JsonType())->translateForEntity('{"test":true,"hello":"world"}');

        $this->assertEquals($expected, $actual);
    }
}