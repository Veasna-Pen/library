<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Author;
use App\Http\Livewire\Publisher;
use Illuminate\Support\Facades\Route;


Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/author', Author::class)->name('author');
Route::get('/publisher', Publisher::class)->name('publisher');