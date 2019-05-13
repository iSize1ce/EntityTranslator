<?php

namespace EntityTranslator\Type;

class IntType implements TypeInterface
{
    public function translateForDb($value): int
    {
        return (int)$value;
    }

    public function translateForEntity($value): int
    {
        return (int)$value;
    }
}