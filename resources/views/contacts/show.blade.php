@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Detalhes do contacto')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection



{{-- Page Content --}}
@section('content')


<div class="container-fluid my-4" style="color: black">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm  p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Detalhes do contacto <span class="active">{{$contact->nome}}</span></strong></h4>
                    <small>
                        <div>
                            <span>Ultima atualização:
                                <strong>{{ date('d-M-y', strtotime($contact->updated_at)) }}</strong></span>
                        </div>
                    </small>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                <a href="{{route('contacts.edit',$contact)}}" class="btn btn-sm btn-success m-1 mr-2 px-3 "><i
                        class="fas fa-pencil-alt mr-2"></i>Editar Informação</a>
            </div>

        </div>


        <hr class="my-3">


        {{-- SE O CONTACTOS ESTIVER ASSOCIASDO À UNIVERISADE --}}
        @if ( isset($university) )
        <div class="row px-2 mb-3 ">
            <div class="col p-3 mx-2 border bg-light rounded">

                <i class="fas fa-university mr-1"></i>
                <span class="text-muted">Associado à universidade: <a class="font-weight-bold" href="{{route('universities.show',$university)}}">{{$university->nome}}</a></span>
                <input type="hidden" id="idUniversidade" name="idUniversidade" value="{{$university ->idUniversidade}}">
            </div>
        </div>
        @endif


        <div class="row mt-4">


            {{-- FOTOGRAFIA --}}
            <div class="col " style="max-width: 340px; min-width:300px">

                @if($contact->fotografia)
                <img class="p-1 rounded border bg-white shadow-sm"
                    src="{{url('/storage/contact-photos/').$contact->fotografia}}" style="width:90%">
                @else
                <img class="p-1 rounded border bg-white shadow-sm"
                    src="{{url('/storage/default-photos/M.jpg')}}" style="width:90%">
                @endif

            </div>


            <div class="col" style="min-width:350px">

                @if( $contact->favorito==1 )
                <div style="font-size:20px">
                    <i class="fas fa-star text-warning " ></i>
                    <small class="font-weight-bold">Marcado como favorito</small>
                    <br><br>
                </div>
                @endif

                <div>Telefone (principal):
                    @if ($contact->telefone1!=null)
                        <span class="font-weight-bold">{{$contact->telefone1}}</span>
                    @else
                        <span class="text-muted"><small>(Sem informação)</small></span>
                    @endif

                </div>

                <br>

                <div>Telefone (alternativo):
                    @if ($contact->telefone2!=null)
                        <span class="font-weight-bold">{{$contact->telefone2}}</span>
                    @else
                    <span class="text-muted"><small>(Sem informação)</small></span>
                    @endif
                </div>

                <br>

                <div>Fax:
                    @if ($contact->fax!=null)
                        <span class="font-weight-bold">{{$contact->fax}}</span>
                    @else
                        <span class="text-muted"><small>(Sem informação)</small></span>
                    @endif
                </div>

                <br>

                <div>E-mail:
                    @if ($contact->email!=null)
                        <span class="font-weight-bold">{{$contact->email}}</span>
                    @else
                        <span class="text-muted"><small>(Sem informação)</small></span>
                    @endif
                </div>

                <br>
                <div>Observações:</div>
                <div class="border rounded bg-light p-2 mt-2">
                    @if ($contact->observacao!=null)
                    {{$contact->observacao}}
                    @else
                    <span class="text-muted"><small>(Sem observações)</small></span>
                    @endif
                </div>

            </div>

        </div>

    </div>

</div>


@endsection

{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
