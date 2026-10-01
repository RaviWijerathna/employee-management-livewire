<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Employees\Index::class)->name('employees.index');
Route::get('/employees/create', App\Livewire\Employees\Create::class)->name('employees.create');
Route::get('/employees/{employee}/edit', App\Livewire\Employees\Edit::class)->name('employees.edit');