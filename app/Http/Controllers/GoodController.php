<?php

namespace App\Http\Controllers;

use App\Good;
use Illuminate\Support\Facades\Config;

class GoodController extends Controller
{
    // Get all goods
    public function goods()
    {
        $goods = Good::with('product', 'user')->sortable()->paginate(Config::get('constants.paginationValue'));

        return view('welcome', compact('goods'));
    }
}
