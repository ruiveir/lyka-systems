@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Adicionar Universidade')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')


<div class="container-fluid my-4">

    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Adicionar Universidade</strong></h4>
                </div>
            </div>
        </div>

        <hr>

        <form method="POST" action="{{route('universities.store')}}" class="form-group needs-validation"
            id="form_university" enctype="multipart/form-data" novalidate>
            @csrf
            @include('universities.partials.add-edit')

    </div>
    <div class="text-right mt-4">

        <button type="submit" class="btn btn-sm btn-success px-2 m-1 mr-2" name="ok" id="buttonSubmit"><i
            class="fas fa-plus mr-2"></i>Adicionar
            universidade</button>
        <a href="{{route('universities.index')}}" class="btn btn-sm btn-secondary m-1 px-2">Cancelar</a>

        </form>
    </div>
</div>


@endsection



{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/university.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}
<script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection
