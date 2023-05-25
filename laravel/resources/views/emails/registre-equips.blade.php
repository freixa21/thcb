@component('mail::message')
# Equip registrat correctament!

Recorda que per completar la inscripció s'han de posar tots els jugadors del teu equip i fer el pagament.<br>
Un cop facis el pagament i ens enviïs el comprovant a través de la web, us enviarem un correu electrònic confirmant la vostra inscripció.

@component('mail::button', ['url' => route('auth.login')])
Iniciar sessió
@endcomponent

Moltes gràcies,<br>
{{ config('app.name') }}
@endcomponent
