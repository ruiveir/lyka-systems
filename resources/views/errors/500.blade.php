@extends('layout.master')
<!-- Page Title -->
@section('title', 'Página não encontrada')
<!-- Page Content -->
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="text-center mt-5">
        <div class="error mx-auto" data-text="500">500</div>
        <p class="lead text-gray-800 mb-3 ml-1">Erro no sistema</p>
        <p class="text-gray-500 mb-0">Ayay, acho que os servidores esão a começar a deitar fumo...</p>
    </div>
</div>
<!-- End of container-fluid -->
@endsection
<!-- End of Page Content -->
