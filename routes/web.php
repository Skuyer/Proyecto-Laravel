<?php

use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/trainers');

// Las exportaciones van ANTES del resource
Route::get('trainers/exportar/pdf', [TrainerController::class, 'exportPdf'])->name('trainers.pdf');
Route::get('trainers/exportar/excel', [TrainerController::class, 'exportExcel'])->name('trainers.excel');

Route::resource('trainers', TrainerController::class)->except('show');