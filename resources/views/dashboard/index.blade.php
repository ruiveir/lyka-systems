@extends('layout.master')

<!-- Page Title -->
@section('title', 'Página Inicial')
<!-- Page Content -->
@section('content')

@if (Auth::user()->tipo == "admin")
    @include('dashboard.partials.admin')
    @else
    @include('dashboard.partials.agent')
@endif

@endsection
