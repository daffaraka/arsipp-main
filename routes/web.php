<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\Admin\LetterController;
use App\Http\Controllers\Admin\SenderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\BatchRecordController;
use App\Http\Controllers\Admin\BatchTrackingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/storage-link', function () {
    $targetFolder = base_path() . '/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

Route::get('/clear-cache', function () {
    Artisan::call('route:cache');
});

Route::get('/log', [LoginController::class, 'index']);
Route::get('/', function(){
    return view('index');
});

// Authentication
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//Admin
Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('/department', DepartmentController::class);
        Route::resource('/sender', SenderController::class);
        Route::resource('/letter', LetterController::class, [
            'except' => ['show']
        ]);
        Route::get('letter/delete/{id}', [LetterController::class, 'destroy'])->name('letter.delete');

        Route::get('letter/arsip', [LetterController::class, 'incoming_mail'])->name('arsip');
        Route::get('letter/surat-keluar', [LetterController::class, 'outgoing_mail'])->name('surat-keluar');

        Route::get('letter/arsip/{id}', [LetterController::class, 'show'])->name('detail-surat');
        Route::get('letter/download/{id}', [LetterController::class, 'download_letter'])->name('download-surat');

        //print
        Route::get('print/surat-masuk', [PrintController::class, 'index'])->name('print-surat-masuk');
        Route::get('print/surat-keluar', [PrintController::class, 'outgoing'])->name('print-surat-keluar');

        Route::resource('user', UserController::class, [
            'except' => 'destroy'
        ]);
        Route::get('user/destroy/{id}',[UserCOntroller::class,'destroy'])->name('user.hapus');
        Route::resource('setting', SettingController::class, [
            'except' => ['show']
        ]);
        Route::get('setting/password', [SettingController::class, 'change_password'])->name('change-password');
        Route::post('setting/upload-profile', [SettingController::class, 'upload_profile'])->name('profile-upload');
        Route::post('change-password', [SettingController::class, 'update_password'])->name('update.password');

        Route::get('batch-record', [BatchRecordController::class, 'index'])->name('batch');
        Route::get('batch-record/create', [BatchRecordController::class, 'create'])->name('batch.create');
        Route::post('batch-record/store', [BatchRecordController::class, 'store'])->name('batch.store');
        Route::get('batch-record/show/{id}', [BatchRecordController::class, 'show'])->name('batch.show');
        Route::get('batch-record/edit/{id}', [BatchRecordController::class, 'edit'])->name('batch.edit');
        Route::post('batch-record/update/{id}', [BatchRecordController::class, 'update'])->name('batch.update');
        Route::get('batch-record/delete/{id}', [BatchRecordController::class, 'destroy'])->name('batch.destroy');

        Route::get('batch-tracking', [BatchTrackingController::class, 'index'])->name('tracking');
        Route::get('batch-tracking/create', [BatchTrackingController::class, 'create'])->name('tracking.create');
        Route::post('batch-tracking/store', [BatchTrackingController::class, 'store'])->name('tracking.store');
        Route::get('batch-tracking/show/{id}', [BatchTrackingController::class, 'show'])->name('tracking.show');
        Route::get('batch-tracking/edit/{id}', [BatchTrackingController::class, 'edit'])->name('tracking.edit');
        Route::post('batch-tracking/update/{id}', [BatchTrackingController::class, 'update'])->name('tracking.update');
        Route::get('batch-tracking/delete/{id}', [BatchTrackingController::class, 'destroy'])->name('tracking.destroy');




        Route::post('get-produk-kode/{id}', [SettingController::class, 'getKode'])->name('getKode');
    });
