<?php

namespace EntityTranslator\Type;

class JsonType implements Type
{
    /**
     * @inheritdoc
     * @return string
     */
    public function translateForDb($value)
    {
        return json_encode($value);
    }

    /**
     * @param string $value
     * @return array
     */
    public function translateForEntity($value)
    {
        return json_decode($value, true);
    }
}