<?php

namespace EntityTranslator\Type;

class IntType implements Type
{
    /**
     * @inheritdoc
     * @return int
     */
    public function translateForDb($value)
    {
        return (int)$value;
    }

    /**
     * @inheritdoc
     * @return int
     */
    public function translateForEntity($value)
    {
        return (int)$value;
    }
}