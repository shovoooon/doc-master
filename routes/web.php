<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\DocumentController;


Route::get('/', function () {
    return view('form');
});

Route::get('/upload', [ImageUploadController::class, 'create'])->name('upload.form');
Route::post('/upload', [ImageUploadController::class, 'store'])->name('upload.image');

Route::post('/documents/submit', [DocumentController::class, 'submit'])->name('documents.submit');

