@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8" dir="rtl">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">بيانات المجموعة</h1>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-reverse space-x-4">
                        <li>
                            <a href="{{ route('group.index') }}" class="text-green-600 hover:text-green-800 transition-colors">
                                قائمة المجموعات
                            </a>
                        </li>
                        <li class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-500">{{ $group->name }}</span>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Group Information Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Header with avatar -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-8">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-20 w-20 rounded-full bg-white flex items-center justify-center">
                                <svg class="h-12 w-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                    <path d="M6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mr-6">
                            <h2 class="text-2xl font-bold text-white">{{ $group->name }}</h2>
                            <p class="text-green-100">
                                @if($group->level && $group->section)
                                    {{ $group->level }} - شعبة {{ $group->section }}
                                @elseif($group->level)
                                    {{ $group->level }}
                                @else
                                    مجموعة دراسية
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Group Details -->
                <div class="px-6 py-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">اسم المجموعة</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $group->name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">السعة</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $group->capacity }} طالب</dd>
                        </div>

                        @if($group->level)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">المستوى</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $group->level }}</dd>
                        </div>
                        @endif

                        @if($group->section)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">الشعبة</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $group->section }}</dd>
                        </div>
                        @endif

                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">حالة المجموعة</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $group->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $group->is_active ? 'نشطة' : 'غير نشطة' }}
                                </span>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">تاريخ الإنشاء</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $group->created_at->format('Y/m/d H:i') }}</dd>
                        </div>

                        @if($group->description)
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500 mb-1">الوصف</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $group->description }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-end space-x-reverse space-x-3">
                        <a href="{{ route('group.index') }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            <svg class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                            </svg>
                            العودة للقائمة
                        </a>
                        
                        <a href="{{ route('group.edit', $group) }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            <svg class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            تعديل البيانات
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
