@component('mail::message')
# Payment Slip Uploaded

{{ $data['client']['first_name'] }} {{ $data['client']['middle_name'][0] }} {{ $data['client']['last_name']}} uploaded the {{ $data['purpose'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
