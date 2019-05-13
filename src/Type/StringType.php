<?php

namespace EntityTranslator\Type;

class StringType implements TypeInterface
{
    public function translateForDb($value): string
    {
        return (string)$value;
    }

    public function translateForEntity($value): string
    {
        return (string)$value;
    }
}