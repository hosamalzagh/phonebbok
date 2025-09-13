@extends('layout.app')
@section('content')
<div class="min-h-screen bg-gray-50 py-8" dir="rtl">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">بيانات الطالب</h1>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-reverse space-x-4">
                    <li>
                        <a href="{{ route('student.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                            قائمة الطلاب
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500">{{ $student->name }}</span>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Student Information Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header with avatar -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-8">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-20 w-20 rounded-full bg-white flex items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mr-6">
                        <h2 class="text-2xl font-bold text-white">{{ $student->name }}</h2>
                        <p class="text-blue-100">معلومات الطالب</p>
                    </div>
                </div>
            </div>

            <!-- Student Details -->
            <div class="px-6 py-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 mb-1">الصف</dt>
                        <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                            {{ $student->group->level }}
                        </dd>
                    </div>
                    <div class="">
                        <dt class="text-sm font-medium text-gray-500 mb-1">اسم المجموعة</dt>
                        <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                            {{ $student->group->name }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-1">الاسم</dt>
                        <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $student->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-1">رقم الجوال</dt>
                        <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $student->mobile }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-1">العمر</dt>
                        <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $student->age }} سنة</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-1">الجنس</dt>
                        <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                            {{ $student->gender == 'male' ? 'ذكر' : 'أنثى' }}
                        </dd>
                    </div>

                    <div class="">
                        <dt class="text-sm font-medium text-gray-500 mb-1">تاريخ التسجيل</dt>
                        <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                            {{ $student->created_at->format('Y/m/d - H:i') }}
                        </dd>
                    </div>
                </dl>
            </div>
            <!-- Payments Section -->
            <div class="px-6 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">المدفوعات</h3>

                @php
                    $payments = $student->paids->sortByDesc('created_at');
                    $totalPaid = $payments->sum('amount');
                @endphp

                @if($payments->isEmpty())
                    <div class="bg-gray-50 text-gray-600 text-sm px-4 py-3 rounded-md">
                        لا توجد مدفوعات حتى الآن.
                    </div>
                @else
                    <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 text-gray-600">
                                <tr>
                                    <th class="px-4 py-2 text-right font-medium">#</th>
                                    <th class="px-4 py-2 text-right font-medium">الشهر</th>
                                    <th class="px-4 py-2 text-right font-medium">المبلغ</th>
                                    <th class="px-4 py-2 text-right font-medium">التاريخ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($payments as $index => $paid)
                                    <tr>
                                        <td class="px-4 py-2 text-gray-900">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 text-gray-900">
                                            {{ $paid->month }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-900">
                                            {{ number_format($paid->amount) }}
                                        </td>
                                        <td class="px-4 py-2 text-gray-500">
                                            {{ $paid->created_at->format('Y/m/d - H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="2" class="px-4 py-2 text-right font-medium text-gray-700">إجمالي المدفوع</td>
                                    <td class="px-4 py-2 font-bold text-gray-900">{{ number_format($totalPaid) }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-4">
                        <div class="bg-green-50 border border-green-200 rounded-md p-3">
                            <div class="text-xs text-green-700">المدفوع</div>
                            <div class="text-lg font-bold text-green-900">{{ number_format($totalPaid) }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="bg-gray-50 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex space-x-reverse space-x-3">
                        <a href="{{ route('student.edit', $student) }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            تعديل البيانات
                        </a>

                        <form method="post" action="{{ route('student.destroy', $student) }}" class="inline-block"
                              onsubmit="return confirm('هل أنت متأكد من حذف بيانات هذا الطالب؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <svg class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                حذف الطالب
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('student.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        العودة للقائمة
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
