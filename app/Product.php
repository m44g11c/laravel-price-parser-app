<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;

    protected $fillable = [
        'code', 'name', 'description',
    ];

    public $sortable = [
        'code', 'name', 'description',
    ];

    public function good()
    {
        return $this->hasMany('App\Good', 'product_id');
    }
}
