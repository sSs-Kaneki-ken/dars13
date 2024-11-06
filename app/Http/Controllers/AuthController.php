<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        $categories = Category::orderBy('tr', 'asc')->get();
        return view('pages.login-register.loginPage',['models'=>$categories]);
    }
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:5'
            ]
        );
        // dd($request->all());
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return redirect('/');
        }else{
            return redirect('/login');
        }
    }
    public function registerPage()
    {
        $categories = Category::orderBy('tr', 'asc')->get();
        return view('pages.login-register.registerPage',['models'=>$categories]);
    }
    public function register(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:5'
            ]
            );
        $user = User::create($data);

        Auth::login($user);
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
