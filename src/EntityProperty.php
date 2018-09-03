<?php

namespace EntityTranslator;

class EntityProperty
{
    const VISIBILITY_PUBLIC  = 'public';
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
     * @see Type
     */
    private $typeClass;

    /**
     * @var string
     */
    private $visibility;

    /**
     * @param string $entityPropertyName
     * @param string $dbFieldName
     * @param string $typeClass
     * @param string $visibility
     */
    public function __construct($entityPropertyName, $dbFieldName, $typeClass, $visibility)
    {
        $this->propertyName = $entityPropertyName;
        $this->dbFieldName  = $dbFieldName;
        $this->typeClass    = $typeClass;
        $this->visibility   = $visibility;
    }

    /**
     * @return string
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * @return string
     */
    public function getDbFieldName()
    {
        return $this->dbFieldName;
    }

    /**
     * @return string
     * @see Type
     */
    public function getTypeClass()
    {
        return $this->typeClass;
    }

    /**
     * @return bool
     */
    public function isPublicVisibility()
    {
        return $this->visibility === self::VISIBILITY_PUBLIC;
    }

    /**
     * @return bool
     */
    public function isGetSetVisibility()
    {
        return $this->visibility === self::VISIBILITY_GET_SET;
    }

    /**
     * @return string
     */
    public function getGetMethodName()
    {
        return 'get' . ucfirst($this->getPropertyName());
    }

    /**
     * @return string
     */
    public function getSetMethodName()
    {
        return 'set' . ucfirst($this->getPropertyName());
    }
}