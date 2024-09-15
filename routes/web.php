<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;

Route::get('/', [HolidayController::class, 'index'])->name('holidays.index');
Route::post('/holidays/pre-import', [HolidayController::class, 'preImport'])->name('holidays.preImport');
Route::post('/holidays/import', [HolidayController::class, 'import'])->name('holidays.import');
