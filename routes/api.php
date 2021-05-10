<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\V1\PostController as PostController;
use App\Http\Controllers\Api\V2\PostController as PostControllerV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'login']);

//V1
Route::apiResource('v1/posts', PostController::class)
        ->only(['index', 'show', 'destroy'])
        ->middleware('auth:sanctum');

//V2
Route::apiResource('v2/posts', PostControllerV2::class)->middleware('auth:sanctum');