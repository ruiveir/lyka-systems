@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Editar informações')

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
                    <h4><strong>Editar Informações de <span class="active">{{$client->nome}} {{$client->apelido}}</span></strong></h4>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                <div class="text-muted"><small>Ultima atualização:
                        {{ date('d-M-y', strtotime($client->updated_at)) }}</small></div>
            </div>

        </div>

        <hr>

        <form method="POST" action="{{route('clients.update',$client)}}" class="form-group needs-validation "
            id="form_client" enctype="multipart/form-data" novalidate>
            @csrf
            @method("PUT")
            @include('clients.partials.add-edit')
            <div class="row mt-4">
                <div class="col">
                    @if (Auth::user()->tipo == "admin")
                    <a href="{{route('clients.sendActivationEmail', $client)}}" class="btn btn-sm btn-primary m-1 px-3"><i class="fas fa-envelope mr-2"></i>Enviar
                        e-mail para ativção de conta</a>
                    @endif
                </div>
                <div class="col text-right" style="min-width:285px">
                    <button type="submit" class="btn btn-sm btn-success m-1 mr-2 px-3" name="submit"><i class="fas fa-check-circle mr-2"></i>Guardar
                        Informações</button>
                    <a href="{{route('clients.index')}}" class="btn btn-sm btn-secondary px-3">Cancelar</a>
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
                
                var link = "/api/unique/cliente/{{$client->slug}}/"+uniques;
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
