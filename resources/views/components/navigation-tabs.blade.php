@props(['current' => 'student'])

<div class="mb-6">
    <nav class="flex space-x-reverse space-x-4">
        <a href="{{ route('student.index') }}"
           class="px-4 py-2 text-sm font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors {{ $current === 'student' ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50' }}">
            <svg class="inline h-4 w-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
            الطلاب
        </a>
        <a href="{{ route('teacher.index') }}"
           class="px-4 py-2 text-sm font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors {{ $current === 'teacher' ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50' }}">
            <svg class="inline h-4 w-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
            </svg>
            المعلمين
        </a>
    </nav>
</div>
