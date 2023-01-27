<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\TestScanController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PermitController::class)->group(function () {
    Route::get('/epermit', 'dashEpermit')->name('/epermit');
    Route::get('epermit/formcuti', 'indexCuti')->name('epermit/formcuti');
    Route::post('epermit/formcuti/store', 'storeCuti')->name('epermit/formcuti/store');
    Route::get('epermit/formsakit', 'indexSakit')->name('epermit/formsakit');
    Route::get('epermit/checkpermit', 'indexCheck')->name('epermit/checkpermit');
});

Route::controller(TestScanController::class)->group(function () {
    Route::get('formcuti/getusers', 'ajaxUser')->name('formcuti/getusers');
});

Route::get('/test', function() {
    return view('forms.usercuti');
});
