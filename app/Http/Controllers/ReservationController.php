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

    public function checkAvailability(Request $request)
    {
        Log::info('Availability Check Request:', $request->all());

        $validated = $request->validate([
            'annonce_id' => 'required|exists:annonces,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut'
        ]);

        // récupérez annonce pour vérifier sa disponibilité
        $annonce = Annonce::findOrFail($validated['annonce_id']);

        Log::info('Annonce Availability:', [
            'disponible_du' => $annonce->disponible_du,
            'disponible_au' => $annonce->disponible_au
        ]);

        // vérifiez si les dates sont dans la disponibilité de l'annonce
        if (
            new \DateTime($validated['date_debut']) < $annonce->disponible_du ||
            new \DateTime($validated['date_fin']) > $annonce->disponible_au
        ) {
            Log::warning('Dates outside annonce availability');
            return response()->json(['available' => false]);
        }

        // verifiez les réservations qui se chevauchent
        $overlappingReservation = Reservation::where('annonce_id', $validated['annonce_id'])
            ->where('statut', '!=', 'annulée')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('date_debut', [$validated['date_debut'], $validated['date_fin']])
                    ->orWhereBetween('date_fin', [$validated['date_debut'], $validated['date_fin']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('date_debut', '<=', $validated['date_debut'])
                            ->where('date_fin', '>=', $validated['date_fin']);
                    });
            })
            ->get(); // passez à get() pour inspecter les résultats

        Log::info('Overlapping Reservations:', [
            'count' => $overlappingReservation->count(),
            'details' => $overlappingReservation->toArray()
        ]);

        return response()->json([
            'available' => $overlappingReservation->count() === 0,
            'overlapping' => $overlappingReservation->toArray()
        ]);
    }
}
