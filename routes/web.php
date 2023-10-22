<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientExportController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', HomeController::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [PatientController::class, 'index'])->name('dashboard');
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patient.show');
    Route::post('/patients', [PatientController::class, 'store'])->name('patient.store');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patient.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patient.destroy');

    Route::post('/patients/{patient}/drugs', [DrugController::class, 'store'])->name('drug.store');
    Route::put('/patients/{patient}/drugs/{drug}', [DrugController::class, 'update'])->name('drug.update');
    Route::delete('/patients/{patient}/drugs/{drug}', [DrugController::class, 'destroy'])->name('drug.destroy');

    Route::get('/{patient}/export-to-pdf', PatientExportController::class)->name('patient.export');
});
