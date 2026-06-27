<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AdminLoanController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\BookSuggestionController;
use App\Http\Controllers\AdminBookSuggestionController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AboutController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog.search');
Route::get('/katalog/informasi', [CatalogController::class, 'information'])->name('katalog.information');
Route::get('/katalog/bantuan', [CatalogController::class, 'help'])->name('katalog.help');
Route::get('/katalog/panduan/{slug?}', [CatalogController::class, 'guidelines'])->name('katalog.guidelines');
Route::get('/katalog/{book}', [CatalogController::class, 'show'])->name('katalog.show');
Route::post('/katalog/{book}/comments', [CatalogController::class, 'storeComment'])->name('katalog.comments.store');
Route::get('/lang/{locale}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('lang');
Route::get('/cek-pinjaman', [LoanController::class, 'index'])->name('cek-pinjaman');
Route::get('/usulan-buku', [BookSuggestionController::class, 'index'])->name('usulan-buku.index');
Route::post('/usulan-buku', [BookSuggestionController::class, 'store'])->name('usulan-buku.store');
Route::get('/saran-masukan', [FeedbackController::class, 'index'])->name('saran-masukan.index');
Route::post('/saran-masukan', [FeedbackController::class, 'store'])->name('saran-masukan.store');
Route::get('/tentang-kami/{section?}', [AboutController::class, 'index'])->name('tentang-kami');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    Route::resource('facilities', FacilityController::class)->except(['show']);
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('members', AdminMemberController::class)->except(['show']);
    Route::resource('books', AdminBookController::class)->except(['show']);
    Route::resource('loans', AdminLoanController::class)->except(['show']);
    Route::resource('book-suggestions', AdminBookSuggestionController::class)->only(['index', 'destroy']);
    Route::resource('feedbacks', AdminFeedbackController::class)->only(['index', 'destroy']);
    Route::resource('guidelines', App\Http\Controllers\AdminGuidelineController::class)->except(['show']);
    
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
