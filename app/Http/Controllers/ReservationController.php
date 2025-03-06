<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Annonce;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Notifications\NewReservationNotification;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'annonce_id' => 'required|exists:annonces,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        // créer une reservation utiliser une donnees validées
        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'annonce_id' => $validated['annonce_id'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
        ]);

        // récuperer les annonces de propriétaire
        $annonce = Annonce::findOrFail($validated['annonce_id']);
        $proprietaire = User::findOrFail($annonce->user_id);

        // notifié le propriétaire pour une nouvelle reservation
        $proprietaire->notify(new NewReservationNotification($reservation));

        //redreger vers la page de paiment
        return redirect()->route('paiement.show', ['reservation' => $reservation->id])
                        ->with('message', 'Vous devez payer pour finaliser votre réservation.');
    }
}
