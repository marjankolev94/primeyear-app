<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrimeYearController;

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

Route::get('/', [PrimeYearController::class, 'create'])->name('primeyear.create');
Route::post('/', [PrimeYearController::class, 'store'])->name('primeyear.store');
