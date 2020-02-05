<?php

namespace App\Import\Strategy;

use App\Import\Importer;

class TxtImportStrategy extends Importer implements ImportInterface
{
    public const TYPE = 'txt';

    /**
     * import
     *
     * @param  mixed $file
     *
     * @return array
     */
    public function import(\SplFileInfo $file): array
    {
        $rows = array_map(function ($val) {
            return explode(',', $val);
        }, file($file));

        $header = array_shift($rows);
        $headerLastValue = array_pop($header);
        $header[] = str_replace("\n", "", $headerLastValue);
        $data = [];

        foreach ($rows as $row) {
            if (count($row) == count($header)) {
                $data[] = array_combine($header, $row);
            }
        }

        return $data;
    }
}
