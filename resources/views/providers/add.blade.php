@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Criação de um fornecedor')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('/css/providers.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')





<div class="container-fluid my-4">

    <div class="bg-white shadow-sm mb-2 p-4 ">

        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Criação de um fornecedor</strong></h4>
                </div>
            </div>

        </div>

        <br>

        <form action="{{route('provider.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="nome">Nome do fornecedor *</label>
                    <br>
                    <input type="text" name="nome" placeholder="Inserir o nome do fornecedor" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                    <label for="descricao">Descrição do fornecedor *</label>
                    <br>
                    <input type="text" name="descricao" placeholder="Inserir uma descrição" autocomplete="off" required>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                  <div class="help-button" id="tooltipContacto" data-toggle="tooltip" data-placement="top" title="São aceites como contactos números de telefone e/ou endereços eletrónicos.">
                      <span>
                          ?
                      </span>
                  </div>
                    <label for="contacto">Contacto do fornecedor *</label>
                    <br>
                    <input type="text" name="contacto" placeholder="Inserir o contacto do fornecedor" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                    <label for="morada">Morada do fornecedor *</label>
                    <br>
                    <input type="text" name="morada" placeholder="Inserir a morada do fornecedor" autocomplete="off" required>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col">
                    <label for="observacoes">Observações do fornecedor</label>
                    <br>
                    <textarea name="observacoes" rows="5"></textarea>
                </div>
            </div>
    </div>
    <div class="form-group text-right">
        <br>
        <button type="submit" class="btn btn-sm btn-success m-1 px-2" name="ok" id="buttonSubmit"><i class="fas fa-plus mr-2"></i>Adicionar fornecedor</button>
        <a href="{{route('provider.index')}}" class="btn btn-sm btn-secondary m-1">Cancelar</a>
    </div>

        </form>




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
