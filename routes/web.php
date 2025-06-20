<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });



use App\Http\Controllers\OrderController;

// Frontend form ke liye route
Route::get('/place-order', function () {
    return view('place_order');
});

// Form submit hone par order place karne ka route
Route::post('/place-order', [OrderController::class, 'place'])->name('place.order');