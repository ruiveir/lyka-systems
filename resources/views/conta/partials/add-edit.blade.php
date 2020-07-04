<div class="row">
    <div class="col-md-6">
        <label for="descricao" class="font-weight-bold">* Descrição da conta:</label>
        <br>
        <input class="form-control" type="text" name="descricao" placeholder="Inserir uma descrição" autocomplete="off" value="{{old('descricao', $conta->descricao)}}" required>
    </div>
    <div class="col-md-6">
        <label for="instituicao" class="font-weight-bold">* Nome da instituição:</label>
        <br>
        <input class="form-control" type="text" name="instituicao" placeholder="Inserir o nome da instituição" autocomplete="off" value="{{old('instituicao', $conta->instituicao)}}" required>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-6">
        <label for="titular" class="font-weight-bold">* Nome do titular:</label>
        <br>
        <input class="form-control" type="text" name="titular" placeholder="Inserir o nome do titular" autocomplete="off" value="{{old('titular', $conta->titular)}}" required>
    </div>
    <div class="col-md-6">
        <label for="morada" class="font-weight-bold">* Morada da instituição:</label>
        <br>
        <input class="form-control" type="text" name="morada" placeholder="Inserir a morada da instituição" autocomplete="off" value="{{old('morada', $conta->morada)}}" required>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-6">
        <label for="numConta" class="font-weight-bold">* Número de conta:</label>
        <br>
        <input class="form-control" type="text" name="numConta" placeholder="Inserir o número de conta" autocomplete="off" value="{{old('numConta', $conta->numConta)}}" required>
    </div>
    <div class="col-md-6">
        <label for="IBAN" class="font-weight-bold">* Código IBAN:</label>
        <br>
        <input class="form-control" type="text" name="IBAN" placeholder="Inserir o código IBAN" autocomplete="off" value="{{old('IBAN', $conta->IBAN)}}" required>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-6">
        <label for="SWIFT" class="font-weight-bold">* Código SWIFT:</label>
        <br>
        <input class="form-control" type="text" name="SWIFT" placeholder="Inserir o código SWIFT" autocomplete="off" value="{{old('SWIFT', $conta->SWIFT)}}" required>
    </div>
    <div class="col-md-6" >
        <label for="contacto" class="font-weight-bold">Contacto da instituição: </label>
        <br>
        <input class="form-control" type="text" name="contacto" placeholder="Inserir um contacto da instituição" autocomplete="off" value="{{old('contacto', $conta->contacto)}}">
    </div>
</div>
<br><br>
<div class="row">
    <div class="col">
        <label for="obsConta" class="font-weight-bold">Observações da conta:</label>
        <br>
        <textarea  name="obsConta" rows="5" rows="5" style="width:100%">{{old('obsConta', $conta->obsConta)}}</textarea>
    </div>
</div>
