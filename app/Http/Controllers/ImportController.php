<?php

namespace App\Http\Controllers;

use App\Import\ImportService;
use App\Import\CsvImport;
use App\Import\TxtImport;

class ImportController extends Controller
{
    public function import()
    {
        $importService = new ImportService();
        $importService->addType(new CsvImport(), 'csv');
        $importService->addType(new TxtImport(), 'txt');

        $file = request()->file('file');
        $importService->setType($file->getClientOriginalExtension());
        $result = $importService->import($file);

        return redirect()
            ->back()
            ->with("status", $result);
    }
}
