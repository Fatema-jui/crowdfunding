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


Route::get('/crisiscategory',[CrisisCategoryController::class,'categoryindex'])->name('crisis.category');
Route::get('/crisiscategory/categoryform',[CrisisCategoryController::class,'categoryform'])->name('crisis.category.form');
Route::post('/crisiscategory/submitform',[CrisisCategoryController::class,'categorysubmit'])->name('crisis.category.submit');



Route::get('/crisis',[CrisisController::class,'crisisindex'])->name('crisis');
Route::get('/crisis/crisisform',[CrisisController::class,'crisisform'])->name('crisis.form');
Route::post('/crisis/crisissubmit',[CrisisController::class,'crisissubmit'])->name('crisis.submit');




Route::get('/donar',[DonarController::class,'donarindex'])->name('donar');
Route::get('/donation',[DonationController::class,'donationindex'])->name('donation');
Route::get('/volunteer',[VolunteerController::class,'volunteerindex'])->name('volunteer');
Route::get('report',[ReportController::class,'reportindex'])->name('report');
Route::get('/setting',[BusinessSettingController::class,'settingindex'])->name('business.setting');
