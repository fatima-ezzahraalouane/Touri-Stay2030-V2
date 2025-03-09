<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\Charge;

class PaiementController extends Controller
{
    /**
     * Afficher la page de paiement avec les détails de la réservation.
     */
    public function show($reservationId)
    {
        // Récupérer la réservation
        $reservation = Reservation::findOrFail($reservationId);
        return view('paiement', compact('reservation'));
    }

    /**
     * Traiter le paiement via Stripe.
     */
    public function process(Request $request)
    {
        // Récupérer la réservation
        $reservation = Reservation::findOrFail($request->reservation_id);

        // Définir la clé API Stripe
        // Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Convertir le prix en centimes (Stripe attend un montant en cents)
            $amount = $reservation->prix_total * 100;

            // Créer la transaction avec Stripe
            $charge = Charge::create([
                'amount' => 1000,
                'currency' => 'eur',
                'source' => $request->stripeToken, // Token Stripe généré par le formulaire
                'description' => 'Paiement pour la réservation',
            ]);

            // Mettre à jour l'état de la réservation
            // $reservation->update(['status' => 'payé']);

            // Rediriger vers la page de confirmation avec un message de succès
            // return redirect()->route('success', ['reservation' => $reservation->id])
            //     ->with('success', 'Paiement réussi !');
            return redirect()->route('touriste.dashboard')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            // Rediriger en cas d'erreur
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
