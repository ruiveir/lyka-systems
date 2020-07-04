@component('mail::message')
Olá **{{$name}}**,

Este e-mail foi-lhe enviado a seu pedido para recuperar a sua palavra-chave da sua conta Lyka. Caso contrário, pedimos que apague o mesmo ou que nos contacte.

Para restaurar a sua palavra-chave basta clicar no seguinte link.

**<a href="{{$link}}">{{$link}}</a>**

Posteriormente, ser-lhe-á pedido para inserir uma palavra-chave. Recomendamos que utilize uma palavra-chave segura, de modo a proteger a sua preciosa conta.

De modo a que nunca mais receba um e-mail com esta informção, a Lyka, igualmente recomenda, que escreva a sua nova palavra-chave num local seguro e que se lembre!

Para qualquer dúvida, não hesite em contactar-nos.

Bom trabalho,

Lyka Systems.
@endcomponent
