@props(['current' => 'student'])

<div class="mb-6">
    <nav class="flex space-x-reverse space-x-4">
        <!-- Students Button -->
        <a href="{{ route('student.index') }}"
           class="px-4 py-2 text-sm font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors {{ $current === 'student' ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50' }}">
            <svg class="inline h-4 w-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
            الطلاب
        </a>

        <!-- Teachers Button -->
        <a href="{{ route('teacher.index') }}"
           class="px-4 py-2 text-sm font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors {{ $current === 'teacher' ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50' }}">
            <svg class="inline h-4 w-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
            </svg>
            المعلمين
        </a>

        <!-- Groups Button -->
        <a href="{{ route('group.index') }}"
           class="px-4 py-2 text-sm font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors {{ $current === 'group' ? 'text-white bg-green-600 hover:bg-green-700' : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-50' }}">
            <svg class="inline h-4 w-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                <path d="M6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
            </svg>
            المجموعات
        </a>
    </nav>
</div>
