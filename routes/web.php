<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuickCountController;
use App\Http\Controllers\RealCountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


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

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('role:superadmin');
Route::post('/register', [AuthController::class, 'registrasiAkun'])->name('registrasiAkun')->middleware('role:superadmin');
Route::post('users/{user}/edit', [userController::class, 'editDataUser'])->name('EditAkun')->middleware('role:superadmin,admin');
Route::post('users/{user}/delete', [userController::class, 'deleteDatauser'])->name('user.deleteDatauser')->middleware('role:superadmin,admin');

Route::group(['middleware' => 'guest'], function () {
    //route login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginAuth'])->name('loginAuth');
});
// route register

Route::group(['middleware' => 'auth'], function () {
    //route logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    //route home
    Route::get('/', [DashboardController::class, 'index'])->name('showAllProjects');
    Route::get('/data-chart', [DashboardController::class, 'getDataForChart'])->name('chart.data');
    //route quick count
    Route::get('/quickCount', [QuickCountController::class, 'index'])->name('QuickCount.showQuickCount');
    Route::get('/quickCount-form', [QuickCountController::class, 'insert'])->name('QuickCount.insert')->middleware('role:superadmin,admin');
    Route::post('/quickCount-form/insert', [QuickCountController::class, 'insertdata'])->name('QuickCount.insertData')->middleware('role:superadmin,admin');
    //route real count
    Route::get('/real-count', [RealCountController::class, 'index'])->name('RealCount.showRealCount');
    Route::get('/real-count-form', [RealCountController::class, 'insert'])->name('RealCount.insert')->middleware('role:superadmin,admin');
    Route::post('/real-count-form/insert', [RealCountController::class, 'insertdata'])->name('RealCount.insertData')->middleware('role:superadmin,admin');

    //route user management
    Route::get('/user', [UserController::class, 'userShowAll'])->name('user.userShowAll');
    Route::post('/addDataUser', [UserController::class, 'addDataUser'])->name('user.addDataUser')->middleware('role:superadmin,admin');
    Route::post('users/{user}/edit', [UserController::class, 'editDataUser'])->name('user.editDataUser')->middleware('role:superadmin');
    Route::post('users/{user}/delete', [UserController::class, 'deleteDataUser'])->name('user.deleteDataUser')->middleware('role:superadmin');
});
