<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MarketingTipsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PoliciesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginaction'])->name('loginaction');
// Route::get('register', [AuthController::class, 'register'])->name('register');
// Route::post('register', [AuthController::class, 'registeraction'])->name('registeraction');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::post('/change-status', [UserController::class, 'updateStatus'])->name('user-block');
    Route::get('user-delete/{id}', [UserController::class, 'delete'])->name('user-delete');

    Route::get('add-template', [TemplateController::class, 'add'])->name('add-template');
    Route::get('template', [TemplateController::class, 'index'])->name('index-template');
    Route::post('template', [TemplateController::class, 'store'])->name('templates-add');
    Route::get('template-edit/{id}', [TemplateController::class, 'edit'])->name('templates-edit');
    Route::post('template-update/{id}', [TemplateController::class, 'update'])->name('templates-update');
    Route::get('template-delete/{id}', [TemplateController::class, 'destroy'])->name('templates-delete');

    Route::get('banners', [BannerController::class, 'index'])->name('banners');
    Route::get('banners-show', [BannerController::class, 'show'])->name('banners-show');
    Route::post('banners-add', [BannerController::class, 'add_banners'])->name('banner-add');
    Route::get('banners-edit/{id}', [BannerController::class, 'edit'])->name('banners-edit');
    Route::post('banners-edit/{id}', [BannerController::class, 'update'])->name('banners-update');
    Route::get('banners-delete/{id}', [BannerController::class, 'delete'])->name('banners-delete');

    Route::get('/faqs', [FAQController::class, 'index'])->name('faqs-index');
    Route::get('/faqs-create', [FAQController::class, 'create'])->name('faqs-create');
    Route::post('/faqs', [FAQController::class, 'store'])->name('faqs-store');
    Route::get('/faqs-edit/{id}', [FAQController::class, 'edit'])->name('faqs-edit');
    Route::post('/faqs-edit/{id}', [FAQController::class, 'update'])->name('faqs-update');
    Route::get('/faqs-delete/{id}', [FAQController::class, 'destroy'])->name('faqs-destroy');

    Route::get('/marketing_tips', [MarketingTipsController::class, 'index'])->name('marketing_tips-index');
    Route::get('/marketing_tips-view/{id}', [MarketingTipsController::class, 'view'])->name('marketing_tips-view');
    Route::get('/marketing_tips-create', [MarketingTipsController::class, 'create'])->name('marketing_tips-create');
    Route::post('/marketing_tips', [MarketingTipsController::class, 'store'])->name('marketing_tips-store');
    Route::get('/marketing_tips-edit/{id}', [MarketingTipsController::class, 'edit'])->name('marketing_tips-edit');
    Route::post('/marketing_tips/{id}', [MarketingTipsController::class, 'update'])->name('marketing_tips-update');
    Route::delete('/marketing_tips/{id}', [MarketingTipsController::class, 'destroy'])->name('marketing_tips-destroy');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('change-password/{id}', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('changeprofile/{id}', [ProfileController::class, 'changeprofile'])->name('changeprofile');
    Route::post('changeimage/{id}', [ProfileController::class, 'updateimage'])->name('updateimage');

    Route::get('/history', [HistoryController::class, 'index'])->name('history-index');
    Route::get('/history/{id}', [HistoryController::class, 'view'])->name('history-view');
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification-index');
    Route::post('/notification/send', [NotificationController::class, 'send'])->name('notification-send');

    Route::get('/policies',[PoliciesController::class,'index'])->name('policies-index');
    Route::get('/policies/view/{id}',[PoliciesController::class,'view'])->name('policies-view');
    Route::get('/policies/create',[PoliciesController::class,'create'])->name('policies-create');
    Route::post('/policies/store',[PoliciesController::class,'store'])->name('policies-store');
    Route::get('/policies/edit/{id}',[PoliciesController::class,'edit'])->name('policies-edit');
    Route::post('/policies/update/{id}',[PoliciesController::class,'update'])->name('policies-update');
});
