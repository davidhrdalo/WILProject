<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPartnerController;
use App\Http\Controllers\UserStudentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ApplicationController;


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

Route::get('/', [UserPartnerController::class, 'index']);

Route::resource('partner', UserPartnerController::class);

Route::resource('student', UserStudentController::class);

Route::resource('project', ProjectController::class);

Route::resource('application', ApplicationController::class);

Route::post('/auto-assign', [UserStudentController::class, 'autoAssign'])->name('student.auto-assign');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
