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
use App\Models\Product;

Route::get('/place-order', function () {
    $product = Product::first();
    return view('place_order', compact('product'));
});

Route::post('/place-order', [OrderController::class, 'place'])->name('place.order');



