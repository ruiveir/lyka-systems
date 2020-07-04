@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Novo contacto')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')



<div class="container-fluid my-4">

    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Novo contacto</strong></h4>
                </div>
            </div>
        </div>

        <hr>

        <form method="POST" action="{{route('contacts.store')}}" class="form-group needs-validation pt-3" id="form_client" enctype="multipart/form-data" novalidate>
            @csrf
            @include('contacts.partials.add-edit')

    </div>

    <div class="row mt-4">

        {{-- Butões Submit / Cancelar --}}
        <div class="col text-right pt-2">
            <button type="submit" class="btn btn-sm btn-success px-2 m-1 mr-2" name="ok" id="buttonSubmit"><i
                    class="fas fa-plus mr-2"></i>Guardar contacto</button>
            <a href="{{route('contacts.index')}}" class="btn btn-sm btn-secondary m-1 px-2">Cancelar</a>
        </div>

    </div>

    </form>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/contacts.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}
<script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection
