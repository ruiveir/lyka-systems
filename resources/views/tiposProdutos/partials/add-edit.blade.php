<div class="form-row mb-3">
    <div class="col-12 mb-3">
        <label for="designacao" class="text-gray-900">Tipo de produto <sup class="text-danger small">&#10033;</sup> </label>
        <input type="text" class="form-control" name="designacao" id="designacao" value="{{old('designacao',$tipoProduto->designacao)}}" maxlength="255" required>
        <div class="invalid-feedback">
            Oops, parece que algo não está bem...
        </div>
    </div>
</div>
