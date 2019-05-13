<?php

namespace EntityTranslator;

use EntityTranslator\Type\TypeInterface;

class EntitySchema
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
    public function __construct(string $entityClass)
    {
        $this->entityClass = $entityClass;
    }

    /**
     * @param mixed[] $array
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
                /** @var TypeInterface $type */
                $type = new $typeClass();

                $value = $type->translateForEntity($value);
            }

            if ($property->isGetSetVisibility()) {
                $entity->{$property->getSetMethodName()}($value);
            } else {
                $entity->{$property->getPropertyName()} = $value;
            }
        }

        return $entity;
    }

    /**
     * @param mixed $entity
     * @return mixed[]
     */
    public function makeDbArrayFromEntity($entity): array
    {
        $result = [];
        foreach ($this->getProperties() as $property) {
            $typeClass = $property->getTypeClass();

            if ($property->isGetSetVisibility()) {
                $value = $entity->{$property->getGetMethodName()}();
            } else {
                $value = $entity->{$property->getPropertyName()};
            }

            if ($value !== null) {
                /** @var TypeInterface $type */
                $type = new $typeClass();

                $value = $type->translateForDb($value);
            }

            $result[$property->getDbFieldName()] = $value;
        }

        return $result;
    }

    public function addProperty(string $propertyName, ?string $dbFieldName, string $typeClass, string $visibility = EntityProperty::VISIBILITY_PUBLIC): EntitySchema
    {
        if ($dbFieldName === null) {
            $dbFieldName = $propertyName;
        }

        $this->properties[$propertyName] = new EntityProperty($propertyName, $dbFieldName, $typeClass, $visibility);

        return $this;
    }

    public function getProperty(string $propertyName): ?EntityProperty
    {
        return $this->properties[$propertyName] ?? null;
    }

    /**
     * @return EntityProperty[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getEntityClass(): string
    {
        return $this->entityClass;
    }
}