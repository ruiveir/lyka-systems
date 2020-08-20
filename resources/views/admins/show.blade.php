@extends('layout.master')
{{-- Page Title --}}
@section('title', 'Ficha de Administrador')
{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/users.css')}}" rel="stylesheet">
@endsection
{{-- Page Content --}}
@section('content')

@if ( Auth::user()->tipo == "admin")
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
    <div class="float-right">
        @if (Auth::user()->tipo == "admin")
        <a href="{{route('admins.edit', $admin)}}" class="top-button mr-2">Editar Informação</a>
        {{-- <a href="{{route('admins.print',$admin)}}" target="_blank" class="top-button">Imprimir</a> --}}
        @endif
    </div>

    <br><br>
    <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
        <div class="col p-0 text-center" style="flex: 0 0 20%; -ms-flex: 0 0 20%; min-width:195px">

            @if($admin->fotografia)
            <img class="m-2 p-1 rounded bg-white shadow-sm"
                src="{{Storage::disk('public')->url('admin-photos/').$admin->fotografia}}" style="width:90%">
            @elseif($admin->genero == 'F')
            <img class="m-2 p-1 rounded bg-white shadow-sm"
                src="{{Storage::disk('public')->url('default-photos/F.jpg')}}" style="width:90%">
            @else
            <img class="m-2 p-1 rounded bg-white shadow-sm"
                src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
            @endif

        </div>
        <div class="col p-2" style="min-width:280px !important">
            {{-- Informações Pessoais --}}
            <div><span class="text-secondary ">Nome:</span> {{$admin->nome}} {{$admin->apelido}}</div>
            <div><span class="text-secondary ">Género: </span>
                @if ($admin->genero == 'M')
                Masculino
                @else
                Feminino
                @endif
            </div>
            <br>
            <div><span class="text-secondary ">Data de nascimento: </span>
                {{ date('d-M-y', strtotime($admin->dataNasc)) }}</div>
                <br>
            <div><span class="text-secondary">Telefone (principal):</span> {{$admin->telefone1}}</div>
            <div><span class="text-secondary">Telefone (alternativo):</span> {{$admin->telefone2}}</div><br>
            <div><span class="text-secondary">E-mail:</span> {{$admin->email}}</div><br>
            <hr>
            <div class="text-muted"><small>Adicionado: {{ date('d-M-y', strtotime($admin->created_at)) }}</small>
            </div>
            <div class="text-muted"><small>Ultima atualização:
                    {{ date('d-M-y', strtotime($admin->updated_at)) }}</small></div>
        </div>
    </div>
</div>
@endif

@endsection
