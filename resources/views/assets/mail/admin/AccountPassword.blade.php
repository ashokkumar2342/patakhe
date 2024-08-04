@component('mail::message')
# Introduction

The body of your message.


{{ $user->email }}
<br>
<p>Your Password is: {{ $password }}</p>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
