<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionMail;
        
class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validacija e-mail adrese
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        // Snimanje e-mail adrese u bazu podataka
        Subscription::create([
            'email' => $request->email,
        ]);

        // Slanje e-maila korisniku
        Mail::to($request->email)->send(new SubscriptionMail($request->email));

        // Možeš dodati obaveštenje o uspehu
        return back()->with('success', 'Thank you for subscribing!');
    }


     
    
}
