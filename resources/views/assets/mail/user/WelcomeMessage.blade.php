@component('mail::message')
<div >Welcome <strong>{{ $user->name }}</strong>.</div>
<br>
Dear user you are registerd successfull ! Please Wait our excutive will contact you soon.
@component('mail::panel')
{{ $user->email }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
{{ route('front.home') }}
@endcomponent
