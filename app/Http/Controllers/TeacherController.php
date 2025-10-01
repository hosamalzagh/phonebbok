<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreteacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreteacherRequest $request)
    {
        $teacher = Teacher::create($request->validated());
        $teacher->save();

        return redirect()->route('teacher.index')->with('success', 'تم إضافة المعلم بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        $teacher->save();
        return redirect()->route('teacher.index')->with('success', 'تم تحديث بيانات المعلم بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teacher.index')->with('success', 'تم حذف المعلم بنجاح!');
    }

    public function ty($id)
    {
        $group = Group::find($id);
        dd($group->name);
    }
}
