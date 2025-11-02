<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdatestudentRequest;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(10);

        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::select('id', 'name')->get();

        return view('student.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorestudentRequest $request)
    {
        $student = Student::create($request->validated());
        $student->save();

        return redirect()->route('student.index')->with('success', 'تم إضافة الطالب بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load('group', 'paids');

        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $groups = Group::select('id', 'name')->orderBy('name')->get();

        return view('student.edit', compact('student', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatestudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return redirect()->route('student.index')->with('success', 'تم تحديث بيانات الطالب بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
    }

    public function paid(Student $student)
    {
        return view('student.paid', compact('student'));

    }

    public function storePaid(Student $student, Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'month' => ['required', 'in:8,9,10,11,12,1,2,3,4,5,6,7'],
        ]);

        $student->paids()->create($data);

        return redirect()
            ->route('student.index')
            ->with('success', 'تم تسجيل الدفعة بنجاح');
    }
}
