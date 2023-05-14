<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunController;

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


Route::get('/', function () {
    return view('backend.auth.login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login.action');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    //admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/adminAdd', [AdminController::class, 'add'])->name('admin.add');
    Route::post('/admin/add', [AdminController::class, 'addProses'])->name('admin.addproses');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/editProses', [AdminController::class, 'editProses'])->name('admin.editProses');
    Route::get('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    //siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/siswaAdd', [SiswaController::class, 'add'])->name('siswa.add');
    Route::post('/siswa/add', [SiswaController::class, 'addSiswa'])->name('siswa.addproses');
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::post('/siswa/editProses', [SiswaController::class, 'editProses'])->name('siswa.editProses');
    Route::get('/siswa/delete/{id}', [SiswaController::class, 'delete'])->name('siswa.delete');
    //Tahun AJaran
    Route::get('/tahun', [TahunController::class, 'view'])->name('tahun');
    Route::get('/tahunAdd', [TahunController::class, 'add'])->name('tahun.add');
    Route::post('/tahun/add', [TahunController::class, 'addProses'])->name('tahun.addproses');
    Route::get('/tahun/edit/{id}', [TahunController::class, 'edit'])->name('tahun.edit');
    Route::post('/tahun/editProses', [TahunController::class, 'editProses'])->name('tahun.editProses');
    Route::get('/tahun/delete/{id}', [TahunController::class, 'delete'])->name('tahun.delete');
});

Route::get('/route-cache', function () {
    Artisan::call('route:cache');
    return 'Routes cache cleared';
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Config cache cleared';
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared';
});
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'View cache cleared';
});
Route::get('/optimize', function () {
    Artisan::call('optimize');
    return 'Routes cache cleared';
});
