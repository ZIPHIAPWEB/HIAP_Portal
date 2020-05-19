@component('mail::message')
# New Applicant

Full name: {{ $data->last_name }}, {{ $data->first_name }} {{ $data->middle_name[0] }}. <br>
Contact Number: {{ $data->contact_no }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
