<?php

namespace App\Import;

interface ImportInterface
{
    public function import(\SplFileInfo $file): string;
}