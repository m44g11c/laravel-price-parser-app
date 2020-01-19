<?php

namespace App\Import;

use App\Import\NotFoundImportStrategyException;

interface ImportInterface
{
    public function import($file);
}

class ImportService
{
    private $type;
    private $types = [];

    /**
     * addType
     *
     * @param  mixed $type
     * @param  mixed $typeName
     *
     * @return void
     */
    public function addType(ImportInterface $type, string $typeName)
    {
        $this->types[$typeName] = $type;
    }

    /**
     * setType
     *
     * @param  mixed $type
     *
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * getImport
     *
     * @param  mixed $type
     * 
     * @throw \Exception
     * 
     * @return ImportInterface
     */
    public function getImport(string $type): ImportInterface
    {
        if (isset($this->types[$type])) {
            return $this->types[$this->type];
        } else {
            throw new NotFoundImportStrategyException('Any import strategy was not found for this type');
        }
    }
}
