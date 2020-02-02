<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;

    protected $fillable = [
        'id', 'code', 'name', 'description',
    ];

    public $sortable = [
        'id', 'code', 'name', 'description',
    ];

    public function good()
    {
        return $this->hasMany('App\Good', 'product_id');
    }
}
