<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::Post('/v1/auth/logout', [AuthController::class, 'logout']);
    Route::Post('/v1/forms', [FormController::class, 'create']);
    Route::get('/v1/forms', [FormController::class, 'forms']);
    Route::get('/v1/forms/{slug}', [FormController::class, 'Detailforms']);
    Route::Post('/v1/forms/{slug}/question', [QuestionController::class, 'create']);
    Route::delete('/v1/forms/{slug}/question/{question_id}', [QuestionController::class, 'remove']);
    Route::get('/v1/question/{formid}', [QuestionController::class, 'getall']);
    Route::post('/v1/forms/{slug}/response', [ResponseController::class, 'create']);
    Route::get('/v1/forms/{slug}/response', [ResponseController::class, 'show']);
});

Route::Post('/v1/auth/login', [AuthController::class, 'login']);
Route::Post('/v1/register', [UserController::class, 'create']);
