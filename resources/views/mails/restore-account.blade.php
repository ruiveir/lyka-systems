@component('mail::message')
Olá **{{$name}}**,

Este e-mail foi-lhe enviado a seu pedido para restaurar a sua conta Lyka. Caso contrário, pedimos que apague o mesmo ou que nos contacte.

Para restaurar a sua conta basta clicar no seguinte link.

**<a href="{{$link}}">{{$link}}</a>**

De seguida, deve inserir o código de autenticação que se encontra abaixo.

**Atenção!** Por motivos de segurança terá apenas 5 tentativas para introduzir o código que lhe foi fornecido. Em caso de escassez de tentativas, irá ter que entrar em contacto connosco.

@component('mail::panel')
**{{$key}}**
@endcomponent

Posteriormente, ser-lhe-á pedido para inserir uma palavra-chave para a sua conta. Recomendamos que utilize uma palavra-chave segura, de modo a proteger a sua preciosa conta.

Lembramos que lhe é cedido **1 mês** para a ativação da sua conta, caso contrário a sua conta será desativada e terá que pedir um restauro da mesma.

Bom trabalho,

Lyka Systems.
@endcomponent
