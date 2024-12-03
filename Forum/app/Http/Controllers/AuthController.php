<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Topic;

class AuthController extends Controller
{
    public function login(Request $request) {
        if ($request->method() === 'GET') {
            return view('auth.login');
        } else {
                $credentials = $request->validate([
                                    'email' => 'required|string|email',
                                    'password' => 'required|string'
                                ]);
            if (Auth::attempt($credentials)) {
                return redirect()
                        ->intended('/users')
                        ->with('success', 'Login realizado com sucesso.');
            }
            return back()->withErrors([
                'email' => 'Credenciais inválidas.',
            ])->withInput();
        }
    }

    public function teste(){


        $tags = Tag::all();  
        $categories = Category::all();
        $topics = Topic::all();    

        return view('topics.TopicsAll', compact('tags','categories','topics'));
        
        

    }


    public function logoutUser(Request $request) {
        Auth::logout();
        return redirect()
                    ->route('login')
                    ->with('success', 'Logout realizado com sucesso.');
    }
}
