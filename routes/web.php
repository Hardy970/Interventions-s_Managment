<?php

use App\Models\TypeIntervention;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EquipeController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\SocieteController;
use App\Http\Controllers\Admin\VehiculeController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\ChauffeurController;
use App\Http\Controllers\Admin\DemandeurController;
use App\Http\Controllers\Admin\ConsultantController;
use App\Http\Controllers\Admin\TypeDemandeController;
use App\Http\Controllers\Admin\InterventionController;
use App\Http\Controllers\Admin\FaitGenerateurController;
use App\Http\Controllers\Admin\TypeInterventionController;

Route::get('/', function () {
    return view('pages.dashboard');
})->middleware('auth');

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function(){
    Route::get('dashboard',function(){
        return view('pages.dashboard');
    })->name('dashboard');
    Route::resource('consultant', ConsultantController::class)->except('show');
    Route::resource('equipe', EquipeController::class)->except('show');
    Route::resource('societe', SocieteController::class)->except('show');
    Route::resource('demandeur', DemandeurController::class)->except('show');
    Route::resource('categorie', CategorieController::class)->except('show');
    Route::resource('produit', ProduitController::class)->except('show');
    Route::resource('chauffeur', ChauffeurController::class)->except('show');
    Route::resource('faitgenerateur', FaitGenerateurController::class)->except('show');
    Route::resource('intervention', InterventionController::class)->except('show');
    Route::resource('typedemande', TypeDemandeController::class)->except('show');
    Route::resource('typeintervention', TypeInterventionController::class)->except('show');
    Route::resource('vehicule', VehiculeController::class)->except('show');


});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
