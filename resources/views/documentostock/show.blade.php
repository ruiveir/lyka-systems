@extends('layout.master')

{{-- Page Title --}}
@section('title', 'FaseStock')

{{-- CSS Style Link --}}
@section('styleLinks')

@endsection

{{-- Page Content --}}
@section('content')

    <div class="container mt-2">
        {{-- Navegação --}}
        <div class="float-left buttons">
            <a href="javascript:history.go(-1)" title="Voltar">
                <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
            </a>
            <a href="javascript:window.history.forward();" title="Avançar">
                <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
            </a>
        </div>
        <br><br>
        <div class="cards-navigation">
            <div class="title">
                <h6><b>Documento Stock:</b><br><br><br>
                  Tipo {{$documentostock->tipo}},  {{$documentostock->tipoDocumento}}</h6>
            </div>
        </div>
    </div>

@endsection
{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
