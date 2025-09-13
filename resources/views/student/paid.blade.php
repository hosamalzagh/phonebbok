@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8" dir="rtl">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">تسجيل دفعة للطالب</h1>
        </div>

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
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg">
            <form action="{{ route('student.storePaid', $student) }}" method="post" class="p-6 space-y-6">
                @csrf

                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">المبلغ المدفوع</label>
                    <input
                        type="number"
                        name="amount"
                        id="amount"
                        step="0.01"
                        min="0"
                        value="{{ old('amount') }}"
                        placeholder="0.00"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('amount') border-red-500 @enderror"
                    >
                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="month" class="block text-sm font-medium text-gray-700 mb-1">الشهر</label>
                    <select
                        id="month"
                        name="month"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('month') border-red-500 @enderror"
                    >
                        @php($months = [8=>'أغسطس',9=>'سبتمبر',10=>'أكتوبر',11=>'نوفمبر',12=>'ديسمبر',1=>'يناير',2=>'فبراير',3=>'مارس',4=>'أبريل',5=>'مايو',6=>'يونيو',7=>'يوليو'])
                        @foreach($months as $value => $label)
                            <option value="{{ $value }}" @selected(old('month') == $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('month')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-reverse space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('student.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        إلغاء
                    </a>
                    <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        حفظ الدفعة
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
