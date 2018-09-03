<?php

namespace EntityTranslator\Type;

class FloatType implements Type
{
    /**
     * @inheritdoc
     * @return float
     */
    public function translateForDb($value)
    {
        return (float)$value;
    }

    /**
     * @inheritdoc
     * @return float
     */
    public function translateForEntity($value)
    {
        return (float)$value;
    }
}