<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PullController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransferController; // Yeni controller
/*use App\Models\Group;
use App\Models\Deposit;
use Illuminate\Support\Facades\DB;
Route::get('/test', function() {
    $group = Group::leftJoin(DB::raw('(SELECT group_id, SUM(balance) AS balances FROM deposits GROUP BY group_id) as v'), 'v.group_id', '=', 'groups.id')
            ->orderBy('balances', 'desc')
            ->where('balances', '>', 0)
            ->get();
    $deposit = Deposit::orderBy('balance','DESC')->where('balance', '>',0)->get();
    dd($group);
});*/

Route::get('/', [CustomAuthController::class, 'index'])->name('home');

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
/*Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');*/
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::middleware('isLogin')->name('admin.')->group(function () {
    // Define the dashboard route (remove duplicate)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Transfer Route
    Route::get('transfer', [TransferController::class, 'index'])->name('transfer.index');
    Route::post('transfer', [TransferController::class, 'store'])->name('transfer.store');
    Route::get('profile/edit/{id}', [CustomAuthController::class, 'profileEdit'])->name('profile.edit');
    Route::post('profile/edit/{id}', [CustomAuthController::class, 'profileEditPost'])->name('profile.edit.post');

    Route::get('users', [CustomAuthController::class, 'users'])->name('users.index')->middleware(['roleChecker:admin']);
    Route::get('user/create', [CustomAuthController::class, 'userCreate'])->name('users.create')->middleware(['roleChecker:admin']);
    Route::post('user/create', [CustomAuthController::class, 'userCreatePost'])->name('users.create.post')->middleware(['roleChecker:admin']);
    Route::post('user/{id}', [CustomAuthController::class, 'userDestroy'])->name('users.destroy')->middleware(['roleChecker:admin']);

    Route::resource('deposits', DepositController::class)->middleware(['roleChecker:admin']);
    Route::resource('investments', InvestmentController::class);
    Route::resource('payments', PaymentController::class)->middleware(['roleChecker:admin']);
    Route::resource('pulls', PullController::class);
    Route::resource('statements', StatementController::class)->middleware(['roleChecker:admin']);
    Route::resource('groups', GroupController::class)->middleware(['roleChecker:admin']);

    Route::get('investment/import', [InvestmentController::class, 'investImport'])->name('investment.import.get');
    Route::post('investment/import', [InvestmentController::class, 'investImportPost'])->name('investment.import');

    Route::get('payment/import', [PaymentController::class, 'paymentImport'])->name('payment.import.get');
    Route::post('payment/import', [PaymentController::class, 'paymentImportPost'])->name('payment.import');

    Route::get('pull/import', [PullController::class, 'pullImport'])->name('pull.import.get');
    Route::post('pull/import', [PullController::class, 'pullImportPost'])->name('pull.import');
});