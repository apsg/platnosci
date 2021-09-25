@component('mail::message')
# Witaj, {{ $paymentRequest->name }}

W systemie płatności wygenerowano dla Ciebie nową płatność. Kliknij w poniższy mail aby ją zobaczyć.

##### Tytuł płatności:

{{ $paymentRequest->description }}

@component('mail::button', ['url' => $paymentRequest->url])
Zobacz płatność
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
