<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Models\Attendance;
use App\Models\Group;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $groups = Group::select('id', 'name')->orderBy('name')->get();

        $groupId = (int) $request->input('group_id', 0);
        $date = $request->input('date', Carbon::today()->toDateString());

        $students = collect();
        $existing = collect();
        $group = null;

        if ($groupId > 0) {
            $group = Group::with('students')->find($groupId);
            if ($group !== null) {
                $students = $group->students()->orderBy('name')->get();
                $existing = Attendance::whereDate('date', $date)
                    ->where('group_id', $groupId)
                    ->get()
                    ->keyBy('student_id');
            }
        }

        return view('attendance.index', compact('groups', 'group', 'groupId', 'date', 'students', 'existing'));
    }

    public function store(StoreAttendanceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $group = Group::with('teacher')->findOrFail($data['group_id']);

        // Ensure only students of this group are processed
        $studentIds = Student::where('group_id', $group->id)->pluck('id')->all();

        foreach ($data['entries'] as $studentId => $entry) {
            if (! in_array((int) $studentId, $studentIds, true)) {
                continue;
            }

            Attendance::updateOrCreate(
                [
                    'student_id' => (int) $studentId,
                    'date' => $data['date'],
                ],
                [
                    'group_id' => $group->id,
                    'teacher_id' => $group->teacher_id ?? null,
                    'status' => $entry['status'] ?? 'present',
                    'notes' => $entry['notes'] ?? null,
                ]
            );
        }

        return redirect()
            ->route('attendance.index', ['group_id' => $group->id, 'date' => $data['date']])
            ->with('success', 'تم حفظ الحضور بنجاح');
    }
}
