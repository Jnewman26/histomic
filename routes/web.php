<?php

use App\Http\Controllers\ComicsController;
use App\Http\Controllers\CustAdminController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibraryReaderController;
use App\Http\Controllers\LibraryWriterController;
use App\Http\Controllers\NewComicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

// Application
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/comics', [ComicsController::class, 'index']);
Route::get('/genres', [GenresController::class, 'index']);

// signup
Route::post('/signup', [SignupController::class, 'store']);
Route::get('/signup', [SignupController::class, 'create']);

// login
Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);

// logout
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

// Genre Application
Route::get('/genreaction', [GenresController::class, 'genreaction']);
Route::get('/genrefantasy', [GenresController::class, 'genrefantasy']);
Route::get('/genreadventure', [GenresController::class, 'genreadventure']);
Route::get('/genremystery', [GenresController::class, 'genremystery']);
Route::get('/genresuperhero', [GenresController::class, 'genresuperhero']);
Route::get('/genreromance', [GenresController::class, 'genreromance']);

Route::middleware('auth')->group(function () {
    // Dashboard Application
    Route::post('/cart', [CartController::class, 'store']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wish');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/libraryreader', [LibraryReaderController::class, 'index'])->name('libraryreader');
    Route::get('/librarywriter', [LibraryWriterController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/newcomic', [NewComicController::class, 'index']);
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store']);

    // Edit Comic
    Route::get('/librarywriter/{COMIC_ID}/edit', [LibraryWriterController::class, 'edit']);
    Route::put('/librarywriter/{COMIC_ID}', [LibraryWriterController::class, 'update']);

    // wishlist
    Route::post('/add-to-wishlist', [WishlistController::class, 'wishlistindex']);
    Route::post('/remove-to-wishlist', [WishlistController::class, 'removewish']);

    // cart
    Route::post('/add-to-cart', [CartController::class, 'cartindex']);
});

// Admin
Route::get('/admin', [CustAdminController::class, 'index']);
Route::get('/user', [CustAdminController::class, 'user'])->name('user.index');
Route::get('/comic', [CustAdminController::class, 'comic']);
Route::get('/useradmin', [CustAdminController::class, 'Admin']);

Route::get('/user/{USER_ID}', [CustAdminController::class, 'show']);

Route::put('/user/{USER_ID}', [CustAdminController::class, 'update']);
Route::get('/user/{USER_ID}/edit', [CustAdminController::class, 'edit']);
