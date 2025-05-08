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
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        Subscription::create([
            'email' => $request->email,
        ]);

        Mail::to($request->email)->send(new SubscriptionMail($request->email));

        return back()->with('success', 'Thank you for subscribing!');
    }

        public function index()
    {
        $subscriptions = Subscription::latest()->get(); 
        return view('admin.subscribes', compact('subscriptions'));
    }
    
}
