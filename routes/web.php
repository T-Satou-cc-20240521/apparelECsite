<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\UserOrderController;
use App\Http\Controllers\Admin\UserFavoriteController;
use App\Http\Controllers\Admin\UserReviewController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\FavoriteController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\MyPageController;
use App\Http\Controllers\User\OrderController;


Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    // 管理画面トップ
    Route::get('/top', [AdminController::class, 'top'])->name('top');
    // 商品管理
    Route::get('/product/list', [ProductController::class, 'list'])->name('product.list');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::post('/product/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('product.delete');
    // ユーザー管理
    Route::get('/', [UserManagementController::class, 'index'])->name('index');
    Route::get('/{id}', [UserManagementController::class, 'detail'])->name('detail');
    Route::get('/{id}/edit', [UserManagementController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [UserManagementController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserManagementController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/{id}/favorites', [UserFavoriteController::class, 'index'])->name('favorites.index');
    Route::get('/{id}/reviews', [UserReviewController::class, 'index'])->name('reviews.index');
    // 注文管理
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{id}', [OrderController::class, 'detail'])->name('detail');
    Route::post('/{id}/status-update', [OrderController::class, 'updateStatus'])->name('status.update');
    Route::get('/{id}/shipment/edit', [OrderController::class, 'editShipment'])->name('shipment.edit');
    Route::post('/{id}/shipment/update', [OrderController::class, 'updateShipment'])->name('shipment.update');
    Route::delete('/{id}', [OrderController::class, 'destroy'])->name('destroy');
    // レポート管理
    Route::get('/product/list', [ProductController::class, 'list'])->name('product.list');
    Route::get('/sales', [ReportController::class, 'sales'])->name('sales');
    Route::get('/popular-products', [ReportController::class, 'popularProducts'])->name('popular.products');
    Route::get('/customers', [ReportController::class, 'customers'])->name('customers');
});

Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
    // ユーザー登録関連
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register/confirm', [RegisterController::class, 'confirm'])->name('register.confirm');
    Route::post('/register/complete', [RegisterController::class, 'complete'])->name('register.complete');
    // 認証関連
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // SNSログイン用
    Route::get('/{provider}/redirect', [SocialLoginController::class, 'redirectToProvider'])->name('social.redirect');
    Route::get('/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('social.callback');
});

Route::group(['prefix' => '/user', 'as' => 'user.'], function () {
    // 一般ユーザートップ
    Route::get('/top', [UserController::class, 'top'])->name('top');
    // 一般ユーザー商品
    Route::get('/product/list', [UserProductController::class, 'list'])->name('product.list');
    Route::get('/product/{id}', [UserProductController::class, 'detail'])->name('product.detail');
    // 一般ユーザーカート
    Route::get('/cart/list', [CartController::class, 'list'])->name('cart.list');
    Route::get('/cart/{id}', [CartController::class, 'detail'])->name('cart.detail');
});
Route::group(['prefix' => '/user', 'as' => 'user.', 'middleware' => 'auth'], function () {
    // 一般ユーザーお気に入り
    Route::post('/favorite/{id}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    //一般ユーザープロフィール
    Route::get('/MyPage/edit', [MyPageController::class, 'edit'])->name('MyPage.edit');
    Route::post('/MyPage/update', [MyPageController::class, 'update'])->name('MyPage.update');
    //一般ユーザー購入履歴
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{id}', [OrderController::class, 'detail'])->name('detail');
    //一般ユーザー購入画面
    Route::post('/cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');
    Route::post('/cart/complete', [CartController::class, 'complete'])->name('cart.complete');
});