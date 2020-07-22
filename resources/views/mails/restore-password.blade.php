@component('mail::message')
Olá **{{$name}}**,

Este e-mail foi-lhe enviado a seu pedido para recuperar a sua palavra-chave da sua conta Lyka. Caso contrário, pedimos que apague o mesmo ou que nos contacte.

Para restaurar a sua palavra-chave basta clicar no seguinte link.

**<a href="{{$link}}">{{$link}}</a>**

Deve inserir o seguinte código de modo a proseguir com o restauro da sua password.

@component('mail::panel')
**{{$key}}**
@endcomponent

Posteriormente, ser-lhe-á pedido para inserir uma palavra-chave. Recomendamos que utilize uma palavra-chave segura, de modo a proteger a sua preciosa conta.

Para qualquer dúvida, não hesite em contactar-nos.

Bom trabalho,<br>
Lyka Systems.
@component('mail::subcopy')
Se não sabe o como e o porquê de ter recebido este este e-mail, sugerimos que apague o mesmo ou entre em contacto connosco.
@endcomponent
@endcomponent
