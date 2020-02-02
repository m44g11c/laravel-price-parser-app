<?php

namespace App\Http\Controllers;

use App\Import\ImportStrategyServiceInterface;
use App\Import\NotFoundImportStrategyException;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class ImportController extends Controller
{

    public function __construct(ImportStrategyServiceInterface $importStrategyService)
    {
        $this->importStrategyService = $importStrategyService;        
    }

    public function import()
    {
        $file = request()->file('file');

        if (!$file instanceof UploadedFile) {
            return redirect()
                ->back()
                ->withErrors(['msg' => 'No file added']);    
        }

        try {
            $importStrategy = $this->importStrategyService->getImportStrategy($file->getClientOriginalExtension());
        } catch (NotFoundImportStrategyException $exception) {
            return redirect()
                ->back()
                ->withErrors(['msg' => $exception->getMessage()]);    
        }

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
