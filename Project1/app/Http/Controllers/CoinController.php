<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;

class CoinController extends Controller
{

    public function transfer(Request $request)
{
    // If a form submission is detected
    if ($request->isMethod('post')) {
        // Validate the request input
        $request->validate([
            'recipient_email' => 'required|email',
            'amount' => 'required|integer|min:1',
        ]);

        // Get the recipient and amount from the request
        $recipientEmail = $request->input('recipient_email');
        $amount = $request->input('amount');

        // Find the recipient user by their email
        $recipient = User::where('email', $recipientEmail)->first();

        if (!$recipient) {
            return redirect()->back()->with('error', 'Recipient not found.');
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has enough coins
        if ($user->coins < $amount) {
            return redirect()->back()->with('error', 'Not enough coins to transfer.');
        }

        // Deduct coins from the sender
        $user->coins -= $amount;
        $user->save();

        // Add coins to the recipient
        $recipient->coins += $amount;
        $recipient->save();

        // Redirect with success message
        return redirect()->route('home')->with('success', 'Coins transferred successfully!');
    }

    // Return the transfer view if it's a GET request
    return view('tranfer');
}

public function transactionHistory()
{
    $user = Auth::user();

    // Get all transactions where the user is the sender
    $transactions = Transaction::where('sender_id', $user->id)
        ->with('recipient') // Load recipient details
        ->orderBy('created_at', 'desc')
        ->get();

    return view('history', compact('transactions'));
}


}
