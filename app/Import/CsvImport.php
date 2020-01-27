<?php

namespace App\Import;

use App\Good;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class CsvImport implements ImportInterface
{
    public function __construct()
    {
        $this->preset = $this->getPreset();
    }

    protected function getPreset(): array
    {
        $preset = Config::get('rules.defaultPreset');

        return $preset;
    }

    /**
     * import
     *
     * @param  mixed $file
     *
     * @return string
     */
    public function import(\SplFileInfo $file): string
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

            $validator = Validator::make($field, $this->preset);

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
                    'discount' => $field['Discontinued'],
                ]);
                $good->save();
            }
        }

        $result = "Imported! Total: " . count($rows) . " Skipped: " . count($errors);

        return $result;
    }

}