@component('mail::message')
# T'has registrat correctament!

Per completar la inscripció com a espectador, revisa les dades i realitza el pagament.<br>

<strong>Passos a seguir:</strong>
1. Accedeix al teu perfil per comprovar les teves dades, allà podràs veure el preu de la inscripció
2. Fes el pagament per Bizum tal com indica les instruccions i fes una captura del rebut/pagament (Les podràs veure quan tinguis la sessió iniciada).
3. Adjunta la captura de pantalla del rebut i envia-la a través de la web a l'apartat "Estat de la inscripció".

Un cop verifiquem el pagament rebràs un correu i la teva inscripció quedarà confirmada!

@component('mail::button', ['url' => route('auth.login')])
COMPLETAR INSCRIPCIÓ
@endcomponent

Moltes gràcies,<br>
{{ config('app.name') }}
@endcomponent