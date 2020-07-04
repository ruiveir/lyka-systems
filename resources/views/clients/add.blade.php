@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar estudante')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')



<div class="container-fluid my-4">

    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Adicionar Estudante</strong></h4>
                </div>
            </div>

        </div>

        <hr>

        <form method="POST" action="{{route('clients.store')}}" class="form-group needs-validation " id="form_client"
            enctype="multipart/form-data" novalidate>
            @csrf
            @include('clients.partials.add-edit')
            <div class="row mt-4">
                <div class="col text-right" style="min-width:285px">
                    <button type="submit" class="btn btn-sm btn-success m-1" name="ok" id="buttonSubmit"><i class="fas fa-plus mr-2"></i>Adicionar
                        Estudante</button>
                    <a href="{{route('clients.index')}}" class="btn btn-sm btn-secondary m-1">Cancelar</a>
                </div>
            </div>

        </form>
    </div>

    @endsection

    {{-- Scripts --}}
    @section('scripts')

    {{-- script contem: datatable configs, input configs, validações --}}
    <script src="{{asset('/js/clients.js')}}"></script>

    {{-- script permite definir se um input recebe só numeros OU so letras --}}
    <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

    <script src="{{asset('/js/editable_comboBox.js')}}"></script>

    @endsection
