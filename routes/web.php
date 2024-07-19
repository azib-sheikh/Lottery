<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\LotteryController;
use App\Http\Controllers\Backend\UserController as BackendUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\LotteryController as UserLotteryController;
use App\Http\Controllers\User\TransactionController as UserTransactionController;
use App\Http\Controllers\API\CartController;

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

Route::get('/clear-cache', function () {
    $exitCode = \Artisan::call('route:clear');
    $exitCode = \Artisan::call('cache:clear');
    $exitCode = \Artisan::call('config:cache');
    $exitCode = \Artisan::call('view:clear');

    echo "cache,config,route,view clear succesfully";
    // return what you want
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/lottery-details-ajax', [HomeController::class, 'lottery_details_ajax'])->name('home.lottery_details_ajax');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('addToCart');

Route::get('/about-us', function () {
    return view('landing.about-us');
})->name('landing.about-us');

Route::get('/lottery', function () {
    return view('landing.lottery');
})->name('landing.lottery');

Route::get('/contact-us', function () {
    return view('landing.contact-us');
})->name('landing.contact-us');

Route::get('login', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('register', function () {
    return view('auth.register');
})->name('auth.register');
Route::get('/checkout', function () {
    return view('landing.checkout');
})->name('landing.checkout');

Route::group(['middleware' => ['guest']], function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('login', [AuthController::class, 'adminLogin'])->name('login');
        Route::post('login/post', [AuthController::class, 'adminLoginPost'])->name('login.post');
    });
});


Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('generateOtp', [AuthController::class, 'generateOtp'])->name('generateOtp');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

    /**
     * Admin Authentication routes
     */
    // Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    //     Route::get('login', [AuthController::class, 'adminLogin'])->name('login');
    //     Route::post('login/post', [AuthController::class, 'adminLoginPost'])->name('login.post');
    // });
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth', 'role:user']], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/check-helper-function', [DashboardController::class, 'check_helper_function'])->name('check_helper_function');

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
        Route::post('update', [ProfileController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'lottery', 'as' => 'lottery.'], function () {
        Route::get('/', [UserLotteryController::class, 'index'])->name('index');
        Route::get('/chooseNumbers/{lotteryId}', [UserLotteryController::class, 'chooseNumbers'])->name('chooseNumbers');
        Route::post('/checkout', [UserLotteryController::class, 'checkout'])->name('checkout');
        Route::post('/saveChosenNumbers', [UserLotteryController::class, 'saveChosenNumbers'])->name('saveChosenNumbers');
        Route::get('/showChosenNumbers/{lotteryId}', [UserLotteryController::class, 'showChosenNumbers'])->name('showChosenNumbers');
    });

    Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function () {
        Route::get('/', [UserTransactionController::class, 'index'])->name('index');
        Route::get('/show', [UserTransactionController::class, 'show'])->name('show');
    });
    Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function () {
        Route::get('/', function () {
            return view('user.wallet.index');
        });
    });
});

/**
 * Admin panel routes
 */

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:superadmin|admin']], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [BackendUserController::class, 'index'])->name('index');
        Route::get('/create', [BackendUserController::class, 'CreateUser'])->name('create');
        Route::post('/store', [BackendUserController::class, 'StoreUser'])->name('store');
    });

    Route::group(['prefix' => 'lotteryMaster', 'as' => 'lotteryMaster.'], function () {
        Route::get('/', [LotteryController::class, 'lotteryMasterIndex'])->name('index');
        Route::get('/create', [LotteryController::class, 'lotteryMasterCreate'])->name('create');
        Route::post('/store', [LotteryController::class, 'lotteryMasterStore'])->name('store');
    });

    Route::group(['prefix' => 'lottery', 'as' => 'lottery.'], function () {
        Route::get('/', [LotteryController::class, 'lotteryIndex'])->name('index');
        Route::get('/create', [LotteryController::class, 'lotteryCreate'])->name('create');
        Route::post('/store', [LotteryController::class, 'lotteryStore'])->name('store');
        Route::get('/show', [LotteryController::class, 'lotteryShow'])->name('show');
        Route::get('/showChosenNumbers/{lotteryId}', [LotteryController::class, 'lotteryShowChosenNumbers'])->name('showChosenNumbers');
    });
});
