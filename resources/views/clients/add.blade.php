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

    <script>
    
        $(document).ready(function() {
            bsCustomFileInput.init();
            $(".needs-validation").submit(function(event) {
                var nif = $('#NIF').val();
                var num_doc = $('#num_docOficial').val();
                var email = $('#email').val();
    
                var uniques = num_doc + "_" + nif + "_" + email;
                
                var link = "/api/unique/cliente/"+uniques;
                $.ajax({
                    method:"GET",
                    url:link
                })
                .done(function(response){
                    if(response != null){
                        if(response.email == true){
                            alert("Já existe um cliente com esse email");
                        }
                        if(response.nif == true){
                            alert("Já existe um cliente com esse nif");
                        }
                        if(response.numdoc == true){
                            alert("Já existe um cliente com o mesmo numero de documento");
                        }
                        if(response.user == true && response.email == false){
                            alert("Já existe um user com esse email");
                        }
                    }
                })
            });
        });
    </script>
    @endsection
