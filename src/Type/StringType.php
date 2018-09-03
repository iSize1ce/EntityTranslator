<?php

namespace EntityTranslator\Type;

class StringType implements Type
{
    /**
     * @inheritdoc
     * @return string
     */
    public function translateForDb($value)
    {
        return (string)$value;
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function translateForEntity($value)
    {
        return (string)$value;
    }
}