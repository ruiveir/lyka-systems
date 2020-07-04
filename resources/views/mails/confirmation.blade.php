@component('mail::message')
Olá **{{$name}}**,

A sua jornada com a Lyka Systems está prestes a começar, sendo que, para iniciar o seu caminho connosco, será apenas necessário seguir os passos abaixos indicados.

Para aceder à sua conta basta clicar no seguinte link.

**<a href="{{$link}}">{{$link}}</a>**

De seguida, deve inserir o código de autenticação que se encontra abaixo.

**Atenção!** Por motivos de segurança terá apenas 5 tentativas para introduzir o código que lhe foi fornecido. Em caso de escassez de tentativas, irá ter que entrar em contacto connosco.

@component('mail::panel')
**{{$key}}**
@endcomponent

Posteriormente, ser-lhe-á pedido para inserir uma palavra-chave para a sua conta. Recomendamos que utilize uma palavra-chave segura, de modo a proteger a sua preciosa conta.

Lembramos que lhe é cedido **1 mês** para a ativação da sua conta, caso contrário a sua conta será desativada e terá que pedir um restauro da mesma.

Se não sabe como e o porquê de ter recebido este este e-mail, sugerimos que apague o mesmo ou entre em contacto connosco.

Bom trabalho,

Lyka Systems.
@endcomponent
