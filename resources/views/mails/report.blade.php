@component('mail::message')
Saudações!

O seguinte e-mail foi enviado através da plataforma Lyka Systems pelo utilizador **{{$name}}**.
Abaixo pode verificar alguns dos contactos que o cliente disponibilizou.

Endereço eletrónico: **{{$email}}**

@if ($phone != null)
Telemóvel: **{{$phone}}**
@endif

De seguida pode encontrar o relatório a descrever o problema que o utilizador está a enfrentar.

@component('mail::panel')
{{$text}}
@endcomponent

@if (isset($errorfile))
Para ajudar na resolução do problema, o utilizador juntou uma **captura de ecrã** que segue em anexo no presente e-mail.
@endif

Apenas lembramos que o utilizador espera uma mensagem em retorno com uma solução futura ou presente.

Obrigado,

**{{$name}}**
@endcomponent
