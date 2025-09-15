@extends('layout.app')
@section('content')
<div class="min-h-screen bg-gray-50 py-8" dir="rtl">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">الحضور والغياب</h1>
            <p class="text-gray-600">قم باختيار المجموعة والتاريخ لتسجيل حضور الطلاب.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-md bg-green-50 p-4 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <form method="get" action="{{ route('attendance.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">المجموعة</label>
                    <select name="group_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">اختر مجموعة</option>
                        @foreach($groups as $g)
                            <option value="{{ $g->id }}" @selected($groupId == $g->id)>{{ $g->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">التاريخ</label>
                    <input type="date" name="date" value="{{ $date }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                </div>
                <div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">عرض</button>
                </div>
            </form>
        </div>

        @if($group && $students->isNotEmpty())
            <form method="post" action="{{ route('attendance.store') }}" class="bg-white shadow rounded-lg">
                @csrf
                <input type="hidden" name="group_id" value="{{ $group->id }}" />
                <input type="hidden" name="date" value="{{ $date }}" />

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">اسم الطالب</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($students as $i => $s)
                            @php
                                $row = $existing->get($s->id);
                                $status = $row->status ?? 'present';
                                $notes = $row->notes ?? '';
                            @endphp
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $s->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    <div class="flex items-center gap-4">
                                        <label class="inline-flex items-center gap-1">
                                            <input type="radio" name="entries[{{ $s->id }}][status]" value="present" @checked($status==='present') class="text-green-600 border-gray-300 focus:ring-green-500" />
                                            <span>حاضر</span>
                                        </label>
                                        <label class="inline-flex items-center gap-1">
                                            <input type="radio" name="entries[{{ $s->id }}][status]" value="absent" @checked($status==='absent') class="text-red-600 border-gray-300 focus:ring-red-500" />
                                            <span>غائب</span>
                                        </label>
                                        <label class="inline-flex items-center gap-1">
                                            <input type="radio" name="entries[{{ $s->id }}][status]" value="late" @checked($status==='late') class="text-yellow-600 border-gray-300 focus:ring-yellow-500" />
                                            <span>متأخر</span>
                                        </label>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    <input type="text" name="entries[{{ $s->id }}][notes]" value="{{ $notes }}" placeholder="اختياري" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gray-50 flex items-center justify-between">
                    <div class="text-sm text-gray-600">عدد الطلاب: {{ $students->count() }}</div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700">حفظ الحضور</button>
                </div>
            </form>
        @elseif($group && $students->isEmpty())
            <div class="bg-yellow-50 text-yellow-800 border border-yellow-200 rounded-md p-4">لا يوجد طلاب في هذه المجموعة.</div>
        @endif
    </div>
</div>
@endsection
