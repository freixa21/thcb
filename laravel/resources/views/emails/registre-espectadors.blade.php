@component('mail::message')
# T'has registrat correctament!

Per completar la inscripció, revisa les dades i realitza el pagament.<br>

<strong>Passos a seguir:</strong>
1. Inscriu al teu equip un mínim de 5 jugadors, recorda que tu també t'has d'afegir.
2. Un cop hagis apuntat a tots els jugadors, podràs veure l'import total de la inscripció de l'equip per fer el pagament.
3. Fes el pagament per Verse o Bizum tal com indica les instruccions i fes una captura del rebut/pagament (Les podràs veure quan tinguis la sessió iniciada).
4. Adjunta la captura de pantalla del rebut i envia-la a través de la web a l'apartat "Estat de la inscripció".

Un cop verifiquem el pagament rebràs un correu i la teva inscripció quedarà confirmada!

@component('mail::button', ['url' => route('auth.login')])
Iniciar sessió
@endcomponent

Moltes gràcies,<br>
{{ config('app.name') }}
@endcomponent