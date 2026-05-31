<?php

use Illuminate\Support\Facades\Route; 
//website route
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\WebCrisisController;
use App\Http\Controllers\Frontend\webVolunteerController;
use App\Http\Controllers\Frontend\DonorProfileController;
use App\Http\Controllers\Frontend\PaymentController;



//Admin import route
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrisisCategoryController;
use App\Http\Controllers\CrisisController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SslCommerzPaymentController;

Route::get('/', function () {
  return view('welcome');
});

//website route
Route::get('/crowdfunding',[WebsiteController::class,'websiteindex'])->name('website');

Route::get('/crowdfunding/register',[AuthController::class,'showRegister'])->name('show.register');
Route::post('/crowdfunding/registersubmit',[AuthController::class,'submitRegister'])->name('submit.register');
Route::get('/crowdfunding/login',[AuthController::class,'showLogin'])->name('show.login');
Route::post('/crowdfunding/loginsubmit',[AuthController::class,'loginSubmit'])->name('login.submit');

Route::get('/crowdfunding/donor-profile',[DonorProfileController::class,'donorProfile'])->name('donor.profile');
Route::post('/crowdfunding/donor-profile-update',[DonorProfileController::class,'donorProfileUpdate'])->name('donor.profile.update');
Route::get('/crowdfunding/donor-donationslist',[DonorProfileController::class,'donorDonationsList'])->name('donor.donations.list');

Route::get('/crowdfunding/crisislist',[WebCrisisController::class,'crisisList'])->name('crisis.list');
Route::get('/crowdfunding/detailspage/{id}',[WebCrisisController::class,'detailsShow'])->name('crisis.details');
Route::get('/crowdfunding/expense-page/{id}',[WebCrisisController::class,'expenseShow'])->name('crisis.expense');

Route::get('/crowdfunding/volunteerlist',[WebVolunteerController::class,'volunteerList'])->name('volunteer.list');
Route::get('/crowdfunding/volunteerform',[WebVolunteerController::class,'volunteerForm'])->name('webvolunteer.form');
Route::post('/crowdfunding/volunteersubmit',[WebVolunteerController::class,'volunteerSubmit'])->name('webvolunteer.submit');
Route::get('/crowdfunding/volunteerlogin',[WebVolunteerController::class,'volunteerLogin'])->name('webvolunteer.login');
Route::post('/crowdfunding/volunteerlogin-submit',[WebVolunteerController::class,'volunteerLoginSubmit'])->name('webvolunteer.login.submit');
Route::get('/crowdfunding/volunteer-logout',[WebVolunteerController::class, 'volunteerLogout'])->name('webvolunteer.logout');

Route::get('/crowdfunding/volunteer-profile',[WebVolunteerController::class, 'volunteerProfile'])->name('webvolunteer.profile');
Route::post('/crowdfunding/volunteer-profile-update',[WebVolunteerController::class, 'volunteerProfileUpdate'])->name('webvolunteer.profile.update');
Route::get('/crowdfunding/volunteer-application',[WebVolunteerController::class, 'volunteerApplication'])->name('webvolunteer.application');
Route::get('/crowdfunding/volunteer-tasks',[WebVolunteerController::class, 'volunteerTasks'])->name('webvolunteer.tasks');
Route::post('/crowdfunding/task-complete/{crisis_id}', [WebVolunteerController::class, 'taskComplete'])->name('webvolunteer.task.complete');




//Admin panel
Route::group(['middleware' => ['auth', 'admin']], function(){
Route::get('/dashboard',[AdminController::class,'dashboardindex'])->name('dashboard');


Route::get('/user',[UserController::class,'userindex'])->name('user');
Route::get('/user/userform',[UserController::class,'userform'])->name('user.form');
Route::post('/user/usersubmit',[UserController::class,'usersubmit'])->name('user.submit');
Route::get('/user/view/{id}',[UserController::class,'userview'])->name('user.view');
Route::get('/user/edit/{id}', [UserController::class,'useredit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'userupdate'])->name('user.update');
Route::get('/user/delete/{id}',[UserController::class,'userdelete'])->name('user.delete');


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
Route::get('/crisis/volunteer-assign/{id}',[CrisisController::class,'volunteerAssign'])->name('volunteer.assign');
Route::post('/crisis/volunteer-assign_store/{id}',[CrisisController::class,'volunteerAssignStore'])->name('volunteer.assign.store');
Route::get('/crisis/edit/{id}', [CrisisController::class,'edit'])->name('crisis.edit');
Route::put('/crisis/update/{id}', [CrisisController::class, 'update'])->name('crisis.update');
Route::get('/crisis/delete/{id}',[CrisisController::class,'crisisdelete'])->name('crisis.delete');
Route::get('/crisis/volunteer-delete/{crisis_id}/{volunteer_id}', [CrisisController::class, 'volunteerDelete'])->name('crisis.volunteer.delete');

Route::get('/expense',[ExpenseController::class,'expenseindex'])->name('expense');
Route::get('/expense/expenseform',[ExpenseController::class,'expenseform'])->name('expense.form');
Route::post('/expense/expensesubmit',[ExpenseController::class,'expensesubmit'])->name('expense.submit');
Route::post('/expense/approve/{id}',[ExpenseController::class,'approve'])->name('expense.approve');
Route::post('/expense/reject/{id}',[ExpenseController::class,'reject'])->name('expense.reject');


Route::get('/donor',[DonorController::class,'donorindex'])->name('donor');
Route::get('/donor/donorform',[DonorController::class,'donorform'])->name('donor.form');
Route::post('/donor/donorsubmit',[DonorController::class,'donorsubmit'])->name('donor.submit');
Route::get('/donor/view/{id}',[DonorController::class,'donorview'])->name('donor.view');
Route::get('/donor/delete/{id}',[DonorController::class , 'donordelete'])->name('donor.delete');

Route::get('/donation',[DonationController::class,'donationindex'])->name('donation');
Route::get('/donation/donationform',[DonationController::class,'donationform'])->name('donation.form');
Route::post('/donation/donationsubmit',[DonationController::class,'donationsubmit'])->name('donation.submit');
Route::get('/donation/view/{id}',[DonationController::class,'donationview'])->name('donation.view');
Route::get('/donation/delete/{id}',[DonationController::class,'donationdelete'])->name('donation.delete');



Route::get('/volunteer',[VolunteerController::class,'volunteerindex'])->name('volunteer');
Route::get('/volunteer/volunteerform',[VolunteerController::class,'volunteerform'])->name('volunteer.form');
Route::post('/volunteer/volunteersubmit',[VolunteerController::class,'volunteersubmit'])->name('volunteer.submit');
Route::post('/volunteer/approve/{id}',[VolunteerController::class,'approve'])->name('volunteer.approve');
Route::post('/volunteer/reject/{id}',[VolunteerController::class,'reject'])->name('volunteer.reject');


Route::get('/report',[ReportController::class,'index'])->name('report');
Route::get('/report/generate', [ReportController::class, 'generate'])->name('report.generate');
Route::get('/report/export', [ReportController::class, 'export'])->name('report.export');
 
});


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->name('donate.pay');


Route::match(['get', 'post'], '/success', [SslCommerzPaymentController::class, 'success']);
Route::match(['get', 'post'], '/fail', [SslCommerzPaymentController::class, 'fail']);
Route::match(['get', 'post'], '/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::get('/payment/success',[PaymentController::class,'success'])->name('payment.success');
   

Route::post('/crowdfunding/logout', [AuthController::class, 'logout'])->name('logout');