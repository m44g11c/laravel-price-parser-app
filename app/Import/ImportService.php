<?php

namespace App\Import;

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

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function import($file)
    {
        return $this->types[$this->type]->import($file);
    }
}
