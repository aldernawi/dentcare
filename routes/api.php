<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;

use App\Http\Controllers\api\CardController;
use App\Http\Controllers\api\DoctorController;
use App\Http\Controllers\api\RatingController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\ServiceController;
use App\Http\Controllers\api\ConversationController;
use App\Http\Controllers\api\NotificationController;
use App\Http\Controllers\api\DoctorScheduleController;
use App\Http\Controllers\api\StatusController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/card', [CardController::class, 'card']);
    Route::delete('cardDelete/{id}', [CardController::class, 'delete']);
    Route::post('addCard', [CardController::class, 'store']);
    Route::get('/conversations', [ConversationController::class, 'index']);
    Route::post('/conversations/store', [ConversationController::class, 'store']);
    Route::post('/conversationsDoctor/store', [ConversationController::class, 'conversationsDoctorStore']);
    Route::get('/conversations/{id}', [MessageController::class, 'fetchMessages']);
    Route::patch('/conversations/{id}/read', [MessageController::class, 'markAsRead']);
    Route::post('/conversations/{id}/messages', [MessageController::class, 'sendMessage']);
    Route::get('/DoctorHome', [DoctorScheduleController::class, 'getDoctorHomeData']);
    Route::get('/reservations', [CardController::class, 'DoctorCard']);
    Route::patch('/reservations/{id}', [CardController::class, 'DoctorCardUpdate']);
    Route::get('/conversationsDoctor/{userid}/{doctorid}', [ConversationController::class, 'conversationsDoctor']);
    Route::get('/conversationsDoctor', [ConversationController::class, 'convDoctor']);
    Route::delete('/conversation/{id}', [ConversationController::class, 'convDelete']);
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/doctorNotifications', [NotificationController::class, 'doctor']);
    Route::post('/rate-doctor', [RatingController::class, 'store']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::put('/user/upload_image', [AuthController::class, 'uploadimage']);
});
Route::get('/doctors/{id}/cv', [DoctorController::class, 'getDoctorCV']);
Route::get('services', [ServiceController::class, 'index']);
Route::get('doctors/{id}', [ServiceController::class, 'doctors']);
Route::get('doctors', [ServiceController::class, 'Alldoctors']);

Route::get('/status', [StatusController::class, 'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/doctor', [AuthController::class, 'loginDoctor']);