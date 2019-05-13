<?php

namespace EntityTranslator\Type;

use DateTime;

class DateTimeType implements TypeInterface
{
    public function translateForDb($value): string
    {
        return $value->format('Y-m-d H:i:s');
    }

    public function translateForEntity($value): DateTime
    {
        return new DateTime($value);
    }
}