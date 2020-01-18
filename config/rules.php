<?php

return [
    'defaultPreset' => [
        'Product Code' => 'required',
        'Product Name' => 'required',
        'Product Description' => 'required',
        'Stock' => 'gt:10',
        'Cost in GBP' => 'gt:5|lte:1000',
    ]
];