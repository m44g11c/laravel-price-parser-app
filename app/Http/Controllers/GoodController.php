<?php

namespace App\Http\Controllers;

use App\Good;

class GoodController extends Controller
{
    // Get all goods
    public function goods()
    {
        $goods = Good::with('product')->paginate(15);

        return view('welcome', compact('goods'));
    }
}
