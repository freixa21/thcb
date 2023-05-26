@component('mail::message')
# T'has registrat correctament!

Per completar la inscripció, revisa les dades i realitza el pagament.<br>
Un cop facis el pagament i ens enviïs el comprovant a través de la web, t'enviarem un correu electrònic confirmant la teva inscripció.

@component('mail::button', ['url' => route('auth.login')])
Iniciar sessió
@endcomponent

Moltes gràcies,<br>
{{ config('app.name') }}
@endcomponent