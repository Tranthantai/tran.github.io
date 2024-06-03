<?php



use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CarController;
use App\Models\Car;
use App\Models\cart;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ContactController;



    

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
//Route::get('/', function () {
    //return view('welcome');
//});
//Route::get('/helo', function () {
    //return "<h1>helo <h1>";
//});
//Route::get('/hello2', function () {
    //return view('hello2');
//});
//Route::get('giaipt', [Giaicontroller::class,'getPt1'])->name('getPt1');

//Route::post('giaipt', [Giaicontroller::class,'postPt1'])->name ('postPt1');
    
//Route::get('car/{id}',[CarController::class,'show'])->name('car-show');

//Route::resource('car',CarController::class);
//Route::post('/car/search', [CarController::class, 'postSearch'])->name('car.search');
Route::get('index', function () {
    return view('banhang.index-show');
});
Route::get('index',[PageController::class,'index'])->name('banhang.index-show');
Route::get('/product/{id}', [PageController::class, 'getChiTietsp'])->name('banhang.product');
Route::get('checkout', function () {
    return view('cart.checkout');
});
Route::get('shoppingcart', function () {
    return view('cart.shopping_cart');
});
Route::get('pricing', function () {
    return view('cart.pricing');
});
Route::get('signup', function () {
    return view('acc.signup');
});
Route::get('login', function () {
    return view('acc.login');
});
Route::get('/add-to-cart/{id}',[PageController::class,'addToCart'])->name('banhang.addtocart');
Route::get('xoagiohang/{id}', [PageController::class, 'removeFromCart'])->name('banhang.xoagiohang');
Route::get('dathang', [PageController::class, 'getCheckout'])->name('banhang.getdathang');
Route::get('checkout',[PageController::class,'getCheckout'])->name('banhang.getdathang');
Route::post('checkout',[PageController::class,'postCheckout'])->name('banhang.postdathang');
Route::post('them',[PageController::class,'store'])->name('products.store');
Route::get('them',[PageController::class,'create'])->name('products.them');
Route::get('/dangky',[PageController::class,'getSignin'])->name('getsignin');
Route::post('/dangky',[PageController::class,'postSignin'])->name('postsignin');
Route::get('/dangnhap',[PageController::class,'getLogin'])->name('getlogin');
Route::post('/dangnhap',[PageController::class,'postLogin'])->name('postlogin');
Route::get('/dangxuat',[PageController::class,'getLogout'])->name('getlogout');
Route::post('/input-email',[PageController::class,'postInputEmail'])->name('postInputEmail');
Route::get('/input-email',[PageController::class,'getInputEmail'])->name('getInputEmail');

Route::get('/contact', [ContactController::class, 'showForm'])->name('showForm');
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('sendEmail'); 