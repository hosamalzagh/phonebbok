<?php

declare(strict_types=1);

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores a student payment with month', function (): void {
    $student = Student::factory()->create();

    $response = $this->post(route('student.storePaid', $student), [
        'amount' => 123.45,
        'month' => 9,
    ]);

    $response->assertRedirect(route('student.index'));

    $this->assertDatabaseHas('student_paids', [
        'student_id' => $student->id,
        'amount' => 123.45,
        'month' => 9,
    ]);
});

it('validates amount and month when storing payment', function (): void {
    $student = Student::factory()->create();

    $response = $this->from(route('student.paid', $student))
        ->post(route('student.storePaid', $student), [
            'amount' => null,
            'month' => 13,
        ]);

    $response->assertSessionHasErrors(['amount', 'month']);
});
