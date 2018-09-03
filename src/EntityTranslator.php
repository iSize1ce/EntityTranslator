<?php

namespace EntityTranslator;

use EntityTranslator\Type\Type;

class EntityTranslator
{
    /**
     * @var string
     */
    private $entityClass;

    /**
     * @var EntityProperty[]
     */
    private $properties = [];

    /**
     * @param string $entityClass
     */
    public function __construct($entityClass)
    {
        $this->entityClass = $entityClass;
    }

    /**
     * @param array $array
     * @return mixed
     */
    public function makeEntityFromDbArray(array $array)
    {
        $entityClass = $this->getEntityClass();
        $entity = new $entityClass();

        foreach ($this->getProperties() as $property) {
            $value = $array[$property->getDbFieldName()];
            $typeClass = $property->getTypeClass();

            if ($value !== null) {
                /** @var Type $type */
                $type = new $typeClass();

                $value = $type->translateForEntity($value);
            }

            if ($property->isGetSetVisibility()) {
                $entity->{$property->getSetMethodName()}($value);
            }
            else {
                $entity->{$property->getPropertyName()} = $value;
            }
        }

        return $entity;
    }

    /**
     * @param mixed $entity
     * @return array
     */
    public function makeDbArrayFromEntity($entity)
    {
        $result = [];
        foreach ($this->getProperties() as $property) {
            $typeClass = $property->getTypeClass();

            if ($property->isGetSetVisibility()) {
                $value = $entity->{$property->getGetMethodName()}();
            }
            else {
                $value = $entity->{$property->getPropertyName()};
            }

            if ($value !== null) {
                /** @var Type $type */
                $type = new $typeClass();

                $value = $type->translateForDb($value);
            }

            $result[$property->getDbFieldName()] = $value;
        }

        return $result;
    }

    /**
     * @param string $propertyName
     * @param string|null $dbFieldName Если null - принимает значение propertyName
     * @param string $typeClass
     * @param string $visibility
     * @see EntityProperty
     * @return $this
     */
    public function addProperty($propertyName, $dbFieldName, $typeClass, $visibility = EntityProperty::VISIBILITY_PUBLIC)
    {
        if ($dbFieldName === null) {
            $dbFieldName = $propertyName;
        }

        $this->properties[$propertyName] = new EntityProperty($propertyName, $dbFieldName, $typeClass, $visibility);

        return $this;
    }

    /**
     * @param string $propertyName
     * @return null|EntityProperty
     */
    public function getProperty($propertyName)
    {
        return isset($this->properties[$propertyName]) ? $this->properties[$propertyName] : null;
    }

    /**
     * @return EntityProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }
}