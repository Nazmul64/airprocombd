<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminBlanceController;
use App\Http\Controllers\Backend\AdminContactController;
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
use App\Http\Controllers\Backend\MissionController;
use App\Http\Controllers\Backend\NoticesController;
use App\Http\Controllers\Backend\PartnarController;
use App\Http\Controllers\Backend\PassionsectionController;
use App\Http\Controllers\Backend\PaswordchangeController;
use App\Http\Controllers\Backend\PrivacypolicyController;
use App\Http\Controllers\Backend\ProductctController;
use App\Http\Controllers\Backend\ServiceproviderController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SolutionproviderController;
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
use App\Http\Controllers\Backend\ContacformController;
use App\Http\Controllers\Backend\ContactinfoController;
use App\Http\Controllers\Backend\BlogcategoryController;
use App\Http\Controllers\Backend\Blogcontroller;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\PresentationvideoController;
use App\Http\Controllers\Backend\SolutionCategoryController;
use App\Http\Controllers\Backend\SolutionCategorysubController;
use App\Http\Controllers\Backend\SolutionController;
use App\Http\Controllers\Backend\VideosectionController;
use App\Http\Controllers\Backend\WorkreferencescategoryController;
use App\Http\Controllers\Backend\WorkreferencesController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TotalreferreduseController;
use App\Http\Controllers\Userauth\ForgotPasswordController;
use App\Http\Controllers\UserlottryController;
use App\Http\Controllers\UserregistionController;
use App\Models\Contacinfo;
use Illuminate\Support\Facades\Route;


// Admin login/logout
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('logout', [AdminController::class, 'logout'])->name('logout');


// Frontend route
 Route::get('/', [FrontendController::class, 'frontend'])->name('frontend');
 Route::get('privacy', [FrontendController::class, 'privacy'])->name('privacy');
 Route::get('contacts', [FrontendController::class, 'contacts'])->name('contacts');
 Route::get('termsconditions', [FrontendController::class, 'termsconditions'])->name('termsconditions');
 Route::get('blogposts', [FrontendController::class, 'blogpost'])->name('blogpost');
 Route::get('blogslug/{slug}', [FrontendController::class, 'blogShow'])->name('blogshowpost');
 Route::resource('contactform',ContacformController::class);
 Route::get('videosections', [FrontendController::class, 'videosections'])->name('videoe.section');
 Route::get('galleries', [FrontendController::class, 'galleries'])->name('galleries.video');
Route::get('categorywisesoluction', [FrontendController::class, 'categorywisesoluction'])->name('categorywisesoluction');
Route::get('solutions/category/{slug}', [FrontendController::class, 'categoryWiseSolution'])->name('category.wise.solution');
Route::get('solutions/subcategory/{slug}', [FrontendController::class, 'subcategoryWiseSolution'])->name('subcategory.wise.solution');
Route::get('termsandconditions', [FrontendController::class, 'termsandconditions'])->name('termsand.conditions');
Route::get('privacyand', [FrontendController::class, 'privacyand'])->name('privacy.and');
 // Change this

Route::get('work-reference', [FrontendController::class, 'workReference'])->name('work.reference');
Route::get('work-reference/{slug}', [FrontendController::class, 'workReferenceShow'])->name('work.reference.show');

Route::get('products/{slug}', [FrontendController::class, 'productdetails'])->name('productdetails');


Route::get('/products/category/{slug}', [FrontendController::class, 'categoryWiseProducts'])->name('category.wise.products');

// Subcategory-wise products
Route::get('/products/subcategory/{slug}', [FrontendController::class, 'subcategoryWiseProducts'])->name('subcategory.wise.products');


Route::get('user/chat',        [ChatController::class, 'index'])->name('user.chat');
Route::get('user/chat/fetch',  [ChatController::class, 'fetch'])->name('user.chat.fetch');
Route::post('user/chat/send',  [ChatController::class, 'send'])->name('user.chat.send');
Route::get('user/chat/list',   [ChatController::class, 'userList'])->name('user.chat.list');


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
    Route::resource('product',ProductctController::class);
    Route::resource('mission',MissionController::class);
    Route::resource('passionsection',PassionsectionController::class);
    Route::resource('solutionprovider',SolutionproviderController::class);
    Route::resource('serviceprovider',ServiceproviderController::class);
    Route::resource('contactinfo',ContactinfoController::class);

    Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{contact}', [AdminContactController::class, 'show'])->name('contact.show');
    Route::put('/contact/{contact}/status', [AdminContactController::class, 'updateStatus'])->name('contact.update-status');
    Route::delete('/contact/{contact}', [AdminContactController::class, 'destroy'])->name('contact.destroy');
    Route::delete('/contact-bulk-delete', [AdminContactController::class, 'bulkDelete'])->name('contact.bulk-delete');


    Route::resource('blogcategory', BlogcategoryController::class);
    Route::resource('blog', Blogcontroller::class);
    Route::resource('videosection', VideosectionController::class);
    Route::resource('Presentationvideo', PresentationvideoController::class);
    Route::resource('Presentationvideo', PresentationvideoController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('workreferencecategory',WorkreferencescategoryController::class);
    Route::resource('workreferencec',WorkreferencesController::class);
    Route::resource('solutioncategory',SolutionCategoryController::class);
    Route::resource('solutionsubcategory', SolutionCategorysubController::class);
    Route::resource('solutions', SolutionController::class);

    //   admin user account view start end


});







