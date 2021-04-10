<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OSController;
use App\Http\Livewire\OssIndex;

Route::group(['middleware' => 'auth'], function(){
    
    Route::get('/', OssIndex::class)->name('livewire');
    Route::resource('oss', OSController::class)->names('oss');
    Route::view('all', 'painel.all')->name('all');
    Route::view('relatorios', 'painel.relatorios')->name('relatorios');
    Route::view('tarefas', 'painel.tarefas')->name('tarefas');
    Route::view('datetime', 'painel.datetime')->name('datetime');
    
});

Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>Reoptimized class loader</h1>';
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});