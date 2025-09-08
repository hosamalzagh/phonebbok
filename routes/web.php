<?php

use App\Http\Controllers\StudentController as StudentControllerAlias;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('student', [StudentControllerAlias::class ,'index' ])->name('student.index');
Route::get('student/create', [StudentControllerAlias::class ,'create' ])->name('student.create');
Route::post('student', [StudentControllerAlias::class ,'store' ])->name('student.store');
Route::get('student/{student}', [StudentControllerAlias::class ,'show' ])->name('student.show');
Route::get('student/{student}/edit', [StudentControllerAlias::class ,'edit' ])->name('student.edit');
Route::put('student/{student}', [StudentControllerAlias::class ,'update' ])->name('student.update');
Route::delete('student/{student}', [StudentControllerAlias::class ,'destroy' ])->name('student.destroy');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
