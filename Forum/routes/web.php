<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui estão as rotas registradas para sua aplicação.
| Elas são carregadas pelo RouteServiceProvider dentro de um grupo que
| contém o middleware "web".
|
*/

// Rotas públicas
Route::get('/', [AuthController::class, 'teste'])->name('teste');
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [UserController::class, 'registerUser'])->name('register');
Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Rotas gerais
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'listAllUsers'])->name('listAllUsers');
        Route::get('/{id}', [UserController::class, 'listUserById'])->name('listUserById');
        Route::put('/{id}/update', [UserController::class, 'updateUser'])->name('updateUser');
        Route::get('/{id}/edit', [UserController::class, 'editUser'])->name('editUser');
        Route::delete('/{id}/delete', [UserController::class, 'deleteUser'])->name('deleteUser');
    });


    Route::middleware(['admin'])->group(function () {
        Route::prefix('tags')->group(function () {
            Route::put('/{id}/update', [TagController::class, 'updateTag'])->name('updateTag');
            Route::get('/{id}/edit', [TagController::class, 'editTag'])->name('editTag');
            Route::get('/{id}/delete', [TagController::class, 'deleteTag'])->name('deleteTag');
            Route::put('/{id}/suspend', [UserController::class, 'suspendUser'])->name('suspendUser');
        });

        Route::prefix('categories')->group(function () {
            Route::put('/{id}/update', [CategoryController::class, 'updateCategory'])->name('updateCategory');
            Route::delete('/{id}/delete', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        });
    });

    // Rotas do TopicController
    Route::prefix('topics')->group(function () {
        Route::get('/', [TopicController::class, 'listAllTopics'])->name('listAllTopics');
        Route::get('/create', [TopicController::class, 'showCreateForm'])->name('showCreateForm');
        Route::post('/', [TopicController::class, 'createTopic'])->name('createTopic');
        Route::get('/{id}', [TopicController::class, 'listTopicById'])->name('listTopicById');
        Route::put('/{id}/update', [TopicController::class, 'updateTopic'])->name('updateTopic');
        Route::get('/{id}/edit', [TopicController::class, 'editTopic'])->name('editTopic');
        Route::get('/{id}/delete', [TopicController::class, 'deleteTopic'])->name('deleteTopic');
    });

    // Rotas do PostController
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'listAllPosts'])->name('listAllPosts');
        Route::get('/{id}', [PostController::class, 'listPostById'])->name('listPostById');
        Route::post('/create', [PostController::class, 'createPost'])->name('createPost');
        Route::put('/{id}/update', [PostController::class, 'updatePost'])->name('updatePost');
        Route::get('/{id}/edit', [PostController::class, 'editPost'])->name('editPost');
        Route::delete('/{id}/delete', [PostController::class, 'deletePost'])->name('deletePost');
    });

    // Rotas do TagController
    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'listAllTags'])->name('listAllTags');
        Route::get('/{id}', [TagController::class, 'listTagById'])->name('listTagById');
        Route::post('/', [TagController::class, 'createTag'])->name('createTag');
    });

    // Rotas do CategoryController
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'listAllCategories'])->name('listAllCategories');
        Route::get('/create', [CategoryController::class, 'listCreateCategory'])->name('listCreateCategory');
        Route::get('/{id}', [CategoryController::class, 'listCategoryById'])->name('listCategoryById');
        Route::post('/create', [CategoryController::class, 'createCategory'])->name('createCategory');
    });

    // Rotas da conta do usuário
    Route::prefix('myaccount')->group(function () {
        Route::get('/', [UserController::class, 'myAccount'])->name('myAccount');
        Route::put('/update', [UserController::class, 'updateAccount'])->name('updateAccount');
        Route::delete('/delete', [UserController::class, 'deleteAccount'])->name('deleteAccount');
    });
});
