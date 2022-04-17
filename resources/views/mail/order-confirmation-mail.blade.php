@component('mail::message')
# Zamówienie potwierdzone

Twoje zamówienie na platformie {{ config('app.name') }} zostało opłacone.

@component('mail::table')
|               |                                         |
| ------------- | --------------------------------------- |
| Produkt       | {{ $order->sale->description }}         |
| Cena          | {{ $order->price }} PLN                 |
| Zamawiający   | {{ $order->email }} {{ $order->phone }} |
@endcomponent

Niedługo otrzymasz emaile z dalszymi informacjami o zakupionych produktach.

Jeśli potrzebujesz faktury za swój zakup, kliknij w poniższy link i uzupełnij dane.

@component('mail::button', ['url' => route('orders.invoice', $order)])
Chcę fakturę
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
