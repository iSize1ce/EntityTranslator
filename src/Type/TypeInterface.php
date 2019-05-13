<?php

namespace EntityTranslator\Type;

interface TypeInterface
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