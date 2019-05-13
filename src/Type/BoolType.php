<?php

namespace EntityTranslator\Type;

class BoolType implements TypeInterface
{
    public function translateForDb($value): int
    {
        return (bool)(int)$value;
    }

    public function translateForEntity($value): bool
    {
        return (bool)$value;
    }
}