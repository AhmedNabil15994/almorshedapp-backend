@component('mail::message')

<h3>Username : {{ $data->name }}</h3>
<h3>E-mail   : {{ $data->email }}</h3>
<p> Message  : {!!$data->message !!}</p>

<hr>

{{ config('app.name') }}
@endcomponent
