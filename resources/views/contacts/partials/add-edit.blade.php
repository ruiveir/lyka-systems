<div class="form-row mb-1">
    <div class="col-md-6 mb-3">
        <label for="nome" class="text-gray-900">Nome completo do contacto <sup class="text-danger small">&#10033;</sup> </label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Inserir uma nome..." value="{{old('nome', $contact->nome)}}" required>
        <div class="invalid-feedback">
            Oops, parece que algo não está bem...
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="fotografia" class="text-gray-900">Fotografia</label>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" name="fotografia" id="fotografia">
            <small class="form-text text-muted">A fotografia não deve ultrupassar 2MB.</small>
            <label class="custom-file-label" for="screenshot" data-browse="Escolher">Escolher fotografia...</label>
        </div>
    </div>
</div>

<div class="form-row mb-3">
    <div class="col-md-6 mb-3">
        <label for="telefone1" class="text-gray-900">Telefone principal <sup class="text-danger small">&#10033;</sup> </label>
        <input type="text" class="form-control" name="telefone1" id="telefone1" placeholder="Inserir um número de telefone..." value="{{old('telefone1', $contact->telefone1)}}" required>
        <div class="invalid-feedback">
            Oops, parece que algo não está bem...
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="telefone2" class="text-gray-900">Telefone secundário</label>
        <input type="text" class="form-control" name="telefone2" id="telefone2" placeholder="Inserir um número de telefone..." value="{{old('telefone2', $contact->telefone2)}}">
    </div>
</div>

<div class="form-row mb-3">
    <div class="col-md-6 mb-3">
        <label for="email" class="text-gray-900">E-mail</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Inserir um e-mail..." value="{{old('email', $contact->email)}}">
    </div>
    <div class="col-md-6 mb-3">
        <label for="fax" class="text-gray-900">Fax</label>
        <input type="text" class="form-control" name="fax" id="fax" placeholder="Inserir um número de fax..." value="{{old('fax', $contact->fax)}}">
    </div>
</div>

<div class="form-row mb-3">
    <div class="col-md-6 mb-3">
        <label for="favorito" class="text-gray-900">Favorito <sup class="text-danger small">&#10033;</sup></label>
        <select class="custom-select" name="favorito" id="favorito" value="{{old('favorito', $contact->favorito)}}" required>
            <option {{old('favorito',$contact->favorito)=='0'?"selected":""}} value="0" selected>Não</option>
            <option {{old('favorito',$contact->favorito)=='1'?"selected":""}} value="1">Sim</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label for="observacao" class="text-gray-900">Observações</label>
        <input type="text" class="form-control" name="observacao" id="observacao" placeholder="Inserir uma observação..." value="{{old('observacao', $contact->observacao)}}">
    </div>
</div>

@if(isset($university))
    <input disabled hidden type="text" name="idUniversidade" value="{{$university->idUniversidade}}">
@endif
