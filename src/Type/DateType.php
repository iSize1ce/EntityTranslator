<?php

namespace EntityTranslator\Type;

use DateTime;

class DateType implements TypeInterface
{
    public function translateForDb($value): string
    {
        return $value->format('Y-m-d');
    }

    public function translateForEntity($value): DateTime
    {
        return new DateTime($value);
    }
}