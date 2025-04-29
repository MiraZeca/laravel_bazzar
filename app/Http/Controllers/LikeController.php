<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function toggle($product_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to like a product.');
        }

        $like = Like::where('user_id', Auth::id())
            ->where('product_id', $product_id)
            ->first();

        if ($like) {
            // Ako već postoji, obriši ga (dislike)
            $like->delete();
            return back()->with('success', 'Product disliked.');
        } else {
            // Ako ne postoji, kreiraj novi like
            Like::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
            ]);
            return back()->with('success', 'Product liked!');
        }
    }

    public function myLikes()
    {
        $userId = Auth::id(); // Preuzimanje ID-a prijavljenog korisnika

        if (!$userId) {
            // Provera da li je korisnik prijavljen
            return redirect()->route('login')->with('error', 'Morate biti prijavljeni da biste videli lajkovane proizvode.');
        }

        // Prikupljanje lajkovanih proizvoda za određenog korisnika
        $likedProducts = Like::where('user_id', $userId)
            ->with('product') // Učitavanje proizvoda povezanih sa lajkom
            ->get()
            ->pluck('product'); // Prikupljanje samo informacija o proizvodima

        return view('likes.my', compact('likedProducts'));
    }
}
