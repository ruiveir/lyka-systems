@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Visualização de uma conta bancária')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')



<div class="container-fluid my-4" >

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Detalhes da conta bancária: <span class="active">{{$conta->descricao}}</span></strong></h4>
                </div>
                <div><small>Ultima atualização:
                        <strong>{{ date('d-M-y', strtotime($conta->updated_at)) }}</strong></small></div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                <a href="{{route('conta.edit', $conta)}}" class="btn btn-sm btn-success m-1 mr-2 px-3">
                    <i class="fas fa-pencil-alt mr-2"></i>Editar Informação</a>
            </div>

        </div>

        <hr>

        <div class="row p-2">

            <div class="col p-2" style="min-width:350px !important">

                {{-- Informações --}}

                <div class="row">
                    <div class="col" style="min-width: 350px">
                        <div>Descrição da conta:<br>
                            @if( $conta->descricao!=null )
                                <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$conta->descricao}}</div>
                            @else
                                <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                            @endif
                        </div>

                        <br>


                        <div>Nome do titular:<br>
                            @if( $conta->titular!=null )
                                <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$conta->titular}}</div>
                            @else
                                <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                            @endif
                        </div>

                        <br>

                        <div>Número de conta:<br>
                            @if( $conta->numConta!="" )
                                <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$conta->numConta}}</div>
                            @else
                                <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                            @endif
                        </div>

                        <br>

                        <div>Código IBAN:<br>
                            @if($conta->IBAN!="" )
                                <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$conta->IBAN}}</div>
                            @else
                                <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                            @endif
                        </div>

                        <br>

                        <div>Código SWIFT:<br>
                            @if( $conta->SWIFT!="" )
                                <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$conta->SWIFT}}</div>
                            @else
                                <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                            @endif
                        </div>

                        <br>

                    </div>



                    <div class="col " style="min-width: 350px">

                        <div>Nome da instituição:<br>
                            @if( $conta->instituicao!=null )
                                <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$conta->instituicao}}</div>
                            @else
                                <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                            @endif
                        </div>

                        <br>

                        <div>Morada da instituição:<br>
                            @if( $conta->morada!=null )
                                <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$conta->morada}}</div>
                            @else
                                <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                            @endif
                        </div>

                        <br>

                        <div>Contacto da instituição:<br>
                            @if( $conta->contacto!="" )
                                <div class="border rounded bg-light p-2 font-weight-bold mt-2">{{$conta->contacto}}</div>
                            @else
                                <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                            @endif
                        </div>

                        <br>

                        <div >Observações da conta:<br>
                            @if( $conta->obsConta!="" )
                                <div class="border rounded bg-light p-2 font-weight-bold mt-2 ">{{$conta->obsConta}}</div>
                            @else
                                <div class="border rounded bg-light p-2 text-muted mt-2">Sem informação</div>
                            @endif
                        </div>


                    </div>

                </div>

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
