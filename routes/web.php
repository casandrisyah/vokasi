<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\WebController;
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

Route::group(['domain' => ''], function () {
    Route::get('/', function () {
        return redirect()->route('web.home');
    });
    Route::prefix('')->name('web.')->group(function () {
        Route::prefix('auth')->name('auth.')->group(function () {
            Route::get('', [AuthController::class, 'login'])->name('index');
            Route::post('authenticate', [AuthController::class, 'do_login'])->name('login');
            Route::get('logout', [AuthController::class, 'do_logout'])->name('logout');
        });
        Route::get('home', [WebController::class, 'index'])->name('home');
        Route::get('tentang-kami', [WebController::class, 'about'])->name('tentang');
        Route::get('berita', [WebController::class, 'news'])->name('berita');
        Route::get('berita/{slug}',[WebController::class, 'singleNews'])->name('berita.show');
        Route::get('aktivitas/{activities:category}', [WebController::class, 'activity'])->name('activity');
        Route::get('program/{category_prodi:slug}', [WebController::class, 'program'])->name('program');
        Route::get('civitas/dosen', [WebController::class, 'dosen'])->name('civitas.dosen');
        Route::get('civitas/dosen/{dosen}', [WebController::class, 'show_dosen'])->name('civitas.dosen.show');
        Route::get('teaching-mentoring-filter', [WebController::class, 'filter_teaching_mentoring'])->name('teaching-mentoring-filter');
        Route::post('send-comment', [WebController::class, 'send_comment'])->name('send-comment');
        Route::get('civitas/staf', [WebController::class, 'staf'])->name('civitas.staf');
        Route::get('civitas/staf/{staf}', [WebController::class, 'show_staf'])->name('civitas.staf.show');
    });
});
