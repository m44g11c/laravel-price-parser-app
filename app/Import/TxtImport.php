<?php

namespace App\Import;

class TxtImport implements ImportInterface
{
    public function import(\SplFileInfo $file): string
    {
        return "Txt import will be ready soon";
    }
}