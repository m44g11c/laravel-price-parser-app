<?php

namespace App\Http\Controllers;

use App\Good;
use App\Product;
use Illuminate\Support\Facades\Auth;

class ImportController extends Controller
{
    public function import()
    {
        $file = request()->file('file');
        $rows = array_map('str_getcsv', file($file));
        $header = array_shift($rows);
        $data = array();

        foreach ($rows as $row) {
            if (count($row) == count($header)) {
                $data[] = array_combine($header, $row);
            }
        }

        foreach ($data as $key => $field) {
            $product = Product::firstOrCreate([
                'code' => $field['Product Code'], 
                'name' => $field['Product Name'], 
                'description' => $field['Product Description'],
            ]);

            $good = new Good([
                'stock' => intval($field['Stock']), 
                'cost' => intval($field['Cost in GBP']), 
                'user_id' => Auth::id(), 
                'product_id' => $product->id,
            ]);
            $good->save();
        }
        
        return redirect()->back()->with("status", "Total records: ".count($rows)." Imported: ".count($data) );
    }
}
