<?php
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Car;
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
Route::get('/helo', function () {
    return "<h1>helo <h1>";
});
Route::get('/hello2', function () {
    return view('hello2');
});
//Route::get('giaipt', [Giaicontroller::class,'getPt1'])->name('getPt1');

//Route::post('giaipt', [Giaicontroller::class,'postPt1'])->name ('postPt1');
    
//Route::get('car/{id}',[CarController::class,'show'])->name('car-show');
//Route::get('car',[CarController::class,'index'])->name('car-show');
Route::resource('cars',CarController::class);
Route::post('cars/search',[CarController::class,'postSearch'])->name('postSearch');