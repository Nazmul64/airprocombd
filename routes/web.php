<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminBlanceController;
use App\Http\Controllers\Backend\AdmindepositeblanceaddController;
use App\Http\Controllers\Backend\AdmindepositeEditController;
use App\Http\Controllers\Backend\AdminpasswordchangeController;
use App\Http\Controllers\Backend\AdminuseraccountviewController;
use App\Http\Controllers\Backend\AdminuserController;
use App\Http\Controllers\Backend\AdminwinlistController;
use App\Http\Controllers\Backend\AllTicketController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CommissionSettingController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CounterController;
use App\Http\Controllers\Backend\DepositdetilsController;
use App\Http\Controllers\Backend\DepositeContrller;
use App\Http\Controllers\Backend\DepositeController;
use App\Http\Controllers\Backend\LotterycreateController;
use App\Http\Controllers\Backend\LotteryResultController;
use App\Http\Controllers\Backend\NoticesController;
use App\Http\Controllers\Backend\PartnarController;
use App\Http\Controllers\Backend\PaswordchangeController;
use App\Http\Controllers\Backend\PrivacypolicyController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SupportControler;
use App\Http\Controllers\Backend\TermsconditionController;
use App\Http\Controllers\Backend\userBlanceController;
use App\Http\Controllers\Backend\UserprofileController;
use App\Http\Controllers\Backend\WaletaSetupController;
use App\Http\Controllers\Backend\WhychooseinvestmentplanConroller;
use App\Http\Controllers\Backend\WidthrawhistoryanddepositehistoryController;
use App\Http\Controllers\Backend\WithdrawcommissonController;
use App\Http\Controllers\Backend\WithdrawController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TotalreferreduseController;
use App\Http\Controllers\Userauth\ForgotPasswordController;
use App\Http\Controllers\UserlottryController;
use App\Http\Controllers\UserregistionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Start Admin login routes

// Admin login/logout
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('logout', [AdminController::class, 'logout'])->name('logout');

// Protected admin routes
Route::middleware(['admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('whychooseusinvesment', WhychooseinvestmentplanConroller::class);
    Route::resource('aboutus', AboutController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('privacypolicy',PrivacypolicyController::class);
    Route::get('/users', [AdminController::class, 'userList'])->name('chat.users');   // sidebar list
    Route::get('/fetch', [AdminController::class, 'fetch'])->name('chat.fetch');      // fetch messages
    Route::post('/send', [AdminController::class, 'send'])->name('chat.send');
    Route::resource('slider',SliderController::class);
    Route::resource('counter',CounterController::class);
    Route::resource('contact',ContactController::class);
    Route::resource('partner',PartnarController::class);
    Route::resource('Termscondition',TermsconditionController::class);
    Route::get('userlist-for-admin', [AdminController::class, 'userlistadmin'])->name('admin.userlist');
    Route::put('/users/{id}/status', [AdminController::class, 'updateStatus'])->name('users.updateStatus');




    Route::resource('supportlink',SupportControler::class);
    Route::get('/admin/password/change', [AdminpasswordchangeController::class, 'adminpasswordchange'])->name('adminpassword.change');
    Route::post('/admin/password/change/submit', [AdminpasswordchangeController::class, 'adminpasswordsubmit'])->name('adminpassword.submit');
    Route::get('/admin/profile/change', [AdminpasswordchangeController::class, 'adminProfile'])->name('profile.change');
    Route::put('/admin/profile/{id}', [AdminpasswordchangeController::class, 'adminProfileSubmit'])->name('admin.profile.update');
    Route::resource('notices', NoticesController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('subcategories',SubCategoryController::class);


    //   admin user account view start end


});

// End Admin login routesadmin_login_submit

// ==========================================
// FIXED ROUTES
// ==========================================

// Public routes
Route::get('register', [UserregistionController::class, 'register'])->name('register');
Route::get('user/login', [UserregistionController::class, 'userlogin'])->name('user.login');
Route::post('logout', [UserregistionController::class, 'userlogout'])->name('logout');
// POST routes for form submissions
Route::post('register/submit', [UserregistionController::class, 'registersubmit'])->name('register.submit');
Route::post('login/submit', [UserregistionController::class, 'loginSubmit'])->name('login.submit');

// Protected routes - IMPORTANT: Make sure this matches your URL
Route::middleware(['user'])->group(function () {
    Route::get('user/dashboard', [UserregistionController::class, 'userdashboard'])->name('user.dashboard');

    Route::get('user/chat',        [ChatController::class, 'index'])->name('user.chat');
    Route::get('user/chat/fetch',  [ChatController::class, 'fetch'])->name('user.chat.fetch');
    Route::post('user/chat/send',  [ChatController::class, 'send'])->name('user.chat.send');
    Route::get('user/chat/list',   [ChatController::class, 'userList'])->name('user.chat.list');


  // user profile update route and controller

   Route::get('/profile', [UserprofileController::class, 'profile'])->name('profile.index');
   Route::put('/profile/{id}', [UserprofileController::class, 'updateProfile'])->name('profile.update');
   Route::get('/password', [PaswordchangeController::class, 'password'])->name('password.index');
   Route::post('/password/change', [PaswordchangeController::class, 'passwordchange'])->name('password.change');



  // user support for link
  Route::get('supprts/link/show', [SupportControler::class, 'supprtslinkshow'])->name('supprtslinks.show');

  Route::get('password/forget', [ForgotPasswordController::class, 'showForgetForm'])->name('password.forget');
  Route::post('password/forget', [ForgotPasswordController::class, 'submitForgetForm'])->name('password.forget.post');
  Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
  Route::post('password/reset', [ForgotPasswordController::class, 'submitResetForm'])->name('password.reset.post');
  // user support for link end


});


// Frontend route
 Route::get('/', [FrontendController::class, 'frontend'])->name('frontend');
 Route::get('privacy', [FrontendController::class, 'privacy'])->name('privacy');
 Route::get('contacts', [FrontendController::class, 'contacts'])->name('contacts');
 Route::get('termsconditions', [FrontendController::class, 'termsconditions'])->name('termsconditions');






