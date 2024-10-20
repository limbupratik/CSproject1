<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CoinController extends Controller
{

    public function transfer(Request $request)
    {
        // If a form submission is detected
        if ($request->isMethod('post')) {
            $recipientEmail = $request->input('recipient_email');
            $amount = $request->input('amount');

            $recipient = User::where('email', $recipientEmail)->first();

            if (!$recipient) {
                return redirect()->back()->with('error', 'Recipient not found.');
            }

            // Logic to check if the user has enough coins
            $user = Auth::user();
            if ($user->coins < $amount) {
                return redirect()->back()->with('error', 'Not enough coins to transfer.');
            }

            // Deduct the coins from the sender
            $user->coins -= $amount;
            $user->save();

            // Add the coins to the recipient
            $recipient->coins += $amount;
            $recipient->save();

            return redirect()->route('home')->with('success', 'Coins transferred successfully!');
        }

        return view('tranfer');
    }
}
