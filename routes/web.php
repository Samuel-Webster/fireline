<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', App\Http\Livewire\Dashboard::class)->name('dashboard');
    Route::get('/appliances', App\Http\Livewire\Appliances::class)->name('appliances');
    Route::get('/jobs', App\Http\Livewire\Jobs::class)->name('jobs');
    Route::get('/logs', App\Http\Livewire\Logs::class)->name('logs');
    Route::get('/checks', App\Http\Livewire\Checks::class)->name('checks');
});
