@component('mail::message')
Olá **{{$name}}**,

Aqui está o seu código de verificação de Login:

**{{$login_key}}**


Para inserir o código basta clicar no seguinte link.

**<a href="{{$link}}">{{$link}}</a>**

Bom trabalho,

Lyka Systems.
@endcomponent
