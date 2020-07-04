      <div class="row">
          <div class="col">
              {{-- INPUT tipo --}}
              <label for="">Tipo (DocumentoStock):</label><br>
              <select type="text" class="form-control" name="tipo" id="tipodocstock"
                onchange="/* myFunction() */" required>
                <option selected hidden value="None"></option>
                 <option {{old('tipo',$documentostock->tipo)=='Pessoal'?"selected":""}} value="Pessoal" >Pessoal</option>
                 <option {{old('tipo',$documentostock->tipo)=='Academico'?"selected":""}} value="Academico">Academico</option>
              </select><br>
              {{-- INPUT Documento --}}
              <div class="shadow-ms" id="tipoacademico">
                <label >Documento:</label>
                <input type="text" class="form-control" name="tipoDocumento" value="{{old('tipoDocumento',$documentostock->tipoDocumento)}}" required>
              </div>
          </div>
        </div>

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
