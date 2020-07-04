    {{-- Conteudo: Informação pessoal --}}
        <div class="row">
            <div class="col">
                {{-- INPUT descricao fasestock --}}
                <label for="descricao" class="font-weight-bold">Descrição (Fase Stock):</label><br>
                <input type="text" class="form-control" name="descricao"
                    value="{{old('descricao',$fasestock->descricao)}}" id="descricaofase"required><br>
            </div>
          </div>
