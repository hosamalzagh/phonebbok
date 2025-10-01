<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Home route (used for logout redirect and entry point)
Route::get('/', function () {
    return redirect()->route('student.index');
})->name('home');

// Protected application routesß
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Teachers
    Route::get('teacher', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('teacher/{teacher}', [TeacherController::class, 'show'])->name('teacher.show');
    Route::get('teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('teacher/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('teacher/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.destroy');


        Route::get('t' ,function(){
        $teacher = Teacher::with(['groups' ,'attendances'])->find(5);
        $groups = \App\Models\Group::get();
        dd($teacher->groups->implode('name', ', ') ,
            $teacher->groups->count() ,
            $groups->implode('level',' '),
            $groups->implode('name',' '),
            $groups->count(),
            $teacher
        );
    });

        Route::get('ty/{id}',[TeacherController::class, 'ty']);

    // Students
    Route::get('student', [StudentController::class, 'index'])->name('student.index');
    Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('student', [StudentController::class, 'store'])->name('student.store');
    Route::get('student/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::get('student/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('student/{student}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
    Route::get('student/{student}/paid', [StudentController::class, 'paid'])->name('student.paid');
    Route::post('student/{student}/paid', [StudentController::class, 'storePaid'])->name('student.storePaid');

    // Groups
    Route::get('group', [GroupController::class, 'index'])->name('group.index');
    Route::get('group/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('group', [GroupController::class, 'store'])->name('group.store');
    Route::get('group/{group}', [GroupController::class, 'show'])->name('group.show');
    Route::get('group/{group}/edit', [GroupController::class, 'edit'])->name('group.edit');
    Route::put('group/{group}', [GroupController::class, 'update'])->name('group.update');
    Route::delete('group/{group}', [GroupController::class, 'destroy'])->name('group.destroy');

    // Attendance
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('attendance', [AttendanceController::class, 'store'])->name('attendance.store');

    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
