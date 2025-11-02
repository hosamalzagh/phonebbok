@php($title = 'Home')
@extends('layout.app')


@section('content')

    <div class="min-h-screen bg-gray-50 py-8" dir="rtl">
        <ul>
        @foreach ($teachers as $teacher)
            <li class="bg-white rounded-lg shadow-md p-4 mb-4">
                <a href="{{ route('admin.show', $teacher) }}" class="flex items-center">
                <h2 class="text-xl font-semibold mb-2">{{ $teacher->name }}</h2>
                </a>
                <p class="text-gray-600">{{ $teacher->id }}</p>
            </li>
        @endforeach
    </ul>


@endsection
