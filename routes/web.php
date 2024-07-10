<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserList;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientBailleurController;
use App\Http\Controllers\VoyageurController;
use Illuminate\Foundation\Http\Kernel;
use App\Http\Controllers\admin\BiensImmobilierAdmin;
use App\Http\Controllers\admin\DashboardAdmin;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


Route::fallback(function () {
    return view('publicView'); // Utilise cette vue pour toutes les routes non trouvées
});


Route::get('/privateView', function () {
    return redirect()->route('voyageur.search');
})->middleware(['auth', 'verified'])->name('privateView');

Route::get('/publicView', function () {
    return view('publicView');
})->name('publicView');

Route::get('/', function () {
    return redirect()->route('publicView');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// route client bailleur
Route::middleware(['auth','isClientBailleur'])->prefix('client-bailleur')->group(function () {
    Route::get('/', [ClientBailleurController::class, 'index'])->name('client_bailleur.index');
    Route::get('/reservations', [ClientBailleurController::class, 'reservations'])->name('client_bailleur.reservations');
    Route::get('/create', [ClientBailleurController::class, 'create'])->name('client_bailleur.create');
    Route::post('/', [ClientBailleurController::class, 'store'])->name('client_bailleur.store');
    Route::get('/{bienImmobilier}', [ClientBailleurController::class, 'show'])->name('client_bailleur.show');
    Route::get('/{bienImmobilier}/edit', [ClientBailleurController::class, 'edit'])->name('client_bailleur.edit');
    Route::put('/{bienImmobilier}', [ClientBailleurController::class, 'update'])->name('client_bailleur.update');
    Route::delete('/{bienImmobilier}', [ClientBailleurController::class, 'destroy'])->name('client_bailleur.destroy');
    Route::get('/reservations-futures', [ClientBailleurController::class, 'futureReservations'])->name('client_bailleur.future_reservations');
    Route::get('/reservations-passees', [ClientBailleurController::class, 'pastReservations'])->name('client_bailleur.past_reservations');
    Route::post('/{bienImmobilier}/update-disponibilites', [ClientBailleurController::class, 'updateBlockedDates'])->name('client_bailleur.updateBlockedDates');
    Route::delete('/reservations/{id}', [ClientBailleurController::class, 'cancelReservation'])->name('client_bailleur.cancelReservation');
    Route::put('/reservations/{id}/accept', [ClientBailleurController::class, 'acceptReservation'])->name('client_bailleur.acceptReservation');

});

Route::middleware(['auth'])->prefix('voyageur')->group(function () {
    Route::get('/search', [VoyageurController::class, 'search'])->name('voyageur.search');
    Route::get('/reservations', [VoyageurController::class, 'reservations'])->name('voyageur.reservations');
    Route::post('/handle-search', [VoyageurController::class, 'handleSearch'])->name('voyageur.handleSearch');
    Route::get('/results', [VoyageurController::class, 'results'])->name('voyageur.results');
    Route::get('/{id}', [VoyageurController::class, 'show'])->name('voyageur.show');
    Route::post('/{id}/reserve', [VoyageurController::class, 'reserve'])->name('voyageur.reserve');
    Route::put('/reservations/{id}/cancel', [VoyageurController::class, 'cancelReservation'])->name('voyageur.cancelReservation');
});

// route pour la navbar
Route::middleware(['auth'])->prefix('profil')->group(function () {
    Route::get('/', [Controller::class, 'profil'])->name('profil');
});

Route::middleware(['auth', 'admin'])->prefix('backoffice')->group(function (){
    Route::get('/adminPanel', [DashboardAdmin::class, 'numberUserAll'])->name('adminPanel');


    Route::get('/adminBiensImmo', [BiensImmobilierAdmin::class,'show'])->name('logementAdmin');
    Route::get('/adminBiensImmo/create', [BiensImmobilierAdmin::class, 'add'])->name('adminBien.create');
    Route::post('/adminBiensImmo/store', [BiensImmobilierAdmin::class, 'store'])->name('adminBien.store');
    Route::get('/adminBiensImmo/{id}/edit', [BiensImmobilierAdmin::class, 'edit'])->name('adminBien.edit');
    Route::put('/adminBiensImmo/{id}/update', [BiensImmobilierAdmin::class, 'update'])->name('adminBien.update');
    Route::patch('//adminBiensImmo{id}/update-statut', [BiensImmobilierAdmin::class, 'updateStatut'])->name('adminBien.updateStatut');
    Route::get('/adminBiensImmo/{id}', [BiensImmobilierAdmin::class, 'showOne'])->name('adminBien.show');
    Route::delete('/adminBiensImmo/{id}/delete', [BiensImmobilierAdmin::class, 'delete'])->name('adminBien.delete');


    Route::get('/adminUsers/list', [UserList::class, 'show'])->name('user.show');
    Route::get('/adminUsers/list/{id}/edit', [UserList::class,'edit'])->name('user.edit');
    Route::put('/adminUsers/list/{id}/update', [UserList::class,'update'])->name('user.update');
    Route::get('/adminUsers/add', [UserList::class,'add'])->name('user.add');
    Route::post('/adminUsers/check', [UserList::class,'checkAdd'])->name('user.check');
    Route::delete('/adminUsers/list/{id}/delete', [UserList::class,'delete'])->name('user.delete');

});


// Simuler une erreur 405 MethodNotAllowedHttpException
Route::get('/test-405', function () {
    throw new MethodNotAllowedHttpException([]);
});

// Simuler une erreur 403 AuthorizationException
Route::get('/test-403', function () {
    abort(403);
});

Route::get('/test-500', function () {
    abort(500); // Simuler une erreur 500 Internal Server Error
});

Route::get('/test-419', function () {
    abort(419); // Simuler une erreur 419 CSRF token mismatch
});
