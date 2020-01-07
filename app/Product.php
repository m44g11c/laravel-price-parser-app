<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code', 'name', 'description',
    ];

    public function good()
    {
        return $this->hasMany('App\Good', 'product_id');
    }
}
