<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CursoController;

Route::get('/cursos', [CursoController::class, 'index']);

