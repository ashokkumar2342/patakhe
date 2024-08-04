@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent
{{ $vendor->email }}
<br>
{{ $data->confirmation_code }}
Thanks,<br>
{{ config('app.name') }}
@endcomponent
