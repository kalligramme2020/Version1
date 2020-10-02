@component('mail::message')
# Introduction

Mr {{$local->locataire->nom}} {{$local->locataire->prenom}},
nous vous informons que votre contrat de bail pour le bien {{$local->bien->name}}, expire dans les jours a venir. <br>
Contacter votre baillieur Mr {{$local->baillieur->name}}  si besion se pose .

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

merci,<br>
{{ config('app.name') }}
@endcomponent
