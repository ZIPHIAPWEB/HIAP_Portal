@component('mail::message')

Good day!

A new learner has registered to the HIAP Portal

Full name: {{ $data['last_name'] }}, {{ $data['first_name'] }} {{ $data['middle_name'][0] }}. <br>
Contact No.: {{ $data['contact_no'] }} <br>
Program: {{ $data['program'] }} <br>
Affiliation: {{ $data['affiliation'] }} <br>
@if($data['affiliation'] != 'student')
Company: {{ $data['company'] ?? 'N/A' }} <br>
@else
School: {{ $data['school'] ?? 'N/A' }} <br>
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
