<?php

namespace EntityTranslator\Type;

class FloatType implements TypeInterface
{
    public function translateForDb($value): string
    {
        return (string)$value;
    }

    public function translateForEntity($value): float
    {
        return (float)$value;
    }
}