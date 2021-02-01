@component('mail::message')

Good day!

A new learner has registered to the HIAP Portal

Full name: {{ $data['last_name'] }}, {{ $data['first_name'] }} {{ $data['middle_name'][0] }}. <br>
School: {{ $data['school'] }} <br>
Contact No.: {{ $data['contact_no'] }} <br>
Program: {{ $data['program'] }} <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
