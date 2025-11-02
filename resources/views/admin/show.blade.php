@php($title = 'Admin  show')
@extends('layout.app')
@section('content')

    name = {{$teacher->name}} <br>
    email = {{$teacher->email}} <br>
    id = {{$teacher->id}}
@endsection
