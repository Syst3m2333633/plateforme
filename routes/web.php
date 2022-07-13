<?php

use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DropzoneController;
use GuzzleHttp\Psr7\Request;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::resource('user', UserController::class);
// Route::get('client/{client:slug}', function (Client $clients) {
//     return $clients;
// });
Route::get('client/trash', [ClientController::class, 'trash'])->name('client.trash');
Route::get('client/{client}/restore', [ClientController::class, 'restore'])->withTrashed()->name('client.restore');
Route::get('client/{client}/update', [ClientController::class, 'update'])->name('client.update');

//Route::get('client/{client:slug}/show', [ClientController::class, 'edit'])->name('clientShow');
Route::get('client/{client}/image', [ClientController::class, 'image'])->name('client.image');
Route::get('/search', [ClientController::class, 'search']);
// Route::get('/search', function (Request $request){
//     return Client::search($request->search)->get();
// });

Route::resource('client', ClientController::class, ['parameters' =>['client' => 'client:slug']]);

Route::get('dropzone', [DropzoneController::class, 'dropzone']);
Route::post('dropzone/store', [DropzoneController::class, 'dropzoneStore'])->name('dropzone.store');
Route::post('droplogo/store', [DropzoneController::class, 'droplogoStore'])->name('droplogo.store');

Route::post('dropfactures/store', [DropzoneController::class, 'dropfacturesStore'])->name('dropfactures.store');
Route::post('dropevent/store', [DropzoneController::class, 'dropeventStore'])->name('dropevent.store');

Route::resource('event', EventController::class);
Route::resource('devis', DevisController::class);
// Route::resource('factures', FactureController::class);



