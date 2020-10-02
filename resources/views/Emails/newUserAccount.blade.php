@component('mail::message')
# Bienvenu

Mr/mde: {{$recever}}

Email: {{$email}}

Votre inscription sur notre site a bien et effectuer
Bonne chance pour la suite.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
