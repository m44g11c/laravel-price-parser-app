<?php

namespace App\Http\Controllers;

use App\Good;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users/index', compact('users'));
    }

    public function goods()
    {
        $user_id = Auth::id();
        $goods = Good::with('product')->where('user_id', $user_id)->paginate(15);
        
        return view('home', compact('goods'));
    }
}
