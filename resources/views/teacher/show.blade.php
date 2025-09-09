@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8" dir="rtl">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">بيانات المعلم</h1>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-reverse space-x-4">
                        <li>
                            <a href="{{ route('teacher.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                                قائمة المعلمين
                            </a>
                        </li>
                        <li class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-500">{{ $teacher->name }}</span>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Teacher Information Card -->
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
                            <h2 class="text-2xl font-bold text-white">{{ $teacher->name }}</h2>
                            <p class="text-blue-100">معلم {{ $teacher->subject }}</p>
                        </div>
                    </div>
                </div>

                <!-- Teacher Details -->
                <div class="px-6 py-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">الاسم</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $teacher->name }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">البريد الإلكتروني</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $teacher->email }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">رقم الجوال</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $teacher->mobile }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">العمر</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $teacher->age }} سنة</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">الجنس</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                {{ $teacher->gender == 'male' ? 'ذكر' : 'أنثى' }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">المادة التدريسية</dt>
                            <dd class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $teacher->subject }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">الراتب</dt>
                            <dd class="text-sm text-gray-900 bg-green-50
