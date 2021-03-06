<?php
namespace App\Http\Controller;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\adminReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderManagement;





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


//Auth routes
Route::get('/',function(){
    return view('auth.login');
});


// Route::get('/register',function(){
//     return view('auth.register');
// })->name('register');
// Dashboard route

Route::get('/admin', function () {
    return view('adminBlades/adminHome');
})->name('admin');


/////// profile route //////
Route::get('/profile', function () {
    return view('userBlades/profile');
})->name('profile');

Route::resource('/admin-actions',adminController::class);

Route::resource('/order-actions',OrderManagement::class);

//route to the crud operations on orders

Route::resource('/order',OrderController::class);

Route::get('/display-menu', [OrderController::class , 'showMenuItems'])->name('showMenuItems');

Route::post('/create-menu-item', [OrderController::class , 'createMenuItem'])->name('createMenuItem');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');

//Auth::routes();

//Route::get('/report', [App\Http\Controllers\adminControllers\adminReportController::class, 'currentMonth'])->name('adminReport');
Route::get('/report', [adminReportController::class , 'currentMonth'])->name('adminReport');
Route::get('/user-report', [adminReportController::class , 'currentMonth_user'])->name('userReport');

//Route::get('/foodItemsAdmin',[adminReportController::class,'foodItems'])->name('admin.foodItems');

Route::get('/fooditems',[adminReportController::class,'foodItems'])->name('admin.foodItems');


Route::get('/delete', [adminController::class , 'deleteMultiple'])->name('multiple_delete');

Route::get('/userhome', [HomeController::class , 'userHome'])->name('userhome');

Route::get('/expenditure', [adminReportController::class , 'index'])->name('admin-report');

//enabling and disabling users
Route::get('/disabled users', [adminController::class , 'disabledUsers'])->name('disabled-users');

Route::post('/enable-user', [adminController::class , 'enableUser'])->name('enable-user');

Route::post('/change-password',[adminController::class, 'changePassword'])->name('change-password');
Route::get('/change-pass',[adminController::class,'changePassword'])->name('change_password'); 


////resetting password ////
  

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');