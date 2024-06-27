<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicController;

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
Route::get('/teste', [AuthController::class, 'teste'])->name('teste');

Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');

Route::match(['get', 'post'], '/register', [UserController::class, 'register'])->name('register');

Route::Post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/users', [UserController::class, 'listAllUsers'])->name('listAllUsers');

    Route::get('/users/{id}', [UserController::class, 'listUserById'])->name('listUserById');

    Route::put('/users/{id}/update', [UserController::class, 'updateUser'])->name('updateUser');

    Route::delete('/users/{id}/delete', [UserController::class, 'deleteUser'])->name('deleteUser');

    Route::get('/Posts/{id}', [PostController::class, 'listPostById'])->name('listPostById');

    Route::put('/Posts/{id}/update', [PostController::class, 'updatePost'])->name('updatePost');

    Route::get('/Posts/{id}/delete', [PostController::class, 'deletePost'])->name('deletePost');

    Route::get('/posts/visualizar', [PostController::class, 'VizuPost'])->name('VizuPost');

    Route::get('/createPost', [PostController::class, 'createPost'])->name('createPost');

    Route::get('/Topics', [TopicController::class, 'TopicsAll'])->name('TopicsAll');

    Route::get('/Topics/{id}', [TopicController::class, 'listTopicById'])->name('listTopicById');

    Route::post('/Topics', [TopicController::class, 'createTopic'])->name('createTopic');

    Route::put('/Topics/{id}/update', [TopicController::class, 'updateTopic'])->name('updateTopic');

    Route::get('/Topics/{id}/edit', [TopicController::class, 'editTopic'])->name('editTopic');
    
    Route::get('/Topics/{id}/delete', [TopicController::class, 'deleteTopic'])->name('deleteTopic');
});
