<div class="form-row mb-3">
    <div class="col-12 mb-3">
        <label for="tipoProduto" class="text-gray-900">Tipo de produto <sup class="text-danger small">&#10033;</sup> </label>
        <select type="text" class="form-control custom-select" name="tipoProduto" id="tipoProduto" required>
            <option disabled selected hidden>Escolha um tipo de produto...</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Licenciatura'?"selected":""}} value="Licenciatura">Licenciatura</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Mestrado'?"selected":""}} value="Mestrado">Mestrado</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Doutoramento'?"selected":""}} value="Doutoramento">Doutoramento</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Curso de Verão'?"selected":""}} value="Curso de Verão">Curso de Verão</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Estágio Profissional'?"selected":""}} value="Estágio Profissional">Estágio Profissional</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Transferência de Curso'?"selected":""}} value="Transferência de Curso">Transferência de Curso</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Curso Indiomas'?"selected":""}} value="Curso Indiomas">Curso Indiomas</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Erasmus'?"selected":""}} value="Erasmus">Erasmus</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Pré-Universitário'?"selected":""}} value="Pré-Universitário">Pré-Universitário</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Serviços Estudar Portugal'?"selected":""}} value="Serviços Estudar Portugal">Serviços Estudar Portugal</option>
            <option {{old('tipoProduto',$produtostock->tipoProduto)=='Seguro'?"selected":""}} value="Seguro">Seguro</option>
        </select>
        <div class="invalid-feedback">
            Oops, parece que algo não está bem...
        </div>
    </div>
</div>

<div class="form-row mb-3">
    <div class="col-12 mb-3">
        <label for="anoAcademico" class="text-gray-900">Ano académico <sup class="text-danger small">&#10033;</sup> </label>
        <select type="text" class="form-control custom-select" name="anoAcademico" id="anoAcademico" required>
            <option disabled hidden selected>Escolha um ano académico...</option>
            @foreach($anosAcademicos as $ano)
                <option {{old('anoAcademico',$produtostock->anoAcademico)==$ano?"selected":""}} value="{{$ano}}">{{$ano}}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Oops, parece que algo não está bem...
        </div>
    </div>
</div>

<div class="form-row mb-3">
    <div class="col-12 mb-3">
        <label for="descricao" class="text-gray-900">Descrição do produto <sup class="text-danger small">&#10033;</sup> </label>
        <input type="text" class="form-control" name="descricao" id="descricao" value="{{old('descricao',$produtostock->descricao)}}" maxlength="255" required>
        <div class="invalid-feedback">
            Oops, parece que algo não está bem...
        </div>
    </div>
</div>
