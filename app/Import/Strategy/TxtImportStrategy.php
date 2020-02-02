<?php

namespace App\Import\Strategy;

class TxtImportStrategy implements ImportInterface
{
    public const TYPE = 'txt';

    public function import(\SplFileInfo $file): array
    {
        return [
            'type'          => static::TYPE,
            'fileName'      => $file,
            'success'       => rand(0, 100),
            'error'         => rand(0, 100),
            'errorMessages' => [
                'Not valid data',
            ],
        ];
    }
}
