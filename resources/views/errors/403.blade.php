@extends('layout.master')
<!-- Page Title -->
@section('title', 'Página não encontrada')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="text-center mt-5">
        <div class="error mx-auto" data-text="403">403</div>
        <p class="lead text-gray-800 mb-3 ml-1">Acesso negado</p>
        <p class="text-gray-500 mb-0">Hum, acho que não têm permissão para ver esta página...</p>
    </div>
</div>
<!-- End of container-fluid -->
@endsection
<!-- End of Page Content -->
