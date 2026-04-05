<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\TemanController as PublicTemanController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

// auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// email
Route::get('/email/verify', function () {
  return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();

  return back()->with('message', 'Link verifikasi sudah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/test-mail', function () {
  try {
    Mail::raw('Halo Samuel, ini email test resmi dari FBclone.', function ($msg) {
      $msg->from('samuelmaraneswa120@gmail.com', 'FBclone Admin')
        ->to('samuelmaraneswa80@gmail.com')
        ->subject('Test Laravel Email FBclone');
    });

    return 'Email terkirim!';
  } catch (\Exception $e) {
    return $e->getMessage();
  }
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request){
  $request->fulfill();
  return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// route public
Route::prefix('/')->name('public.')->group(function(){

  Route::get('/teman', [PublicTemanController::class, 'index'])->name('teman');

  Route::get('/group', function () {
    return view('public.group');
  })->name('group');

  Route::get('/marketplace', function () {
    return view('public.marketplace');
  })->name('marketplace');

  Route::get('/reels', function () {
    return view('public.reels');
  })->name('reels');

  Route::get('/profile/{tab?}', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
});

