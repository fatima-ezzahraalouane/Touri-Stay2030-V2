<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaiementController extends Controller
{
    public function show($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        return view('paiment', compact('reservation'));
    }

    public function process(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create the charge
            $charge = Charge::create([
                'amount' => 1000,
                'currency' => 'eur',
                'source' => $request->stripeToken, // Token from the form
                'description' => 'Payment for reservation',
            ]);

            return redirect()->route('touriste.dashboard')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
