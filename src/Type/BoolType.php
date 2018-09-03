<?php

namespace EntityTranslator\Type;

class BoolType implements Type
{
    /**
     * @inheritdoc
     * @return bool
     */
    public function translateForDb($value)
    {
        return (bool)(int)$value;
    }

    /**
     * @inheritdoc
     * @return bool
     */
    public function translateForEntity($value)
    {
        return (bool)$value;
    }
}