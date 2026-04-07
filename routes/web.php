<?php

use Illuminate\Support\Facades\Route; 

//Admin import route
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrisisCategoryController;
use App\Http\Controllers\CrisisController;
use App\Http\Controllers\DonarController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BusinessSettingController;


Route::get('/', function () {
  return view('welcome');
});

//Admin panel
Route::get('/user',[UserController::class,'userindex'])->name('user');
Route::get('/user/userform',[UserController::class,'userform'])->name('user.form');
Route::post('/user/usersubmit',[UserController::class,'usersubmit'])->name('user.submit');


Route::get('/crisiscategory',[CrisisCategoryController::class,'categoryindex'])->name('crisis.category');
Route::get('/crisiscategory/categoryform',[CrisisCategoryController::class,'categoryform'])->name('crisis.category.form');
Route::post('/crisiscategory/submitform',[CrisisCategoryController::class,'categorysubmit'])->name('crisis.category.submit');
Route::get('/crisiscategory/view/{id}',[CrisisCategoryController::class,'categoryview'])->name('category.view');
Route::get('/crisiscategory/edit/{id}', [CrisisCategoryController::class, 'edit'])->name('category.edit');
Route::put('/crisiscategory/update/{id}', [CrisisCategoryController::class, 'update'])->name('category.update');
Route::get('/crisiscategory/delete/{id}',[CrisisCategoryController::class,'categorydelete'])->name('category.delete');



Route::get('/crisis',[CrisisController::class,'crisisindex'])->name('crisis');
Route::get('/crisis/crisisform',[CrisisController::class,'crisisform'])->name('crisis.form');
Route::post('/crisis/crisissubmit',[CrisisController::class,'crisissubmit'])->name('crisis.submit');
Route::get('/crisis/view/{id}',[CrisisController::class,'crisisview'])->name('crisis.view');



Route::get('/donar',[DonarController::class,'donarindex'])->name('donar');
Route::get('/donar/donarform',[DonarController::class,'donarform'])->name('donar.form');
Route::post('/donar/donarsubmit',[DonarController::class,'donarsubmit'])->name('donar.submit');



Route::get('/donation',[DonationController::class,'donationindex'])->name('donation');
Route::get('/donation/donationform',[DonationController::class,'donationform'])->name('donation.form');
Route::post('/donation.donationsubmit',[DonationController::class,'donationsubmit'])->name('donation.submit');



Route::get('/volunteer',[VolunteerController::class,'volunteerindex'])->name('volunteer');
Route::get('/volunteer/volunteerform',[VolunteerController::class,'volunteerform'])->name('volunteer.form');
Route::post('volunteer/volunteersubmit',[VolunteerController::class,'volunteersubmit'])->name('volunteer.submit');



Route::get('report',[ReportController::class,'reportindex'])->name('report');
Route::get('/setting',[BusinessSettingController::class,'settingindex'])->name('business.setting');
