<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LikeOrDislikeController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Category
Route::get('/category', [CategoryController::class, 'index'])->middleware('auth');
Route::get('/category-create', [CategoryController::class, 'create'])->middleware('auth');
Route::post('/create-category', [CategoryController::class, 'store'])->middleware('auth');
Route::delete('/category/{category}', [CategoryController::class, 'delete'])->middleware('auth');
Route::get('/category-update/{category}', [CategoryController::class, 'update_category'])->middleware('auth');
Route::put('/update/{category}', [CategoryController::class, 'update'])->middleware('auth');
Route::get('/category-search', [CategoryController::class, 'search'])->middleware('auth');
Route::post('/active/{active}', [CategoryController::class, 'active'])->middleware('auth');


// Post
Route::get('/posts', [PostController::class, 'index'])->middleware('auth');
Route::get('/post-create', [PostController::class, 'create'])->middleware('auth');
Route::post('/create-post', [PostController::class, 'store'])->middleware('auth');
Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware('auth');
Route::get('/post-update/{post}', [PostController::class, 'update_post'])->middleware('auth');
Route::put('/update_post/{post}', [PostController::class, 'update'])->middleware('auth');
Route::get('/post-search', [PostController::class, 'search'])->middleware('auth');
Route::get('/findCategory/{category}', [PostController::class, 'getPostsByCategory'])->name('posts.by.category');


// Index Page
Route::get('/', [IndexController::class, 'index']);
Route::get('/batafsil/{post}', [IndexController::class, 'batafsil']);
Route::get('/post-search-index', [IndexController::class, 'search']);

Route::get('/poll_Index', [IndexController::class, 'poll_index']);



// Login and Register


Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);

// Comments

Route::post('/createComment', [CommentController::class, 'createComment']);


// Likes
Route::post('/like', [LikeOrDislikeController::class, 'like'])->middleware('auth');
Route::post('/dislike', [LikeOrDislikeController::class, 'dislike'])->middleware('auth');


// Poll

Route::get('/poll', [PollController::class, 'index'])->middleware('auth');
Route::get('/poll-create', [PollController::class, 'create'])->middleware('auth');
Route::post('/create-poll', [PollController::class, 'store'])->middleware('auth');
Route::delete('/poll/{poll}', [PollController::class, 'delete'])->middleware('auth');
Route::get('/poll-update/{poll}', [PollController::class, 'update_poll'])->middleware('auth');
Route::put('/update_poll/{poll}', [PollController::class, 'update'])->middleware('auth');
Route::get('/poll-search', [PollController::class, 'search'])->middleware('auth');
Route::post('/active_poll/{active}', [PollController::class, 'active'])->middleware('auth');

// Choice
Route::get('/choice-create/{poll}', [ChoiceController::class, 'create'])->middleware('auth');
Route::post('/create-choice', [ChoiceController::class, 'store'])->middleware('auth');

Route::post('/answer', [ChoiceController::class, 'answer'])->middleware('auth');
Route::post('/deleteAnswer', [ChoiceController::class, 'deleteAnswer'])->middleware('auth');

