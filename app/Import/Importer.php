<?php

namespace App\Import;

use App\Good;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class Importer
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

    public function insert(array $data): string
    {
        $errors = [];

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

        $result = "Imported! Total: " . count($data) . " Skipped: " . count($errors);

        return $result;
    }

    public function replace(array $data): string
    {
        foreach ($data as $key => $field) {
            $field['Cost in GBP'] = intval($field['Cost in GBP']);
            $field['Stock'] = intval($field['Stock']);

            $product = Product::updateOrCreate(['code' => $field['Product Code']], [
                'name' => $field['Product Name'],
                'description' => $field['Product Description']
            ]);

            Good::updateOrCreate([
                'user_id' => Auth::id(),
                'product_id' => $product->id], [
                'stock' => $field['Stock'],
                'cost' => $field['Cost in GBP']
            ]);
        }

        $result = "Updated! Total: " . count($data);

        return $result;
    }

    public function delete(array $data): string
    {
        $deleted = 0;

        foreach ($data as $key => $field) {
            $product = Product::where('code', $field['Product Code'])->get();

            if ($product->isNotEmpty()) {
                $good = Good::where('user_id', '=',  Auth::id())
                    ->where('product_id', '=', $product[0]->id)->get();
                if ($good->isNotEmpty()) {
                    $deleted++;
                    Good::destroy($good[0]->id);
                }
            }
        }

        $result = "Deletion! Total: " . count($data) . " Deleted: " . $deleted;

        return $result;
    }
}
