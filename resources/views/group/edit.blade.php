@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8" dir="rtl">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">تعديل بيانات المجموعة</h1>
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
                            <span class="text-gray-500">تعديل بيانات {{ $group->name }}</span>
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
                <form method="post" action="{{route('group.update',$group)}}" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">اسم المجموعة</label>
                        <input type="text" name="name" id="name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('name') border-red-500 @enderror"
                               value="{{ old('name', $group->name) }}" placeholder="أدخل اسم المجموعة">
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">الوصف</label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('description') border-red-500 @enderror"
                                  placeholder="أدخل وصف المجموعة (اختياري)">{{ old('description', $group->description) }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Capacity Field -->
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">السعة</label>
                        <input type="number" name="capacity" id="capacity"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('capacity') border-red-500 @enderror"
                               value="{{ old('capacity', $group->capacity) }}" placeholder="أدخل سعة المجموعة" min="1" max="100">
                        @error('capacity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Level Field -->
                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-700 mb-1">المستوى</label>
                        <select name="level" id="level"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('level') border-red-500 @enderror">
                            <option value="">اختر المستوى (اختياري)</option>
                            <option value="الصف الأول الابتدائي" @selected(old('level', $group->level) == 'الصف الأول الابتدائي')>الصف الأول الابتدائي</option>
                            <option value="الصف الثاني الابتدائي" @selected(old('level', $group->level) == 'الصف الثاني الابتدائي')>الصف الثاني الابتدائي</option>
                            <option value="الصف الثالث الابتدائي" @selected(old('level', $group->level) == 'الصف الثالث الابتدائي')>الصف الثالث الابتدائي</option>
                            <option value="الصف الرابع الابتدائي" @selected(old('level', $group->level) == 'الصف الرابع الابتدائي')>الصف الرابع الابتدائي</option>
                            <option value="الصف الخامس الابتدائي" @selected(old('level', $group->level) == 'الصف الخامس الابتدائي')>الصف الخامس الابتدائي</option>
                            <option value="الصف السادس الابتدائي" @selected(old('level', $group->level) == 'الصف السادس الابتدائي')>الصف السادس الابتدائي</option>
                            <option value="الصف الأول الإعدادي" @selected(old('level', $group->level) == 'الصف الأول الإعدادي')>الصف الأول الإعدادي</option>
                            <option value="الصف الثاني الإعدادي" @selected(old('level', $group->level) == 'الصف الثاني الإعدادي')>الصف الثاني الإعدادي</option>
                            <option value="الصف الثالث الإعدادي" @selected(old('level', $group->level) == 'الصف الثالث الإعدادي')>الصف الثالث الإعدادي</option>
                            <option value="الصف الأول الثانوي" @selected(old('level', $group->level) == 'الصف الأول الثانوي')>الصف الأول الثانوي</option>
                            <option value="الصف الثاني الثانوي" @selected(old('level', $group->level) == 'الصف الثاني الثانوي')>الصف الثاني الثانوي</option>
                            <option value="الصف الثالث الثانوي" @selected(old('level', $group->level) == 'الصف الثالث الثانوي')>الصف الثالث الثانوي</option>
                        </select>
                        @error('level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Section Field -->
                    <div>
                        <label for="section" class="block text-sm font-medium text-gray-700 mb-1">الشعبة</label>
                        <input type="text" name="section" id="section"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('section') border-red-500 @enderror"
                               value="{{ old('section', $group->section) }}" placeholder="أدخل الشعبة (مثل: أ، ب، ج - اختياري)">
                        @error('section')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                               @checked(old('is_active', $group->is_active))>
                        <label for="is_active" class="mr-2 block text-sm text-gray-900">
                            المجموعة نشطة
                        </label>
                    </div>
                    @error('is_active')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Buttons -->
                    <div class="flex items-center justify-end space-x-reverse space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('group.show', $group) }}"
                           class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            إلغاء
                        </a>
                        <button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
