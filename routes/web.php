<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\BillCategory;
use App\Http\Controllers\FlatRentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\FlatRentBillController;
use App\Http\Controllers\FlatRentBillLedgerController;

Route::get('/', function () {
    return view('auth/login');
});

// profile route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// __home controller__ //
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
});


// __admin route__ //
Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('house', HouseController::class);
    Route::resource('floor', FloorController::class);
});


// __flat route__ //
Route::middleware('auth')->group(function () {

    Route::resource('flat', FlatController::class);

    // __get floor by select the house dropdown__ //
    Route::get('/getFloors_house/{houseId}', [FlatController::class, 'getFloorsByHouse'])->name('flat.getFloor_house');
});


// __flat rents route__ //
Route::middleware('auth')->group(function () {
    Route::resource('flatrent', FlatRentController::class);

    // __get floor by select the house dropdown__ //
    Route::get('/getFloors/{houseId}', [FlatRentController::class, 'getFloorsByHouse'])->name('flatrent.getFloor');
    Route::get('/getFlat/{floorId}', [FlatRentController::class, 'getFlatByFloor'])->name('flatrent.getFlat');
});

// __Accounts route__ //
Route::middleware('auth')->group(function () {
    Route::get('account/balance/report', [AccountController::class, 'balance'])->name('account.balance.report');


    Route::get('/account-ledger', [AccountController::class, 'ledger'])->name('account.ledger');
    Route::get('account-ledger-print', [AccountController::class, 'print'])->name('account.ledger.print');
    Route::resource('/account', AccountController::class);
});


// __bill  route__ //
Route::middleware('auth')->group(function () {

    Route::get('bill-list', [FlatRentBillController::class, 'list'])->name('bill.list');
    Route::post('/get-flats-by-house', [FlatRentBillController::class, 'getFlatsByHouse'])->name('getFlatsByHouse');

    Route::get('bill-print', [FlatRentBillController::class, 'printBill'])->name('bill.print');
    Route::get('bill-report_print', [FlatRentBillController::class, 'reportPrintBill'])->name('bill.report_print');

    Route::get('/bill/{id}/print', [FlatRentBillController::class, 'single_print'])->name('bill.single.print');

    Route::get('bill-payment/{id}', [FlatRentBillController::class, 'bill_payment'])->name('bill.payment');


    // update payment
    Route::post('/bill/update_payment/{id}', [FlatRentBillController::class, 'update_bill_payment'])->name('bill.update_payment');
    Route::resource('bill-category', BillCategory::class);

    Route::get('bill-ledger', [FlatRentBillLedgerController::class, 'ledger'])->name('bill.ledger');
    Route::get('bill-ledger-print', [FlatRentBillLedgerController::class, 'print'])->name('bill.ledger.print');


    Route::resource('bill', FlatRentBillController::class);
});

// transaction payment route
Route::middleware('auth')->group(function () {
    Route::resource('bill-payment-list', FlatRentBillLedgerController::class);
});

require __DIR__ . '/auth.php';
