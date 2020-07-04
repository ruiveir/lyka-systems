@extends('layout.auth')

@section('title', 'Restaurar palavra-chave')

@section('content')

<div class="master-form">
    <div>
        <p>Restaurar palavra-chave</p>
        <p id="paragraph">Introduza o seu e-mail para dar continuidade ao processo.</p>
        <div id="form-div">
            <form id="form" class="email-form" method="POST">
                <div class="form-group">
                    <input id="email" type="text" class="form-control" name="email" placeholder="Endereço eletrónico">
                    <input id="id" type="text" name="id" hidden value="{{ $user->idUser }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
            <form id="form-pass" method="POST"></form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atualização da palavra-chave.</h5>
            </div>
            <div class="modal-body">
                A sua palavra-chave foi atualizada com sucesso! <br> Clique no botão <strong>Inicar sessão</strong> para recomeçar o seu trabalho.
            </div>
            <div class="modal-footer">
                <a href="{{route('login')}}" id="submit-button-modal" type="button" class="text-center">Iniciar sessão</a>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    $('#form').submit(function(event) {
        event.preventDefault();
        info = {
            email: $("#email").val(),
            id: $("#id").val()
        };
        $.ajax({
            type: "post",
            url: "{{ route('check.user') }}",
            context: this,
            data: info,
            success: function(data) {
                if ($('#error').text() != '') {
                    $('#error').remove();
                }
                user = data;
                $('#form').remove();
                $('#paragraph').text('Insira uma palavra-chave segura.');
                form = "<div class='form-group'><input id='password' type='password' class='form-control passwords' name='password' placeholder='Palavra-chave'><input id='id' type='text' name='id' hidden value='{{ $user->idUser }}'></div><div class='form-group'><input id='password-conf' type='password' class='form-control passwords' name='password-conf' placeholder='Confirmar palavra-chave'></div><div><button type='submit' class='btn submit-button'>Confirmar</button></div>"
                $('#form-pass').append(form);
                $('.passwords').attr("pattern", "(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}");
                $('.passwords').attr("title", "A palavra-chave deve conter letras maiúsculas, minúsculas, números e não deve ser menor que 8 caracteres");
            },
            error: function() {
                if ($('#error').text() != '') {
                    $('#error').remove();
                }
                error = "<strong id='error'>O endereço eletrónico que inseriu é inválido.</strong>";
                $('#paragraph').after(error);
            }
        });
    });

    $('#form-pass').submit(function(event) {
        event.preventDefault();
        info = {
            id: $("#id").val(),
            password: $("#password").val(),
            passwordconf: $("#password-conf").val()
        };
        $.ajax({
            type: "post",
            url: "{{ route('check.password') }}",
            context: this,
            data: info,
            success: function(data) {
                if ($('#error').text() != '') {
                    $('#error').remove();
                }
                $('#modal').modal('show');
                $('#id').val("");
                $('#password').val("");
                $('#password-conf').val("");
            },
            error: function() {
                if ($('#error').text() != '') {
                    $('#error').remove();
                }
                error = "<strong id='error'>As palavras-chaves não coincidem. Tente outra vez.</strong>";
                $('#paragraph').after(error);
            }
        });
    });
</script>
@endsection
@endsection
