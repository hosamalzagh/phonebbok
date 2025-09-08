@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8" dir="rtl">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">إضافة طالب جديد</h1>
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
                        <span class="text-gray-500">إضافة طالب</span>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="mr-3">
                        <h3 class="text-sm font-medium text-red-800">يرجى تصحيح الأخطاء التالية:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white shadow-lg rounded-lg">
            <form method="post" action="{{route('student.store')}}" class="p-6 space-y-6">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                    <input type="text" name="name" id="name"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-500 @enderror"
                           value="{{ old('name') }}" placeholder="أدخل اسم الطالب">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mobile Field -->
                <div>
                    <label for="mobile" class="block text-sm font-medium text-gray-700 mb-1">رقم الجوال</label>
                    <input type="text" name="mobile" id="mobile"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('mobile') border-red-500 @enderror"
                           value="{{ old('mobile') }}" placeholder="أدخل رقم الجوال">
                    @error('mobile')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">الجنس</label>
                    <div class="flex space-x-reverse space-x-6">
                        <div class="flex items-center">
                            <input type="radio" name="gender" value="male" id="male"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                   @checked(old('gender') == 'male')>
                            <label for="male" class="mr-2 text-sm text-gray-700">ذكر</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" name="gender" value="female" id="female"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                   @checked(old('gender') == 'female')>
                            <label for="female" class="mr-2 text-sm text-gray-700">أنثى</label>
                        </div>
                    </div>
                    @error('gender')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Age Field -->
                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700 mb-1">العمر</label>
                    <input type="number" name="age" id="age"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('age') border-red-500 @enderror"
                           value="{{ old('age') }}" placeholder="أدخل عمر الطالب" min="1" max="100">
                    @error('age')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-reverse space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('student.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        إلغاء
                    </a>
                    <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        حفظ الطالب
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
