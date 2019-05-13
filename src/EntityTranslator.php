<?php

namespace EntityTranslator;

class EntityTranslator
{
    /**
     * @var EntitySchema
     */
    private $entitySchema;

    public function __construct(string $entityClass)
    {
        $this->entitySchema = new EntitySchema($entityClass);
    }

    /**
     * @param mixed[] $array
     * @return mixed
     */
    public function makeEntityFromDbArray(array $array)
    {
        return $this->entitySchema->makeEntityFromDbArray($array);
    }

    /**
     * @param mixed $entity
     * @return mixed[]
     */
    public function makeDbArrayFromEntity($entity): array
    {
        return $this->entitySchema->makeDbArrayFromEntity($entity);
    }

    public function addProperty(string $propertyName, string $dbFieldName, string $typeClass, string $visibility = EntityProperty::VISIBILITY_PUBLIC): EntityTranslator
    {
        $this->entitySchema->addProperty($propertyName, $dbFieldName, $typeClass, $visibility);

        return $this;
    }
}