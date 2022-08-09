<?php

// use Bouncer;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\EventController;
// use App\Http\Controllers\FactureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // dd(Client::first()->role);
    return view('auth.login');
});

// Route::group(['middleware' => 'auth'], function() {
//     Route::group([
//         // 'prefix' => 'admin',
//         'middleware' => 'is_admin',
//         // 'as' => 'admin.',
//     ], function() {
//     });
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('client/trash', [ClientController::class, 'trash'])
    ->name('client.trash');

Route::get('client/{client}/restore', [ClientController::class, 'restore'])
    ->withTrashed()
    ->name('client.restore');

Route::get('/search', [ClientController::class, 'search']);
Route::get('/client', [ClientController::class, 'index'])
    ->name('client.index');
Route::get('client/profil', [ClientController::class, 'profil'])
    ->name('client.profil');
Route::get('client/{client}/image', [ClientController::class, 'image'])
    ->name('client.image');
Route::resource('client', ClientController::class,
    ['parameters' => ['client' => 'client:slug']]);

Route::resource('user', UserController::class);

Route::get('dropzone', [DropzoneController::class, 'dropzone']);
Route::post('droplogo/store', [DropzoneController::class, 'droplogoStore'])
    ->name('droplogo.store');

Route::post('dropevent/store', [DropzoneController::class, 'dropeventStore'])
    ->name('dropevent.store');

Route::post('dropFacturesStore/store', [DropzoneController::class, 'store'])
    ->name('dropFacturesStore.store');
Route::get('facture/{facture}/download', [FactureController::class, 'downloadFacture'])
    ->name('facture.download');
    Route::get('facture.index', [FactureController::class, 'indexe'])->name('facture.indexe');
Route::resource('facture', FactureController::class);

Route::get('event/{event}/download', [EventController::class, 'downloadEvent'])
    ->name('event.download');
Route::resource('event', EventController::class);

Route::get('devis/{devi}/download', [DevisController::class, 'downloadDevis'])
    ->name('devis.download');
Route::get('devis.index', [DevisController::class, 'indexe'])->name('devis.indexe');
Route::resource('devis', DevisController::class);
