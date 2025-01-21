<?php

use Illuminate\Support\Facades\Route;

// Models
use App\Models\User;
use App\Models\Source;
use App\Models\Beneficiaire;


// Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FinancingController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\MotifController;
use App\Http\Controllers\BesoinController;
use App\Http\Controllers\EntreeController;
use App\Http\Controllers\DepenseController;

// Others
use Illuminate\Support\Facades\Hash;


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

Route::get('/passwords', function () {
    $plain_passwords = [
        "CpBe#08_10@2023",
        "CmRiL#08_10@2023",
        "pOrPeE@2023_#08_10",
        "ePpRoE@2023_#08_10",
        "jOsPiE@2023_#08_10",
        "eJpSoI@2023_#08_10",
        "mIKEmEnA@2023_#08_10",
        "OpPassword@2024",
        "p@ssword",
        "Joelle@2024",
        "88aFxP8TyFoKy7W" // For gestcaissetest 'hacker account'
    ];

    $encrypted_passwords = [];
    foreach ($plain_passwords as $key => $value) {
        array_push($encrypted_passwords, Hash::make($value));
    }

    return "Go Away !";
    return $encrypted_passwords;
    // return "Go Away !";
});

// Authentication route
Route::view('/login', 'auth.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', function() {
    auth()->logout();
    return redirect('/');
})->name('logout');


Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::post('/home', 'App\Http\Controllers\HomeController@index_search')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons');
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});


// Financing sources routes
Route::get('/financings', [FinancingController::class, 'index'])->name('financings.index');
Route::get('/financings/create', [FinancingController::class, 'create'])->name('financings.create');
Route::get('/financings/{source}/edit', [FinancingController::class, 'edit'])->name('financings.edit');
Route::post('/financings', [FinancingController::class, 'store'])->name('financings.store');
Route::put('/financings/{source}', [FinancingController::class, 'update'])->name('financings.update');
Route::delete('/financings/{source}', [FinancingController::class, 'destroy'])->name('financings.destroy');

// Beneficiary routes
Route::get('/beneficiaries', [BeneficiaireController::class, 'index'])->name('beneficiaries.index');
Route::get('/beneficiaries/create', [BeneficiaireController::class, 'create'])->name('beneficiaries.create');
Route::get('/beneficiaries/{beneficiaire}/edit', [BeneficiaireController::class, 'edit'])->name('beneficiaries.edit');
Route::post('/beneficiaries', [BeneficiaireController::class, 'store'])->name('beneficiaries.store');
Route::put('/beneficiaries/{beneficiaire}', [BeneficiaireController::class, 'update'])->name('beneficiaries.update');
Route::delete('/beneficiaries/{beneficiaire}', [BeneficiaireController::class, 'destroy'])->name('beneficiaries.destroy');

// Motif routes
Route::get('/motifs', [MotifController::class, 'index'])->name('motifs.index');
Route::get('/motifs/create', [MotifController::class, 'create'])->name('motifs.create');
Route::get('/motifs/{motif}/edit', [MotifController::class, 'edit'])->name('motifs.edit');
Route::post('/motifs', [MotifController::class, 'store'])->name('motifs.store');
Route::put('/motifs/{motif}', [MotifController::class, 'update'])->name('motifs.update');
Route::delete('/motifs/{motif}', [MotifController::class, 'destroy'])->name('motifs.destroy');

// Besoin routes
Route::get('/besoins', [BesoinController::class, 'index'])->name('besoins.index');
Route::get('/besoins/accepte', [BesoinController::class, 'index_accepte'])->name('besoins.index.accepte');
Route::get('/besoins/refuse', [BesoinController::class, 'index_refuse'])->name('besoins.index.refuse');
Route::get('/besoins/attente', [BesoinController::class, 'index_attente'])->name('besoins.index.attente');
Route::get('/besoins/approvisionner/{besoin}', [BesoinController::class, 'index_approvisionner'])->name('besoins.index.approvisionner');
Route::get('/besoins/create', [BesoinController::class, 'create'])->name('besoins.create');
Route::get('/besoins/{besoin}/edit', [BesoinController::class, 'edit'])->name('besoins.edit');
Route::post('/besoins', [BesoinController::class, 'store'])->name('besoins.store');
Route::post('/besoins/validation/{besoin}', [BesoinController::class, 'validation'])->name('besoins.validation');
Route::post('/besoins/approvisionner/{besoin}', [BesoinController::class, 'approvisionner'])->name('besoins.approvisionner');
Route::put('/besoins/{besoin}', [BesoinController::class, 'update'])->name('besoins.update');
Route::delete('/besoins/{besoin}', [BesoinController::class, 'destroy'])->name('besoins.destroy');


// Entrée routes
Route::get('/entrees', [EntreeController::class, 'index'])->name('entrees.index');
Route::get('/entrees/create', [EntreeController::class, 'create'])->name('entrees.create');
Route::get('/entrees/{entree}/edit', [EntreeController::class, 'edit'])->name('entrees.edit');
Route::post('/entrees', [EntreeController::class, 'store'])->name('entrees.store');
Route::put('/entrees/{entree}', [EntreeController::class, 'update'])->name('entrees.update');
Route::delete('/entrees/{entree}', [EntreeController::class, 'destroy'])->name('entrees.destroy');

// Depense routes
Route::get('/depenses', [DepenseController::class, 'index'])->name('depenses.index');
Route::get('/depenses/attente', [DepenseController::class, 'index_attente'])->name('depenses.index.attente');
Route::get('/depenses/approuve/{depense}', [DepenseController::class, 'approuve'])->name('depenses.approuve');
Route::get('/depenses/create', [DepenseController::class, 'create'])->name('depenses.create');
Route::get('/depenses/{depense}/edit', [DepenseController::class, 'edit'])->name('depenses.edit');
Route::post('/depenses', [DepenseController::class, 'store'])->name('depenses.store');
Route::put('/depenses/{depense}', [DepenseController::class, 'update'])->name('depenses.update');
Route::delete('/depenses/{depense}', [DepenseController::class, 'destroy'])->name('depenses.destroy');
