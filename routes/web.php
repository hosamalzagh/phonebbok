<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('teacher', [TeacherController::class, 'index'])->name('teacher.index');
Route::get('teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
Route::post('teacher', [TeacherController::class, 'store'])->name('teacher.store');
Route::get('teacher/{teacher}', [TeacherController::class, 'show'])->name('teacher.show');
Route::get('teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
Route::put('teacher/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
Route::delete('teacher/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

Route::get('student', [StudentController::class ,'index' ])->name('student.index');
Route::get('student/create', [StudentController::class ,'create' ])->name('student.create');
Route::post('student', [StudentController::class ,'store' ])->name('student.store');
Route::get('student/{student}', [StudentController::class ,'show' ])->name('student.show');
Route::get('student/{student}/edit', [StudentController::class ,'edit' ])->name('student.edit');
Route::put('student/{student}', [StudentController::class ,'update' ])->name('student.update');
Route::delete('student/{student}', [StudentController::class ,'destroy' ])->name('student.destroy');

Route::get('group', [GroupController::class, 'index'])->name('group.index');
Route::get('group/create', [GroupController::class, 'create'])->name('group.create');
Route::post('group', [GroupController::class, 'store'])->name('group.store');
Route::get('group/{group}', [GroupController::class, 'show'])->name('group.show');
Route::get('group/{group}/edit', [GroupController::class, 'edit'])->name('group.edit');
Route::put('group/{group}', [GroupController::class, 'update'])->name('group.update');
Route::delete('group/{group}', [GroupController::class, 'destroy'])->name('group.destroy');

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
