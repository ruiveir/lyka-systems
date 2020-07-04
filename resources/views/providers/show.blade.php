@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Visualização de um fornecedor')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/providers.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')





<div class="container-fluid my-4" style="color: black">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Ficha do fornecedor <span class="active">{{$provider->nome}}</span></strong></h4>
                    <small>
                        <div>
                            <span>Ultima atualização:
                                <strong>{{ date('d-M-y', strtotime($provider->updated_at)) }}</strong></span>
                        </div>
                    </small>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                <a href="{{route('provider.edit', $provider)}}" class="btn btn-sm btn-success m-1 mr-2 px-3 "><i class="fas fa-pencil-alt mr-2"></i>Editar Informação</a>
            </div>

        </div>

        <hr class="my-3">


            <div class="row">
                <div class="col " style="min-width: 300px">
                    <div class="">Descrição:</div>
                    <div class="border rounded bg-light p-3 font-weight-bold">{{$provider->descricao}}</div>

                    <br>

                    <div class="">Morada:</div>
                    <div class="border rounded bg-light p-3 font-weight-bold">{{$provider->morada}}</div>

                    <br>

                    <div class="">Contacto:</div>
                    <div class="border rounded bg-light p-3 font-weight-bold">{{$provider->contacto}}</div>

                    <br>

                    <div class="">Observacões:</div>
                    @if ($provider->observacoes != null)
                        <div class="border rounded bg-light p-3">{{$provider->observacoes}}</div>
                    @else
                        <div class="border rounded bg-light p-3">
                            <div class="text-muted"><small>(sem informação)</small></div>
                        </div>
                    @endif
                </div>
            </div>

    </div>

</div>


@section('scripts')
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection

@endsection
