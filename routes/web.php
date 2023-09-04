<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Index\IndexController;
use App\Http\Controllers\Folder\FolderController;
use App\Http\Controllers\Card\CardController;   
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Follow\FolderFollowerController;
use App\Http\Controllers\Learn\ShowCardsController;
use App\Http\Controllers\Learn\LearnController;
use App\Http\Controllers\VerifyEmailCustomController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('welcome');
})->name('main');

Route::get('/verify{hash}', [VerifyEmailCustomController::class, 'checkHash']);


//Route::get('/dashboard', [CardUserController::class, 'index'])->middleware(['auth', 'verified','user'])->name('dashboard');

Route::middleware('auth', 'user','verified' )->group(function () {
    Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');
    
    Route::post('/cards.favorite', [CardController::class, 'favorite'])->name('cards.favorite');
    Route::resource('/folders', FolderController::class);
    Route::resource('/cards', CardController::class);
    Route::post('favorite.folder', [FolderController::class, 'favorite'])->name('folder.favorite');
    //Route::resource('/res', ReservationController::class);
});

Route::middleware('auth', 'user','verified' )->name('search.')->prefix('search')->group(function () {
    Route::get('/', [SearchController::class, 'index'])->name('index');
    Route::get('/find', [SearchController::class, 'FindFolders'])->name('find');
    Route::get('/find/{keyword}', [SearchController::class, 'ShowFolders'])->name('show');
    
    Route::post('follow', [FolderFollowerController::class, 'follower'])->name('follow');
    
   
    //Route::resource('/res', ReservationController::class);
});




Route::middleware('auth', 'user','verified' )->name('learn.')->prefix('learn')->group(function () {
    Route::get('/{folder_id}', [ShowCardsController::class, 'Index'])->name('index');
    Route::post('/{folder_id}', [ShowCardsController::class, 'Launch'])->name('launch');
    Route::post('/check', [ShowCardsController::class, 'CheckAnswer'])->name('check');
    Route::post('/close', [ShowCardsController::class, 'Close'])->name('close');
    //Route::resource('/res', ReservationController::class);
});





Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::fallback(function () {
    /** This will check for the 404 view page unders /resources/views/errors/404 route */
    return view('welcome');
});

require __DIR__.'/auth.php';
