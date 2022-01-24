@component('mail::message')
# Client Inquiry

Full Name : {{ $full_name }} <br>
Email: {{ $email }} <br>
Mobile Number: {{ $mobile_number }}

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
