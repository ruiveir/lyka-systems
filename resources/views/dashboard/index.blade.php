@extends('layout.master')
<!-- Page Title -->
@section('title', 'Página Inicial')

<!-- CSS Style -->
@section('style-links')
    <link href="{{asset('/css/dashboard.css')}}" rel="stylesheet">
@endsection

<!-- Page Content -->
@section('content')

@if (Auth()->user()->tipo == "admin")
    @include('dashboard.partials.admin')
@else
    @include('dashboard.partials.agent')
@endif

<!-- Modal for more information -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pl-4 pb-1 pt-4">
                <h5 class="modal-title text-gray-800 font-weight-bold">Para que serve?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800 pl-4 pr-5">
                Na <i>dashboard</i>, pode encontrar resumos estatísticos acerca dos recurso humanos da Estudar Portugal, bem como informações bastante importantes.
            </div>
            <div class="modal-footer mt-3">
                <a data-dismiss="modal" class="mr-4 font-weight-bold" id="close-option">Fechar</a>
                <button type="button" data-dismiss="modal" class="btn btn-primary font-weight-bold mr-2">Entendido!</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal for more information  -->

@endsection
