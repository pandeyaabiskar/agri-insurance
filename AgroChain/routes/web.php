<?php

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



Auth::routes();
Route::resource('crops', 'CropController')->middleware(['auth', 'auth.admin']);
Route::get('crops', 'CropController@index')->middleware(['auth'])->name('crops.index');
Route::resource('croprequests', 'CropRequestController')->middleware(['auth']);
Route::resource('issuerecords', 'IssueRecordController')->middleware(['auth']);
Route::get('croprequests/reject/{id}', 'CropRequestController@cancelRequest')->middleware(['auth'])->name('croprequests.reject');
Route::get('crops/available/{id}', 'CropController@makeAvailable')->middleware(['auth'])->name('crops.available');

Route::get('issuerecords/accept/{id}', 'IssueRecordController@acceptRequest')->middleware(['auth'])->name('issuerecords.accept');
Route::get('issuerecords/reject/{id}', 'IssueRecordController@cancelRequest')->middleware(['auth'])->name('issuerecords.reject');

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth', 'auth.roles']);
Route::get('/add-crop', 'CropController@addCrop')->name('crop.add')->middleware(['auth', 'auth.admin']);
Route::post('/crop-state', 'CropController@changeCropState')->name('crop.plant')->middleware(['auth']);


Route::post('/track-crop', 'CropController@trackCrop')->name('crop.track');

