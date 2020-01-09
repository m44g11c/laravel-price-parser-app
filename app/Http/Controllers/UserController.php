<?php

namespace App\Http\Controllers;

use App\Good;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function goods()
    {
        $user_id = Auth::id();
        $goods = Good::with('product')->where('user_id', $user_id)->paginate(15);
        
        return view('home', compact('goods'));
    }
}
