<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PlanController;


Route::post('auth/register', [ApiTokenController::class, 'register']);

Route::post('auth/login', [ApiTokenController::class, 'login']);

Route::middleware('auth:sanctum')->post('auth/logout', [ApiTokenController::class, 'logout']);

Route::middleware('auth:sanctum')->post('auth/me', [ApiTokenController::class, 'me']);

Route::get('posts', [PostController::class, 'showAllPosts']);

Route::get('posts/{id}', [PostController::class, 'showPost']);


Route::post('contact', [ContactController::class, 'sendContactForm']);


Route::get('plans', [PlanController::class, 'showAllPlans']);

Route::middleware('auth:sanctum')->post('subscriptions', [PlanController::class, 'subscribePlan']);
