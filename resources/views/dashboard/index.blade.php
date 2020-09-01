@extends('layout.master')

<!-- Page Title -->
@section('title', 'Página Inicial')
<!-- CSS Style Link -->
@section('styleLinks')
<link href="{{asset('/css/dashboard.css')}}" rel="stylesheet">
@endsection

<!-- Page Content -->
@section('content')

@if (Auth::user()->tipo == "admin")
@include('dashboard.partials.admin')
@else
@include('dashboard.partials.agent')
@endif

@endsection
