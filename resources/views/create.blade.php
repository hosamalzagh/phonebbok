@extends('layout.app')
@if($errors->any())
    <ul class="bg-red-300 p-4" dir="rtl">
        @foreach($errors->all() as $error)
            <li class="text-amber-950">{{$error}}</li>
        @endforeach
    </ul>
@endif

<form method="post" action="{{route('student.store')}}" class="bg-gray-100 p-4" dir="rtl">
    @csrf
    <div class="mb-4">
        <label for="name">الاسم</label>
        <input type="text" name="name" id="name" class="bg-gray-200">
    </div>
    <div class="mb-4">
        <label for="mobile">رقم الجوال</label>
        <input type="text" name="mobile" id="mobile" class="bg-gray-200">
    </div>
    <div class="mb-4">
        <label for="gender">الجنس</label>
        <input type="radio" name="gender" value="male">ذكر
        <input type="radio" name="gender" value="female">أنثى
    </div>
    <div class="mb-4">
        <label for="age">العمر</label>
        <input type="text" name="age" class="bg-gray-200">
    </div>
    <button type="submit">إرسال</button>
</form>
