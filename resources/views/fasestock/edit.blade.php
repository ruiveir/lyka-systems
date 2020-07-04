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
                    <h4><strong>Editar Fase Stock - <span class="active">{{$fasestock->descricao}}<span></strong></h4>
                </div>
            </div>
        </div>

        <hr class="my-3">

        <hr>
        
        <div class="row">
            <div class="col">
                <form method="POST" action="{{route('fasestock.update',$fasestock)}}"
                    class="form-group needs-validation " id="form_client" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method("PUT")
                    @include('fasestock.partials.add-edit')

                    <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-success px-2 m-1 mr-2" name="submit"><i class="fas fa-check-circle mr-2"></i>Guardar informações</button>
                    <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary m-1 px-2">Cancelar</a>
                    </div>
                </form>

            </div>

        </div>


        @endsection



        {{-- Scripts --}}
        @section('scripts')

        {{-- script contem: datatable configs, input configs, validações --}}
        <script src="{{asset('/js/produtos.js')}}"></script>

        {{-- script permite definir se um input recebe só numeros OU so letras --}}
        <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

        @endsection
