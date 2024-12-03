<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
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

Route::get('/topics/list', [TopicController::class, 'listAllTopics'])->name('listAllTopics');
Route::post('/topics/store', [TopicController::class, 'store'])->name('storeTopic');
Route::get('/topics/create', [TopicController::class, 'createTopic'])->name('createTopic');
Route::get('/topics/{id}', [TopicController::class, 'listTopicById'])->name('listTopicById');
Route::put('/topics/{id}/update', [TopicController::class, 'updateTopic'])->name('updateTopic');
Route::get('/topics/{id}/edit', [TopicController::class, 'editTopic'])->name('editTopic');
Route::get('/topics/{id}/delete', [TopicController::class, 'deleteTopic'])->name('deleteTopic');

Route::middleware(['auth'])->group(function () {

    // Rotas gerais
    Route::get('/users', [UserController::class, 'listAllUsers'])->name('listAllUsers');
    Route::get('/users/{id}', [UserController::class, 'listUserById'])->name('listUserById');
    Route::put('/users/{id}/update', [UserController::class, 'updateUser'])->name('updateUser');
    Route::get('/users/{id}/edit', [UserController::class, 'editUser'])->name('editUser');
    Route::delete('/users/{id}/delete', [UserController::class, 'deleteUser'])->name('deleteUser');

    Route::middleware(['admin'])->group(function () {
        Route::put('/tags/{id}/update', [TagController::class, 'updateTag'])->name('updateTag');
        Route::get('/tags/{id}/edit', [TagController::class, 'editTag'])->name('editTag');
        Route::get('/tags/{id}/delete', [TagController::class, 'deleteTag'])->name('deleteTag');
        Route::put('/users/{id}/suspend', [UserController::class, 'suspendUser'])->name('suspendUser');

        Route::put('/categories/{id}/update', [CategoryController::class, 'updateCategory'])->name('updateCategory');
        Route::delete('/categories/{id}/delete', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    });

    // Rotas do TopicController
  

    // Rotas do PostController
    Route::get('/posts', [PostController::class, 'listAllPosts'])->name('listAllPosts');
    Route::get('/posts/{id}', [PostController::class, 'listPostById'])->name('listPostById');
    Route::post('/posts/create', [PostController::class, 'createPost'])->name('createPost');
    Route::put('/posts/{id}/update', [PostController::class, 'updatePost'])->name('updatePost');
    Route::get('/posts/{id}/edit', [PostController::class, 'editPost'])->name('editPost');
    Route::delete('/posts/{id}/delete', [PostController::class, 'deletePost'])->name('deletePost');

    // Rotas do TagController
    Route::get('/tags', [TagController::class, 'listAllTags'])->name('listAllTags');
    Route::get('/tags/{id}', [TagController::class, 'listTagById'])->name('listTagById');
    Route::post('/tags', [TagController::class, 'createTag'])->name('createTag');

    // Rotas do CategoryController
    Route::get('/categories', [CategoryController::class, 'listAllCategories'])->name('listAllCategories');
    Route::get('/categories/create', [CategoryController::class, 'listCreateCategory'])->name('listCreateCategory');
    Route::get('/categories/{id}', [CategoryController::class, 'listCategoryById'])->name('listCategoryById');
    Route::post('/categories/create', [CategoryController::class, 'createCategory'])->name('createCategory');

    // Rotas da conta do usuário
    Route::get('/myaccount', [UserController::class, 'myAccount'])->name('myAccount');
    Route::put('/myaccount/update', [UserController::class, 'updateAccount'])->name('updateAccount');
    Route::delete('/myaccount/delete', [UserController::class, 'deleteAccount'])->name('deleteAccount');
});
