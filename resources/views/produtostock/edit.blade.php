@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Editar informações')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('css/produtos.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')



<div class="container-fluid my-4">

    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Editar Informações do Produto Stock</strong></h4>
                </div>
            </div>
        </div>

        <hr>

        <form method="POST" action="{{route('produtostock.update',$produtostock)}}" class="form-group needs-validation " id="form_client"
        enctype="multipart/form-data" novalidate>
        @csrf
        @method("PUT")
        @include('produtostock.partials.add-edit')

    </div>

    <div class="row mt-4">

        {{-- Butões Submit / Cancelar --}}
        <div class="col text-right pt-2">
            <button type="submit" class="btn btn-sm btn-success px-2 m-1 mr-2" name="ok" id="buttonSubmit"><i class="fas fa-check-circle mr-2"></i>Guardar Informações</button>
            <a href="{{route('produtostock.index')}}" class="btn btn-sm btn-secondary m-1 px-2">Cancelar</a>
        </div>

    </div>

    </form>
</div>


@endsection



{{-- Scripts --}}
@section('scripts')

    {{-- script contem: datatable configs, input configs, validações --}}
    <script src="{{asset('/js/produtos.js')}}"></script>

    {{-- script permite definir se um input recebe só numeros OU so letras --}}
    <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection
