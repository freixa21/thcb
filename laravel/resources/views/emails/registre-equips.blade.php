@component('mail::message')
# T'has registrat correctament!

Recorda que per completar la inscripció s'han de posar tots els jugadors del teu equip i fer el pagament.
Un cop facis el pagament i ens enviïs el comprovant a través de la web, t'enviarem un correu electrònic confirmant la teva inscripció.

@component('mail::button', ['url' => route('auth.login')])
Iniciar sessió
@endcomponent

Moltes gràcies,<br>
{{ config('app.name') }}
@endcomponent
