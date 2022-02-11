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

Route::get('/', 'HomeController@welcome');



Auth::routes();
Route::resource('crops', 'CropController')->middleware(['auth', 'auth.admin']);
Route::resource('projects', 'ProjectController', ['only' => ['index', 'create', 'store', 'update', 'destroy', 'edit']])->middleware(['auth', 'auth.farmer']);
Route::get('projects/{id}', 'ProjectController@show')->name('projects.show');
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

//Route to profile of farmer
Route::get('/profile', 'HomeController@profile')->middleware(['auth', 'auth.roles'])->name('profile');

//Route to update profile of farmer
Route::resource('updatefarmer', 'FarmerController')->middleware(['auth']);

//Route to update profile of any user
Route::resource('updateuser', 'UserController')->middleware(['auth']);

Route::get('updatefarmer/accept/{id}', 'FarmerController@acceptRequest')->middleware(['auth'])->name('updatefarmer.accept');
Route::get('updatefarmer/reject/{id}', 'FarmerController@cancelRequest')->middleware(['auth'])->name('updatefarmer.reject');
Route::get('updatefarmer/resubmit/{id}', 'FarmerController@resubmit')->middleware(['auth'])->name('updatefarmer.resubmit');

Route::post('/password/change', 'Auth\ResetPasswordController@changePassword')->name('password.change');


Route::resource('contributions', 'ContributionController')->middleware(['auth']);
Route::resource('approvals', 'ApprovalController')->middleware(['auth']);
Route::resource('withdrawals', 'WithdrawalController')->middleware(['auth', 'auth.farmer']);

Route::get('approvals/approve/{id}', 'ApprovalController@approve')->middleware(['auth'])->name('approvals.approve');
Route::get('approvals/decline/{id}', 'ApprovalController@decline')->middleware(['auth'])->name('approvals.decline');

Route::get('withdrawals/withdraw/{id}', 'WithdrawalController@withdraw')->middleware(['auth'])->name('withdrawals.withdraw');

//Route for insurance
Route::resource('insurance', 'InsuranceApplicationController')->middleware(['auth', 'auth.farmer']);
Route::resource('verifications', 'InsuranceVerificationController')->middleware(['auth', 'auth.riskmanager']);
Route::resource('policies', 'InsurancePolicyController')->middleware(['auth', 'auth.admin']);
Route::get('insurance/reject/{id}', 'InsuranceApplicationController@reject')->middleware(['auth'])->name('insurance.reject');
Route::post('policy/load', 'InsurancePolicyController@loadFund')->middleware(['auth']);
Route::post('policy/premium', 'InsuranceApplicationController@payPremium')->middleware(['auth']);
Route::get('policy/details', 'InsurancePolicyController@details')->middleware(['auth'])->name('policy.details');
Route::post('policy/claim', 'InsurancePolicyController@claim')->middleware(['auth'])->name('policy.claim');



