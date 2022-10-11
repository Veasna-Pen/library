<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Author;
use App\Http\Livewire\Publisher;
use App\Http\Livewire\Category;
use App\Http\Livewire\Student;
use App\Http\Livewire\Book;

use Illuminate\Support\Facades\Route;


Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/author', Author::class)->name('author');
Route::get('/publisher', Publisher::class)->name('publisher');
Route::get('/category', Category::class)->name('category');
Route::get('/student', Student::class)->name('student');
Route::get('/book', Book::class)->name('book');