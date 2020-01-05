<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = [
        'stock', 'cost', 'user_id', 'product_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
