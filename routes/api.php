<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/registerMobile', [AuthController::class, 'registerMobile']);
Route::post('/verifyOTP', [AuthController::class, 'verifyOTP']);
Route::post('/loginMobile', [AuthController::class, 'loginMobile']);
Route::post('/resend-otp-email', [AuthController::class, 'resendOTPEmail']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/proyek/{id}', [MobileController::class, 'getProyekDetail']);
Route::get('proyek-aktif', [MobileController::class, 'getActiveProjects']);
Route::get('/detailProyekAll', [MobileController::class, 'getAllProyekDetails']);
Route::get('/searchProyek', [MobileController::class, 'searchProyek']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getHomeData', [MobileController::class, 'getHomeData']);
    Route::post('/investInProject', [MobileController::class, 'investInProject']);
    Route::post('/submitPengajuanInvestasi', [MobileController::class, 'submitPengajuanInvestasi']);
    Route::post('/submitPengajuanInternet', [MobileController::class, 'submitPengajuanInternet']);
    Route::get('/user/profile', [MobileController::class, 'getUserProfile']);
    Route::post('/user/update', [MobileController::class, 'updateUserProfile']);
    Route::post('/tarikSaldo', [MobileController::class, 'tarikSaldo']);
    Route::get('/getInvestasiData', [MobileController::class, 'getInvestasiData']);
    Route::get('/riwayatMutasi', [MobileController::class, 'riwayatMutasi']);
    Route::get('/getInvestDataDetail', [MobileController::class, 'getInvestDataDetail']);
    Route::get('/getProjectInvestDetail/{projectId}', [MobileController::class, 'getProjectInvestDetail']);
    Route::get('/user-invested-projects', [MobileController::class, 'getUserInvestedProjects']);
    Route::get('/saldoInvestasi', [MobileController::class, 'getSaldoNonInvestasi']);
    Route::post('/checkUserInvestment', [MobileController::class, 'checkUserInvestment']);
    Route::put('/update-bank-account', [MobileController::class, 'updateBankAccount']);
    Route::get('/jurnal-investasi/{id_proyek}', [MobileController::class, 'getJurnalByProyek']);
    Route::get('/notifikasi', [MobileController::class, 'getNotifikasi']);
    Route::get('/riwayat-pembayaran', [MobileController::class, 'getRiwayatPembayaran']);
    Route::get('/getRekening', [MobileController::class, 'getRekening']);
    Route::get('/cekDataUser', [MobileController::class, 'cekDataUser']);
});