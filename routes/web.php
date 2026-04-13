<?php

use Illuminate\Support\Facades\Route; 
//website route
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\CrisisController as WebCrisisController;


//Admin import route
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrisisCategoryController;
use App\Http\Controllers\CrisisController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
  return view('welcome');
});

//website route
Route::get('/crowdfunding/register',[AuthController::class,'showRegister'])->name('show.register');
Route::post('/crowdfunding/registersubmit',[AuthController::class,'submitRegister'])->name('submit.register');
Route::get('/crowdfunding/login',[AuthController::class,'showLogin'])->name('show.login');
Route::post('/crowdfunding/loginsubmit',[AuthController::class,'loginSubmit'])->name('login.submit');

Route::get('/crowdfunding',[WebsiteController::class,'websiteindex'])->name('website');
Route::get('/crowdfunding/detailspage/{id}',[WebCrisisController::class,'detailsShow'])->name('crisis.details');











//Admin panel
Route::get('/dashboard',[AdminController::class,'dashboardindex'])->name('dashboard');



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
Route::get('/crisis/edit/{id}', [CrisisController::class,'edit'])->name('crisis.edit');
Route::put('/crisis/update/{id}', [CrisisController::class, 'update'])->name('crisis.update');



Route::get('/donor',[DonorController::class,'donorindex'])->name('donor');
Route::get('/donor/donorform',[DonorController::class,'donorform'])->name('donor.form');
Route::post('/donor/donorsubmit',[DonorController::class,'donorsubmit'])->name('donor.submit');
Route::get('/donor/view/{id}',[DonorController::class,'donorview'])->name('donor.view');
Route::get('/donor/delete/{id}',[DonorController::class , 'donordelete'])->name('donor.delete');

Route::get('/donation',[DonationController::class,'donationindex'])->name('donation');
Route::get('/donation/donationform',[DonationController::class,'donationform'])->name('donation.form');
Route::post('/donation/donationsubmit',[DonationController::class,'donationsubmit'])->name('donation.submit');



Route::get('/volunteer',[VolunteerController::class,'volunteerindex'])->name('volunteer');
Route::get('/volunteer/volunteerform',[VolunteerController::class,'volunteerform'])->name('volunteer.form');
Route::post('/volunteer/volunteersubmit',[VolunteerController::class,'volunteersubmit'])->name('volunteer.submit');
Route::get('/volunteer/view/{id}',[VolunteerController::class,'volunteerview'])->name('volunteer.view');
Route::get('/volunteer/delete/{id}',[VolunteerController::class,'volunteerdelete'])->name('volunteer.delete');


Route::get('report',[ReportController::class,'index'])->name('report');
Route::get('/setting',[BusinessSettingController::class,'settingindex'])->name('business.setting');
