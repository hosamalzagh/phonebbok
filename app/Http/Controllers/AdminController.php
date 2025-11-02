<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.index',compact('teachers'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Teacher $teacher)
    {
        return  view('admin.show',compact('teacher'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
