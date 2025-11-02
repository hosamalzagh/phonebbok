<?php

use App\Models\User;

it('redirects guests to login when accessing protected pages', function () {
    // Student index
    $this->get(route('student.index'))
        ->assertRedirect(route('login'));

    // Teacher index
    $this->get(route('teacher.index'))
        ->assertRedirect(route('login'));

    // Groups index
    $this->get(route('group.index'))
        ->assertRedirect(route('login'));

    // Attendance index
    $this->get(route('attendance.index'))
        ->assertRedirect(route('login'));
});

it('allows authenticated users to access protected pages', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('student.index'))
        ->assertSuccessful();
});
