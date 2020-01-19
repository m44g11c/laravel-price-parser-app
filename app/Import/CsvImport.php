<?php

namespace App\Import;

use App\Good;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class CsvImport implements ImportInterface
{
    
    /**
     * import
     *
     * @param  mixed $file
     *
     * @return string
     */
    public function import($file): string
    {
        $rows = array_map('str_getcsv', file($file));
        $header = array_shift($rows);
        $data = [];
        $errors = [];

        foreach ($rows as $row) {
            if (count($row) == count($header)) {
                $data[] = array_combine($header, $row);
            }
        }

        foreach ($data as $key => $field) {
            $field['Cost in GBP'] = intval($field['Cost in GBP']);
            $field['Stock'] = intval($field['Stock']);

            $validator = Validator::make($field, Config::get('rules.defaultPreset'));

            if ($validator->fails()) {
                $errors[$key] = $validator->errors();
            } else {
                $product = Product::firstOrCreate([
                    'code' => $field['Product Code'],
                    'name' => $field['Product Name'],
                    'description' => $field['Product Description'],
                ]);

                $good = new Good([
                    'stock' => $field['Stock'],
                    'cost' => $field['Cost in GBP'],
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                ]);
                $good->save();
            }
        }

        $result = "Imported! Total: " . count($rows) . " Skipped: " . count($errors);

        return $result;
    }
}