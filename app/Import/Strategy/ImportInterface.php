<?php

namespace App\Import\Strategy;

interface ImportInterface
{
    public function import (\SplFileInfo $file): array;
}
