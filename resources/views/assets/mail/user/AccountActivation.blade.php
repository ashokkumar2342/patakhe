@component('mail::message')
# Welcome {{ $user->name }}

The body of your message.
@component('mail::panel')
{{ $user->email }}
@endcomponent

Use this otp for account activation {{ $user->confirmation_code }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
