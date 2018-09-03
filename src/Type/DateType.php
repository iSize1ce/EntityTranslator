<?php

namespace EntityTranslator\Type;

class DateType implements Type
{
    /**
     * @param \DateTime $value
     * @return string
     */
    public function translateForDb($value)
    {
        return $value->format('Y-m-d');
    }

    /**
     * @inheritdoc
     * @return \DateTime
     */
    public function translateForEntity($value)
    {
        return new \DateTime($value);
    }
}