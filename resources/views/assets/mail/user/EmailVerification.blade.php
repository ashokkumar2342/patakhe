@component('mail::message')
# Welcome {{ $user->name }}

Email verification mail
@component('mail::panel')
{{ $user->email }}
@endcomponent

@component('mail::button', ['url' => route('user.email.verification.token.get',[$user->token])])
Verify Account
@endcomponent


Thanks,<br>
{{ config('app.name') }}

<br>
@endcomponent
