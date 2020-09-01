{{-- SE FOR PARA CRIAR UM CONTACTO PARA A UNIVERISADE --}}

@if ( isset($university) )
<div class="row" style="color:#6A74C9">
    <div class="col p-3 mx-3 border bg-light rounded ">
        <i class="fas fa-university mr-1" style="color:#000000"></i>

        <span style="color:#000000">Associado à universidade:
            <strong><span style="color:#6A74C9">{{$university->nome}}</span></strong>
        </span>
        <input type="hidden" id="idUniversidade" name="idUniversidade" value="{{$university ->idUniversidade}}">
    </div>

</div>
<br>
@endif



<div class="row mb-4">

    {{-- Inputs --}}
    <div class="col" style="min-width: 400px">
        <label for="nome" class="font-weight-bold">Nome:</label><br>
        <input type="text" class="form-control" name="nome" id="nome" value="{{old('nome',$contact->nome)}}" required>
        <div class="invalid-feedback"><strong>O nome é necessário</strong></div>
        <br>

        <div class="row mb-3">
            <div class="col mr-2">
                <label for="telefone1" class="font-weight-bold">Telefone (principal):</label><br>
                <input type="text" class="form-control" name="telefone1" id="telefone1"
                    value="{{old('telefone1',$contact->telefone1)}}" maxlength="20">
            </div>
            <div class="col">
                <label for="telefone2" class="font-weight-bold">Telefone (alternativo):</label><br>
                <input type="text" class="form-control" name="telefone2" id="telefone2"
                    value="{{old('telefone2',$contact->telefone2)}}" maxlength="20">
            </div>
        </div>

        <div class="row">
            <div class="col mr-2">
                <label for="email" class="font-weight-bold">E-mail:</label><br>
                <input type="email" class="form-control" name="email" id="email"
                    value="{{old('email',$contact->email)}}">
            </div>
            <div class="col ">
                <label for="fax" class="font-weight-bold">Fax:</label><br>
                <input type="text" class="form-control" name="fax" id="fax" value="{{old('fax',$contact->fax)}}"
                    maxlength="20">
            </div>
        </div>

        <br><br>

        <i class="fas fa-star text-warning mr-2"></i><label for="favorito" class="font-weight-bold">Marcar como "favorito": </label>
        <select id="favorito" name="favorito" class="select_style custom-select ml-2" style="width:120px">
            <option {{old('favorito',$contact->favorito)=='0'?"selected":""}} value="0" selected>Não</option>
            <option {{old('favorito',$contact->favorito)=='1'?"selected":""}} value="1">Sim</option>
        </select>


    </div>



    {{-- Fotografia --}}
    <div class="col text-center justify-content-center p-2" style="max-width:350px; min-width: 270px">

        <div>
            <label for="fotografia" class="font-weight-bold">Fotografia:</label>
            <input type='file' id="fotografia" name="fotografia" style="display:none" accept="image/*" />

        </div>

        <!-- Verifica se a imagem já existe-->
        <div class="text-center" style="max-height:300px; overflow:hidden;">
            @if ($contact->fotografia!=null)
            <img src="{{url('/storage/contact-photos/').$contact->fotografia}}" id="preview"
                class="m-2 p-1 border rounded bg-white shadow-sm" style="width:80%; height:auto; cursor:pointer; min-width:118px;"
                alt=" Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
            @else
            <img src="{{url('/storage/default-photos/addImg.png')}}" id="preview"
                class="m-2 p-1 border rounded bg-white shadow-sm" style="width:80%; height:auto; cursor:pointer; min-width:118px;"
                alt=" Imagem de apresentação" title="Clique para mudar a imagem de apresentação" />
            @endif
        </div>
        <div class="mt-2"><small class="text-muted">(clique para mudar)</small></div>

    </div>

</div>


<div class="row" style="font-weight:bold;color:#6A74C9">
    <div class="col">
        <label for="observacao" class="font-weight-bold">Observações:</label><br>
        <textarea name="observacao" id="observacao" rows="5"
            style="width: 100%">{{old('observacao',$contact->observacao)}}</textarea>
    </div>
</div>
