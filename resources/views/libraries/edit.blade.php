@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Editar Informação do ficheiro')

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
                    <h4><strong>Editar Informação do Ficheiro</strong></h4>
                </div>
            </div>
        </div>

        <hr class="my-3">

            <form method="POST" action="{{route('libraries.update',$library)}}" class="form-group needs-validation" id="form_library" enctype="multipart/form-data" novalidate>
                @csrf
                @method("PUT")
                @include('libraries.partials.add-edit')

    </div>
    <div class="text-right mt-4">
        <button type="submit" class="btn btn-sm btn-success px-2 mr-2" name="submit"><i class="fas fa-check-circle mr-2"></i>Guardar alterações</button>
    <a href="{{route('libraries.index')}}" class="btn btn-sm btn-secondary px-2">Cancelar</a>


    </form>
</div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')

<script src="{{asset('/js/library.js')}}"></script>

@endsection

