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
use App\Http\Controllers\Greece\StudyFlashController;
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

Route::get('/verify/{hash}', [VerifyEmailCustomController::class, 'checkHash']);


//Route::get('/dashboard', [CardUserController::class, 'index'])->middleware(['auth', 'verified','user'])->name('dashboard');

Route::middleware('auth', 'user','verified' )->group(function () {
    Route::get('/dashboard', [IndexController::class, 'Index'])->name('dashboard');
    
    Route::post('/cards.favorite', [CardController::class, 'Favorite'])->name('cards.favorite');
    Route::resource('/folders', FolderController::class);
    Route::resource('/cards', CardController::class);
    Route::post('/favorite.folder/{folder}', [FolderController::class, 'Favorite'])->name('folder.favorite');
    //Route::resource('/res', ReservationController::class);
});

Route::name('search.')->prefix('search')->group(function () {
    Route::get('/', [SearchController::class, 'Index'])->name('index');
    Route::get('/find', [SearchController::class, 'FindFolders'])->name('find');
    Route::get('/find/{keyword}', [SearchController::class, 'ShowFolders'])->name('show');
    
    Route::middleware('auth', 'user','verified' )->post('follow', [FolderFollowerController::class, 'FollowAndUnfollowFolder'])->name('follow');
    
   
    //Route::resource('/res', ReservationController::class);
});

//middleware('auth', 'user','verified' )->


Route::name('learn.')->prefix('learn')->group(function () {
    Route::get('/{folder}', [ShowCardsController::class, 'Index'])->name('index');
    Route::middleware("post")->group(function() {
        Route::post('/flash/{folder}', [ShowCardsController::class, 'Launch'])->name('launch');
        Route::post('/checkAnswer', [ShowCardsController::class, 'CheckAnswer'])->name('check');
        Route::post('/close/{folder}', [ShowCardsController::class, 'Close'])->name('close');
        Route::post('/next', [ShowCardsController::class, 'Proceed'])->name('proceed');

        
    });
    //Route::resource('/res', ReservationController::class);
});

Route::name("study.")->prefix('study')->group(function(){
    Route::post('/launch/{folder}', [StudyFlashController::class, 'Launch'])->name('launch');
});

Route::name('follow.')->middleware('auth', 'user','verified' )->prefix('follow')->group(function (){
    Route::get('/', [FolderFollowerController::class, 'getFollows'])->name('index');
});



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'Edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'Update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'Destroy'])->name('profile.destroy');
    Route::middleware('admin')->get('/users', [ProfileController::class, 'GetUsers'])->name('profile.users');
});


Route::fallback(function () {
    /** This will check for the 404 view page unders /resources/views/errors/404 route */
    return view('welcome');
});

require __DIR__.'/auth.php';
