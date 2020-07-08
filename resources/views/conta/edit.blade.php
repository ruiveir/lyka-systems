@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Edição de uma conta bancária')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')


<div class="container-fluid my-4">

    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Edição da conta bancária <span class="active">{{$conta->descricao}}</span></strong></h4>
                </div>
            </div>
        </div>


        <hr class="my-3">

        <div class="row mt-4">
            <div class="col">
        <form method="POST" action="{{route('conta.update', $conta)}}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            @include('conta.partials.add-edit')
            </div>
        </div>

    </div>

    <div class="row mt-4">
        {{-- Butões Submit / Cancelar --}}
        <div class="col">
            <div class="alert alert-info" role="alert">
                <strong>* Os campos assinalados com asterisco são de preenchimento obrigatório</strong>
              </div>
        </div>
        <div class="col text-right pt-2" style="max-width: 300px">
            <button type="submit" class="btn btn-sm btn-success px-2 m-1 mr-2" name="submit" id="buttonSubmit"><i class="fas fa-check-circle mr-2"></i>Guardar
                Informações</button>
            <a href="{{route('conta.index')}}" class="btn btn-sm btn-secondary m-1 px-2">Cancelar</a>
        </div>

    </div>

    </form>
</div>

@section('scripts')
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection

@endsection
