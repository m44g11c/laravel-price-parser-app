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

    public function addType(ImportInterface $type, string $typeName)
    {
        $this->types[$typeName] = $type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @throw \Exception
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
