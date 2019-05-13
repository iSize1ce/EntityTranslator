<?php

namespace EntityTranslator\Type;

class JsonType implements TypeInterface
{
    public function translateForDb($value): string
    {
        return json_encode($value);
    }

    public function translateForEntity($value): array
    {
        return json_decode($value, true);
    }
}