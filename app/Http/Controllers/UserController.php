<?php

namespace App\Http\Controllers;

use App\Good;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users/index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users/edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'string',
            'email' => 'email',
            'password' => 'string',
        ]);

        if (isset($request->password)) {
           $validatedData['password'] = bcrypt($validatedData['password']); 
        }

        User::whereId($id)->update($validatedData);

        return redirect('/admin/users')->with('success', 'User updated');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'User has been deleted');
    }

    public function goods()
    {
        $user_id = Auth::id();
        $goods = Good::with('product')->where('user_id', $user_id)->paginate(Config::get('constants.paginationValue'));
        
        return view('home', compact('goods'));
    }
}
