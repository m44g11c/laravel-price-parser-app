<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckFile;
use App\Import\ImportStrategyServiceInterface;
use App\Import\NotFoundImportStrategyException;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class ImportController extends Controller
{

    public function __construct(ImportStrategyServiceInterface $importStrategyService)
    {
        $this->importStrategyService = $importStrategyService;        
    }

    public function import(CheckFile $request)
    {
        $file = request()->file('file');
        $importStrategy = $this->importStrategyService
            ->getImportStrategy($file->getClientOriginalExtension());
        $data = $importStrategy->import($file);

        switch (request()->input('radios')) {
            case 'insert':
                $result = $importStrategy->insert($data);
                break;
            case 'replace':
                $result = $importStrategy->replace($data);
                break;
            case 'delete':
                $result = $importStrategy->delete($data);
                break; 
        }
    
        return redirect()
            ->back()
            ->with("status", $result);
    
    }
}
