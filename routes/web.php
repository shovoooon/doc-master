<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FormEntryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TravellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\DocumentController;

Route::post('/upload-image', [ImageController::class, 'store'])->name('images.store');
Route::get('/images-gallery', [ImageController::class, 'gallery'])->name('images.gallery');
Route::get('/api/gallery-images', [ImageController::class, 'index']);

Route::get('/upload', [ImageUploadController::class, 'create'])->name('upload.form');
Route::post('/upload', [ImageUploadController::class, 'store'])->name('upload.image');

Route::get('/search-hotel', function () {
    $today = now()->addDays(7)->format('Y-m-d');
    $checkoutDate = now()->addDays(14)->format('Y-m-d');
    $hotelInfo = search_hotel('-2405456', $today, $checkoutDate);

    return $hotelInfo;
});

Route::get('/api/company-search', [CompanyController::class, 'search']);
Route::get('/api/bank-search', [BankController::class, 'search']);
Route::get('/api/traveller-search', [TravellerController::class, 'search']);


Route::post('/documents/submit', [DocumentController::class, 'submit'])->name('documents.submit');


// Dashboard
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/marriage/create', [App\Http\Controllers\HomeController::class, 'marriage_create'])->name('marriage_create');
Route::get('/marriage-certificate', [App\Http\Controllers\HomeController::class, 'marriage_certificate'])->name('marriage_certificate');
Route::get('/nikah-nama', [App\Http\Controllers\HomeController::class, 'nikah_nama'])->name('nikah_nama');

Route::get('/form-entries', [FormEntryController::class, 'index']);
Route::post('/form-entries', [FormEntryController::class, 'store']);
Route::get('/form-entries/{id}', [FormEntryController::class, 'show']);
Route::put('/form-entries/{id}', [FormEntryController::class, 'update']);
Route::delete('/form-entries/{id}', [FormEntryController::class, 'destroy']);
