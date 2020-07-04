@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Página Inicial')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/dashboard.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')
<div class="container">
    <div class="cards-navigation">
        <div class="title">
            <h6>Navegação rápida</h6>
        </div>
        <br>
        @if (Auth::user()->tipo == "admin")
        @include('dashboard.partials.admin')
        @else
        @include('dashboard.partials.agent')
        @endif
    </div>

</div>

@endsection

{{-- Scripts --}}
@section('scripts')

<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    /* Converte Tamanho de ficheiro */
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }
</script>

@endsection
