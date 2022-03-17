@extends('app')
@php
$_title = 'Grades';
@endphp
@section('page-title', $_title)
@section('content-title', $_title)
@section('beardcrumb-content')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/">BMA Student Portal</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $_title }}</li>
    </ol>
@endsection
@section('page-content')
@endsection
