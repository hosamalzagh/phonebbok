<?php

declare(strict_types=1);

use App\Models\Attendance;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores attendance for a group and date', function (): void {
    $group = Group::query()->create([
        'name' => 'Group Z',
        'description' => 'Desc',
        'capacity' => 30,
        'level' => null,
        'section' => null,
        'is_active' => true,
    ]);

    $students = Student::factory()->count(2)->create(['group_id' => $group->id]);

    $payload = [
        'group_id' => $group->id,
        'date' => '2025-09-15',
        'entries' => [
            $students[0]->id => ['status' => 'present', 'notes' => ''],
            $students[1]->id => ['status' => 'absent', 'notes' => 'sick'],
        ],
    ];

    $response = $this->post(route('attendance.store'), $payload);

    $response->assertRedirect(route('attendance.index', ['group_id' => $group->id, 'date' => '2025-09-15']));

    $this->assertDatabaseHas('attendances', [
        'student_id' => $students[0]->id,
        'group_id' => $group->id,
        'date' => '2025-09-15 00:00:00',
        'status' => 'present',
    ]);

    $this->assertDatabaseHas('attendances', [
        'student_id' => $students[1]->id,
        'group_id' => $group->id,
        'date' => '2025-09-15 00:00:00',
        'status' => 'absent',
        'notes' => 'sick',
    ]);

    // Relation checks
    expect($students[0]->refresh()->attendances()->count())->toBe(1);
    expect($students[1]->refresh()->attendances()->first())->toBeInstanceOf(Attendance::class);
});

it('ignores entries for students not in the selected group', function (): void {
    $groupA = Group::query()->create([
        'name' => 'A', 'description' => null, 'capacity' => 30, 'level' => null, 'section' => null, 'is_active' => true,
    ]);
    $groupB = Group::query()->create([
        'name' => 'B', 'description' => null, 'capacity' => 30, 'level' => null, 'section' => null, 'is_active' => true,
    ]);

    $studentA = Student::factory()->create(['group_id' => $groupA->id]);
    $studentB = Student::factory()->create(['group_id' => $groupB->id]);

    $response = $this->post(route('attendance.store'), [
        'group_id' => $groupA->id,
        'date' => '2025-09-15',
        'entries' => [
            $studentA->id => ['status' => 'present'],
            $studentB->id => ['status' => 'present'], // should be ignored
        ],
    ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('attendances', [
        'student_id' => $studentA->id,
        'group_id' => $groupA->id,
        'date' => '2025-09-15 00:00:00',
    ]);

    $this->assertDatabaseMissing('attendances', [
        'student_id' => $studentB->id,
        'group_id' => $groupA->id,
        'date' => '2025-09-15 00:00:00',
    ]);
});

it('shows students in index when group and date are provided', function (): void {
    $group = Group::query()->create([
        'name' => 'Group View', 'description' => null, 'capacity' => 30, 'level' => null, 'section' => null, 'is_active' => true,
    ]);

    $student = Student::factory()->create(['group_id' => $group->id, 'name' => 'Mohammed']);

    $response = $this->get(route('attendance.index', ['group_id' => $group->id, 'date' => '2025-09-15']));

    $response->assertSuccessful();
    $response->assertSee('Mohammed');
});
