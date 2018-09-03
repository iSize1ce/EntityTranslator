<?php

namespace EntityMapper;

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

    public function getBool()
    {
        return $this->bool;
    }

    public function setBool($bool)
    {
        $this->bool = $bool;
    }
}

/**
 * @group unit
 */
class EntityTranslatorTest extends TestCase
{
    private function getEntityTranslator()
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
            'unused' => 'do not put it in object'
        ];

        $entity = $translator->makeEntityFromDbArray($arrayFromDb);

        $expectedEntity = new TestEntity();
        $expectedEntity->float = 123.123;
        $expectedEntity->int = 123;
        $expectedEntity->dateTime = new \DateTime('2018-08-08 08:14:58');
        $expectedEntity->string = 'string';
        $expectedEntity->json = ['test' => 1, 'anotherTest' => 2];
        $expectedEntity->setBool(true);

        $this->assertEquals($expectedEntity, $entity);
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
        $entity->dateTime = new \DateTime('2018-08-08 08:14:58');
        $entity->string = 'string';
        $entity->json = ['test' => 1, 'anotherTest' => 2];
        $entity->setBool(true);

        $dbArray = $translator->makeDbArrayFromEntity($entity);

        $expectedArray = [
            'float_field' => '123.123',
            'int_field' => '123',
            'dateTime_field' => '2018-08-08 08:14:58',
            'string_field' => 'string',
            'json' => '{"test":1,"anotherTest":2}',
            'bool_field' => '1'
        ];

        $this->assertEquals($expectedArray, $dbArray);
    }
}