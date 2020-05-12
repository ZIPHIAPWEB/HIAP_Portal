@component('mail::message')
# Client Inquiry

Full Name : {{ $fullName }} <br>
Email: {{ $email }} <br>
Mobile Number: {{ $mobileNumber }}

Message: <br>
{{ $message }}
<!--
@component('mail::button', ['url' => ''])
Button Text
@endcomponent
-->
Thanks,<br>
Webmaster
@endcomponent
