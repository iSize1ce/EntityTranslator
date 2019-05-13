<?php

namespace EntityMapper;

use DateTime;
use EntityTranslator\EntityProperty;
use EntityTranslator\EntityTranslator;
use EntityTranslator\Type\BoolType;
use EntityTranslator\Type\DateTimeType;
use EntityTranslator\Type\FloatType;
use EntityTranslator\Type\IntType;
use EntityTranslator\Type\JsonType;
use EntityTranslator\Type\StringType;
use PHPUnit\Framework\TestCase;

class TestEntity
{
    public $float;

    public $int;

    public $dateTime;

    public $string;

    public $json;

    public $unused;

    private $bool;

    public function getBool(): bool
    {
        return $this->bool;
    }

    public function setBool(bool $bool): void
    {
        $this->bool = $bool;
    }
}

/**
 * @group unit
 */
class EntityTranslatorTest extends TestCase
{
    /**
     * @covers EntityTranslator::makeEntityFromDbArray()
     */
    public function test_makeEntityFromDbArray()
    {
        $translator = $this->getEntityTranslator();

        $arrayFromDb = [
            'float_field' => '123.123',
            'int_field' => '123',
            'dateTime_field' => '2018-08-08 08:14:58',
            'string_field' => 'string',
            'json' => '{"test":1,"anotherTest":2}',
            'bool_field' => '1',
            'unused' => 'do not put it in object',
        ];

        $actual = $translator->makeEntityFromDbArray($arrayFromDb);

        $expected = new TestEntity();
        $expected->float = 123.123;
        $expected->int = 123;
        $expected->dateTime = new DateTime('2018-08-08 08:14:58');
        $expected->string = 'string';
        $expected->json = ['test' => 1, 'anotherTest' => 2];
        $expected->setBool(true);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers EntityTranslator::makeDbArrayFromEntity()
     */
    public function test_makeDbArrayFromEntity()
    {
        $translator = $this->getEntityTranslator();

        $entity = new TestEntity();
        $entity->float = 123.123;
        $entity->int = 123;
        $entity->dateTime = new DateTime('2018-08-08 08:14:58');
        $entity->string = 'string';
        $entity->json = ['test' => 1, 'anotherTest' => 2];
        $entity->setBool(true);

        $actual = $translator->makeDbArrayFromEntity($entity);

        $expected = [
            'float_field' => '123.123',
            'int_field' => '123',
            'dateTime_field' => '2018-08-08 08:14:58',
            'string_field' => 'string',
            'json' => '{"test":1,"anotherTest":2}',
            'bool_field' => '1',
        ];

        $this->assertEquals($expected, $actual);
    }

    private function getEntityTranslator(): EntityTranslator
    {
        $entityTranslator = new EntityTranslator(TestEntity::class);

        $entityTranslator->addProperty('float', 'float_field', FloatType::class);
        $entityTranslator->addProperty('int', 'int_field', IntType::class);
        $entityTranslator->addProperty('dateTime', 'dateTime_field', DateTimeType::class);
        $entityTranslator->addProperty('string', 'string_field', StringType::class);
        $entityTranslator->addProperty('json', null, JsonType::class);
        $entityTranslator->addProperty('bool', 'bool_field', BoolType::class, EntityProperty::VISIBILITY_GET_SET);

        return $entityTranslator;
    }
}