<?php

namespace App\Http\Controllers;

use App\Import\ImportService;
use App\Import\CsvImport;
use App\Import\TxtImport;
use App\Import\NotFoundImportStrategyException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImportController extends Controller
{
    public function import()
    {
        $importService = new ImportService();
        $importService->addType(new CsvImport(), 'csv');
        $importService->addType(new TxtImport(), 'txt');

        $file = request()->file('file');

        if (!$file instanceof UploadedFile) {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'No file added']);    
        }

        $importService->setType($file->getClientOriginalExtension());

        try {
            $result = $importService->getImport($file->getClientOriginalExtension())->import($file);
        } catch (NotFoundImportStrategyException $exception) {
            return redirect()
                ->back()
                ->withErrors(['msg' => $exception->getMessage()]);    
        }
        
        return redirect()
            ->back()
            ->with("status", $result);
    }
}
