<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectWithUserController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', function () {
    return User::all();
});

Route::post('login', LoginController::class);

Route::post('logout', LogoutController::class);

Route::post('register', [RegisterController::class, 'register']);

Route::get('student', [StudentController::class, 'index']);

Route::post('student', [StudentController::class, 'upload']);

Route::put('student/edit/{id}', [StudentController::class, 'edit']);

Route::delete('student/edit/{id}', [StudentController::class, 'delete']);

// モデル募集フォーム
Route::get('/subject', [SubjectController::class, 'index']);

Route::post('subject', [SubjectController::class, 'upload']);

Route::put('subject/edit/{id}', [SubjectController::class, 'edit']);

Route::delete('subject/edit/{id}', [SubjectController::class, 'delete']);


// ユーザーがいる状態のモデル編集ページ
Route::get('{user_id}/subject', [SubjectWithUserController::class, 'index']);

Route::post('{user_id}/subject', [SubjectWithUserController::class, 'upload']);

Route::put('{user_id}/subject/edit/{subject_id}', [SubjectWithUserController::class, 'edit']);

Route::delete('{user_id}/subject/edit/{subject_id}', [SubjectWithUserController::class, 'delete']);
