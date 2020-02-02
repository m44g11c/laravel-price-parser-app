<?php

namespace App\Import;

use App\Import\Strategy\ImportInterface;

interface ImportStrategyServiceInterface
{
    /**
     * Return list of available import strategies
     *
     * @return ImportInterface[]
     */
    public function getAvailableImportStrategies(): array;

    /**
     * Return import strategy by type
     *
     * @param string $type
     *
     * @return ImportInterface
     */
    public function getImportStrategy(string $type): ImportInterface;
}
