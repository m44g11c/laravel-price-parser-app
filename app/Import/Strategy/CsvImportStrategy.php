<?php

namespace App\Import\Strategy;

use App\Import\Importer;

class CsvImportStrategy extends Importer implements ImportInterface
{
    public const TYPE = 'csv';

    /**
     * import
     *
     * @param  mixed $file
     *
     * @return array
     */
    public function import(\SplFileInfo $file): array
    {
        $rows = array_map('str_getcsv', file($file));
        $header = array_shift($rows);
        $data = [];

        foreach ($rows as $row) {
            if (count($row) == count($header)) {
                $data[] = array_combine($header, $row);
            }
        }

        return $data;
    }
}
