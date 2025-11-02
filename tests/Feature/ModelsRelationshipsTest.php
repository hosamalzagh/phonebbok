<?php

use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;

it('a teacher has many groups and a group belongs to a teacher', function (): void {
    $teacher = Teacher::factory()->create();

    $groupA = Group::query()->create([
        'name' => 'Group A',
        'description' => 'Test group A',
        'capacity' => 30,
        'level' => 'الصف الأول الابتدائي',
        'section' => 'أ',
        'is_active' => true,
        'teacher_id' => $teacher->id,
    ]);

    $groupB = Group::query()->create([
        'name' => 'Group B',
        'description' => 'Test group B',
        'capacity' => 25,
        'level' => 'الصف الثاني الابتدائي',
        'section' => 'ب',
        'is_active' => true,
        'teacher_id' => $teacher->id,
    ]);

    expect($teacher->groups)->toHaveCount(2);
    expect($groupA->teacher->is($teacher))->toBeTrue();
    expect($groupB->teacher->is($teacher))->toBeTrue();
});

it('a group has many students and a student belongs to a group', function (): void {
    $group = Group::query()->create([
        'name' => 'Group Students',
        'description' => 'Students group',
        'capacity' => 20,
        'level' => 'الصف الأول الإعدادي',
        'section' => 'ج',
        'is_active' => true,
    ]);

    $s1 = Student::factory()->create(['group_id' => $group->id]);
    $s2 = Student::factory()->create(['group_id' => $group->id]);

    expect($group->students)->toHaveCount(2);
    expect($s1->group->is($group))->toBeTrue();
    expect($s2->group->is($group))->toBeTrue();
});
