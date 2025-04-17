<?php

use App\Http\Controllers\BackendController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return "El backend funciona";
});

Route::get('/backend', [BackendController::class, "findAll"]);

Route::get('/backend/{id?}', [BackendController::class, "get"]);

Route::post('/backend', [BackendController::class, "create"]);

Route::put('/backend/{id}', [BackendController::class, "update"]);

Route::delete('/backend/{id}', [BackendController::class, "delete"]);


// Optional: /backend/{id?}