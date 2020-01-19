<?php

namespace App\Http\Controllers;

use App\Import\ImportService;
use App\Import\CsvImport;
use App\Import\TxtImport;
use App\Import\NotFoundImportStrategyException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImportController extends Controller
{

    private $import;

    public function __construct(ImportService $import)
    {
        $this->import = $import;
        $this->import->addType(new CsvImport(), 'csv');
        $this->import->addType(new TxtImport(), 'txt');
    }

    public function import()
    {
        $file = request()->file('file');

        if (!$file instanceof UploadedFile) {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'No file added']);    
        }

        $this->import->setType($file->getClientOriginalExtension());

        try {
            $result = $this->import->getImport($file->getClientOriginalExtension())->import($file);
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
