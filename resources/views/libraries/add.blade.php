@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar ficheiro')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/inputs.css')}}" rel="stylesheet">
<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')

<div class="container-fluid my-4">

    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Adicionar Ficheiro à Biblioteca</strong></h4>
                </div>
            </div>
        </div>

        <hr class="my-3">

            <form method="POST" action="{{route('libraries.store')}}" class="form-group needs-validation" id="form_library" enctype="multipart/form-data" novalidate>
                @csrf
                @include('libraries.partials.add-edit')

    </div>
    <div class="text-right mt-4">
        <button type="submit" class="btn btn-sm btn-success px-2 mr-2" name="submit"><i class="fas fa-plus mr-2"></i>Adicionar Ficheiro</button>
    <a href="{{route('libraries.index')}}" class="btn btn-sm btn-secondary px-2">Cancelar</a>
    </form>
</div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')

<script src="{{asset('/js/library.js')}}"></script>

@endsection
