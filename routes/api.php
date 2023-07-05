<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(MedicineController::class)->group(function () {
    Route::get('/medicine','index')->name('api.medicine.index');
    Route::post('/medicine/import','import')->name('api.medicine.import');
    Route::delete('/medicine/{id}','delete')->name('api.medicine.delete');
});