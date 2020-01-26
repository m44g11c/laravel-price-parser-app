<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Good extends Model
{
    use Sortable;

    protected $fillable = [
        'stock', 'cost', 'user_id', 'product_id', 'discount',
    ];

    public $sortable = [
        'id', 'stock', 'cost', 'discount',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
