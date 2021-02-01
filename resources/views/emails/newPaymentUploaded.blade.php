@component('mail::message')

Good day!

A learner has uploaded a receipt. Please verify the payment in the HIAP Portal.

Name: {{ $data['first_name'] }} {{ $data['middle_name'][0] }} {{ $data['last_name']}} <br>
School: {{ $data['school']['name'] }} <br>
Mobile No.: {{ $data['contact_no'] }} <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
