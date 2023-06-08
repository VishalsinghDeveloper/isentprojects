<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\CustomerApiController;
use App\Http\Controllers\API\BannerApiController;
use App\Http\Controllers\API\FAQApiController;
use App\Http\Controllers\API\OfferApiController;
use App\Http\Controllers\API\HistoryApiController;
use App\Http\Controllers\API\TemplateApiController;
use App\Http\Controllers\API\MarketingTipsApiController;
use App\Http\Controllers\API\NotificationApiController;
use App\Http\Controllers\API\PoliciesController;
use App\Http\Middleware\UserMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/verify-otp', [AuthApiController::class, 'verifyOtp']);
Route::post('/register', [AuthApiController::class, 'register']);

Route::middleware(['auth:sanctum','user.api'])->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::post('change-password', [AuthApiController::class, 'changePassword']);
    Route::post('change-profile', [AuthApiController::class, 'updateProfile']);

    Route::get('/customers', [CustomerApiController::class, 'index'])->name('customer.index');
    Route::post('/store-customers', [CustomerApiController::class, 'store'])->name('customer.store');

    Route::get('banners', [BannerApiController::class, 'index']);

    Route::get('faqs', [FAQApiController::class, 'index']);

    Route::post('offers-send', [OfferApiController::class, 'sendOffer']);

    Route::get('history', [HistoryApiController::class, 'getHistory']);

    Route::get('template', [TemplateApiController::class, 'index']);

    Route::get('MarketingTips', [MarketingTipsApiController::class, 'index']);

    Route::get('notification', [NotificationApiController::class, 'index']);

    Route::get('policies', [PoliciesController::class, 'index']);
});
