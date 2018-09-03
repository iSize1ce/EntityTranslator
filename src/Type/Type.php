<?php

namespace EntityTranslator\Type;

interface Type
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public function translateForDb($value);

    /**
     * @param mixed $value
     * @return mixed
     */
    public function translateForEntity($value);
}