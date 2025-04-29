<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $allProducts = Product::with('category')->get();
    
        $categories = Category::with('products')->get();
    
        $comments = Comment::with('user')->get();
    
        return view('index', compact('allProducts', 'categories', 'comments'));
    }
    

    public function showCommentForm()
    {
        return view('comment');
    }

    public function storeComment(Request $request)
    {
        // Proveri da li je korisnik ulogovan
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to leave a comment.');
        }
        
        // Validacija unosa
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);
        
        // Sačuvaj komentar u bazu
        Comment::create([
            'user_id' => Auth::id(), // Koristi ID ulogovanog korisnika
            'comment' => $request->comment,
        ]);
        
        return redirect()->route('user')->with('success', 'Comment successfully added!');
    }

    
    
}