<?php

use App\Models\Group;
use App\Models\Student;

it('stores a student with selected group', function (): void {
    $group = Group::query()->create([
        'name' => 'Group X',
        'description' => 'Desc',
        'capacity' => 30,
        'level' => null,
        'section' => null,
        'is_active' => true,
    ]);

    $response = $this->post(route('student.store'), [
        'name' => 'Ali',
        'mobile' => '0500000000',
        'age' => 15,
        'gender' => 'male',
        'group_id' => $group->id,
    ]);

    $response->assertRedirect(route('student.index'));

    $student = Student::query()->where('name', 'Ali')->first();

    expect($student)->not->toBeNull();
    expect($student->group_id)->toEqual($group->id);
    expect($student->group->is($group))->toBeTrue();
});

it('updates a student group', function (): void {
    $groupA = Group::query()->create([
        'name' => 'Group A',
        'description' => 'A',
        'capacity' => 25,
        'level' => null,
        'section' => null,
        'is_active' => true,
    ]);

    $groupB = Group::query()->create([
        'name' => 'Group B',
        'description' => 'B',
        'capacity' => 25,
        'level' => null,
        'section' => null,
        'is_active' => true,
    ]);

    $student = Student::factory()->create(['group_id' => $groupA->id]);

    $response = $this->put(route('student.update', $student), [
        'name' => $student->name,
        'mobile' => $student->mobile,
        'age' => $student->age,
        'gender' => $student->gender,
        'group_id' => $groupB->id,
    ]);

    $response->assertRedirect(route('student.index'));

    expect($student->refresh()->group_id)->toEqual($groupB->id);
});
