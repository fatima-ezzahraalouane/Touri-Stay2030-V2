<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\TouristeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route principale du dashboard qui redirige selon le rôle de l'utilisateur
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'touriste') {
        return redirect()->route('touriste.dashboard');
    } elseif (auth()->user()->role === 'proprietaire') {
        return redirect()->route('proprietaire.dashboard');
    } elseif (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return abort(403, 'Accès non autorisé');
})->middleware(['auth', 'verified'])->name('dashboard');


// Dashboard pour les touristes
Route::middleware(['auth', 'verified', 'role:touriste'])->group(function () {
    Route::get('/touriste/dashboard', [TouristeController::class, 'dashboard'])->name('touriste.dashboard');

 // Page des favoris
 Route::get('/touriste/favorites', function () {
    return view('touriste.favorites');
})->name('touriste.favorites');

// Routes pour mettre à jour le profil
Route::put('/touriste/profile/update', [ProfileController::class, 'update'])->name('touriste.profile.update');

Route::get('/search', [TouristeController::class, 'search'])->name('touriste.search');
Route::get('/annonces/{id}', [TouristeController::class, 'showAnnonce'])->name('touriste.annonce.show');
Route::get('/favorites', [TouristeController::class, 'favorites'])->name('touriste.favorites');
Route::post('/toggle-favorite', [TouristeController::class, 'toggleFavorite'])->name('touriste.toggle-favorite');

// reservation and paiement 
Route::get('stripe',[StripeController::class,'index']);
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/paiement/{reservation}', [PaiementController::class, 'show'])->name('paiement.show');
Route::post('/process-paiement', [PaiementController::class, 'process'])->name('paiement.process');
    // Lister les réservations de l'utilisateur
    // Route::get('/reservations', [ReservationController::class, 'index'])
    //      ->name('reservations.index');

    // Afficher les détails d'une réservation spécifique
    // Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])
    //      ->name('reservations.show');

    // Annuler une réservation
    // Route::put('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])
    //      ->name('reservations.cancel');

    Route::post('/check-availability', [ReservationController::class, 'checkAvailability'])
    ->name('check.availability');

    Route::get('/invoice/{id}', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


 //  propriétaires routes
Route::middleware(['auth', 'role:proprietaire'])->prefix('proprietaire')->group(function () {
    Route::get('/dashboard', [ProprietaireController::class, 'dashboard'])->name('proprietaire.dashboard');
    
    Route::resource('annonces', ProprietaireController::class);
    // Notification routes
Route::get('/proprietaire/notifications', [NotificationController::class, 'index'])->name('proprietaire.notifications');
Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unreadCount');
 
});

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.userprofile');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.userprofile.update');
Route::post('/profile/photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.userprofile.photo');

// administrateurs routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');
    Route::delete('/annonces/{id}', [AdminController::class, 'deleteAnnonce'])
            ->name('admin.annonces.delete');
            Route::get('/paiement',[AdminController::class,'paiement'])
            ->name('admin.paiement');
            Route::get('/reservation',[AdminController::class,'reservation'])
            ->name('admin.reservation');     
    });


require __DIR__.'/auth.php';