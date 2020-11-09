<div class="form-row mb-3">
    <div class="col-md-6 mb-3">
        <label for="ficheiro" class="text-gray-900">Documento</label>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" name="ficheiro" id="ficheiro">
            <small class="form-text text-muted">O ficheiro não deve ultrupassar 20MB.</small>
            <label class="custom-file-label" for="ficheiro" data-browse="Escolher">Escolha um ficheiro...</label>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="link" class="text-gray-900">Link de acesso ao documento</label>
        <input type="text" class="form-control" name="link" id="link" placeholder="Insira um link..." required>
        <small class="form-text text-muted">Deve colocar um link de acesso ao documento quando o mesmo passa de 20MB.</small>
    </div>
</div>

<div class="form-row mb-3">
    <div class="col-md-6 mb-3">
        <label for="descricao" class="text-gray-900">Descrição do documento <sup class="text-danger small">&#10033;</sup></label>
        <input type="text" class="form-control" name="descricao" id="descricao" value="{{old('descricao',$library->descricao)}}" placeholder="Insira uma descrição..." required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="acesso" class="text-gray-900">Tipo de acesso <sup class="text-danger small">&#10033;</sup></label>
        <select name="acesso" id="acesso" class="form-control custom-select" required>
            <option disabled selected hidden>Escolha um tipo de acesso...</option>
            <option {{old('acesso',$library->acesso)=='Privado'?"selected":""}} value="Privado">Privado</option>
            <option {{old('acesso',$library->acesso)=='Público'?"selected":""}} value="Público">Público</option>
        </select>
    </div>
</div>


{{-- Nome do ficheiro --}}
<input type="hidden" value="{{old('ficheiro',$library->ficheiro)}}" class="form-control" name="file_name" id="file_name" maxlength="30" required>

{{-- Inputs auxiliares --}}
<input type="hidden" name="tipo" id="tipo" value="{{old('tipo',$library->tipo)}}">
<input type="hidden" name="tamanho" id="tamanho" value="{{old('tamanho',$library->tamanho)}}">
