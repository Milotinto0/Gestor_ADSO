<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AprendizController;
Route::redirect('/', '/aprendices');
Route::resource('aprendices', AprendizController::class);