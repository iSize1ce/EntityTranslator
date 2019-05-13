<?php

namespace EntityTranslator;

class EntityProperty
{
    const VISIBILITY_PUBLIC = 'public';
    const VISIBILITY_GET_SET = 'getSet';

    /**
     * @var string Entity class property name
     */
    private $propertyName;

    /**
     * @var string Name of db column
     */
    private $dbFieldName;

    /**
     * @var string Type class
     * @see TypeInterface
     */
    private $typeClass;

    /**
     * @var string
     */
    private $visibility;

    public function __construct(string $entityPropertyName, string $dbFieldName, string $typeClass, string $visibility)
    {
        $this->propertyName = $entityPropertyName;
        $this->dbFieldName = $dbFieldName;
        $this->typeClass = $typeClass;
        $this->visibility = $visibility;
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    public function getDbFieldName(): string
    {
        return $this->dbFieldName;
    }

    /**
     * @see TypeInterface
     */
    public function getTypeClass(): string
    {
        return $this->typeClass;
    }

    public function isPublicVisibility(): bool
    {
        return $this->visibility === self::VISIBILITY_PUBLIC;
    }

    public function isGetSetVisibility(): bool
    {
        return $this->visibility === self::VISIBILITY_GET_SET;
    }

    public function getGetMethodName(): string
    {
        return 'get' . ucfirst($this->getPropertyName());
    }

    public function getSetMethodName(): string
    {
        return 'set' . ucfirst($this->getPropertyName());
    }
}