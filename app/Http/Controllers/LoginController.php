<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }

        $allProducts = Product::with(['category', 'warehouse'])->get();
        $userComments = Comment::where('user_id', Auth::id())->latest()->get();

        return view('login.user', compact('allProducts', 'userComments'));
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role->name === 'admin') {
                return redirect()->route('admin')
                    ->with('role', 'admin')
                    ->with('success', 'Successful Login!');
            } else {
                return redirect()->route('user')
                    ->with('role', 'user')
                    ->with('success', 'Successful Login!');
            }
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
