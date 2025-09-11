<?php

use App\Models\Group;
use App\Models\Teacher;

it('stores a group with selected teacher', function (): void {
    $teacher = Teacher::factory()->create();

    $response = $this->post(route('group.store'), [
        'name' => 'Math Group',
        'description' => 'For math lovers',
        'capacity' => 30,
        'level' => null,
        'section' => null,
        'is_active' => true,
        'teacher_id' => $teacher->id,
    ]);

    $response->assertRedirect(route('group.index'));

    $group = Group::query()->where('name', 'Math Group')->first();

    expect($group)->not->toBeNull();
    expect($group->teacher_id)->toEqual($teacher->id);
    expect($group->teacher->is($teacher))->toBeTrue();
});

it('updates a group teacher', function (): void {
    $teacherA = Teacher::factory()->create();
    $teacherB = Teacher::factory()->create();

    $group = Group::query()->create([
        'name' => 'Science Group',
        'description' => 'Science club',
        'capacity' => 20,
        'level' => null,
        'section' => null,
        'is_active' => true,
        'teacher_id' => $teacherA->id,
    ]);

    $response = $this->put(route('group.update', $group), [
        'name' => $group->name,
        'description' => $group->description,
        'capacity' => $group->capacity,
        'level' => $group->level,
        'section' => $group->section,
        'is_active' => $group->is_active,
        'teacher_id' => $teacherB->id,
    ]);

    $response->assertRedirect(route('group.index'));

    expect($group->refresh()->teacher_id)->toEqual($teacherB->id);
});
