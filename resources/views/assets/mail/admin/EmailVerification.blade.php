@component('mail::message')
# Welcome {{ $data->name }}

The body of your message.
@component('mail::panel')
{{ $data->email }}
@endcomponent

@component('mail::button', ['url' => route('vendor.email.verification.token.get',[$data->token])])
Verify Account
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
