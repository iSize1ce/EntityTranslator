# EntityTranslator

```php
$entityTranslator = new EntityTranslator(SomeYourEntity::class);
$entityTranslator->addProperty('boolProperty', 'bool_property', BoolType::class, EntityProperty::VISIBILITY_PUBLIC)
$entityTranslator->addProperty('dateTimeProperty', 'date_time_property', DateTimeType::class, EntityProperty::VISIBILITY_PUBLIC)
$entityTranslator->addProperty('dateProperty', 'date_property', DateType::class, EntityProperty::VISIBILITY_PUBLIC)
$entityTranslator->addProperty('floatProperty', 'float_property', FloatType::class, EntityProperty::VISIBILITY_PUBLIC)
$entityTranslator->addProperty('intProperty', 'int_property', IntType::class, EntityProperty::VISIBILITY_PUBLIC)
$entityTranslator->addProperty('jsonProperty', 'json_property', JsonType::class, EntityProperty::VISIBILITY_PUBLIC)
$entityTranslator->addProperty('stringProperty', 'string_property', StringType::class, EntityProperty::VISIBILITY_GET_SET);
```

## Translate strategy

Properties
Getters/setters

## Supported types 

Boolean
DateTime
Date (DateTime)
Float
Integer
Json
String

## Example

```php
<?php

use EntityTranslator\EntityProperty;
use EntityTranslator\EntityTranslator;
use EntityTranslator\Type\BoolType;
use EntityTranslator\Type\DateTimeType;
use EntityTranslator\Type\DateType;
use EntityTranslator\Type\FloatType;
use EntityTranslator\Type\IntType;
use EntityTranslator\Type\JsonType;
use EntityTranslator\Type\StringType;

class MyEntity
{
    /**
     * @var int
     */
    public $boolProperty;

    /**
     * @var DateTime
     */
    public $dateTimeProperty;

    /**
     * @var DateTime
     */
    public $dateProperty;

    /**
     * @var float
     */
    public $floatProperty;

    /**
     * @var int
     */
    public $intProperty;

    /**
     * @var array|object
     */
    public $jsonProperty;

    /**
     * @var string|null
     */
    private $stringProperty;

    public function getStringProperty(): string
    {
        return $this->stringProperty;
    }

    public function setStringProperty(string $stringProperty): void
    {
        $this->stringProperty = $stringProperty;
    }
}

class MyRepository
{
    /**
     * @var EntityTranslator
     */
    private $entityTranslator;

    public function __construct()
    {
        $this->entityTranslator = (new EntityTranslator(MyEntity::class))
            ->addProperty('boolProperty', 'bool_property', BoolType::class, EntityProperty::VISIBILITY_PUBLIC)
            ->addProperty('dateTimeProperty', 'date_time_property', DateTimeType::class, EntityProperty::VISIBILITY_PUBLIC)
            ->addProperty('dateProperty', 'date_property', DateType::class, EntityProperty::VISIBILITY_PUBLIC)
            ->addProperty('floatProperty', 'float_property', FloatType::class, EntityProperty::VISIBILITY_PUBLIC)
            ->addProperty('intProperty', 'int_property', IntType::class, EntityProperty::VISIBILITY_PUBLIC)
            ->addProperty('jsonProperty', 'json_property', JsonType::class, EntityProperty::VISIBILITY_PUBLIC)
            ->addProperty('stringProperty', 'string_property', StringType::class, EntityProperty::VISIBILITY_GET_SET);
    }

    public function getById(): MyEntity
    {
        // Database result
        $array = [
            'bool_property' => '1',
            'date_time_property' => '2019-01-01 12:34:56',
            'date_property' => '2019-01-01',
            'float_property' => '123.456',
            'int_property' => '123',
            'json_property' => '{"test":true}',
        ];

        return $this->entityTranslator->makeEntityFromDbArray($array);
    }
}
```
