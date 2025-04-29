<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validacija unosa
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
    
    
        // Kreiranje komentara u bazi
        Comment::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);
    
        return redirect()->back()->with('success', 'Your comment has been added!');
    }
    
}
