<x-mail::message>
# Notification For ticket Purchase
# Hi **{{$purchase->attendee->name}}**

# Thank you for Purchase Tickets For the **{{$purchase->event->event_title}}**
# Details,

# Event Title : **{{$purchase->event->event_title}}**
# Event Type  : **{{$purchase->event->event_type}}**
# Ticket Type : **{{$purchase->ticket->ticket_type}}**
# Total Price : **{{$purchase->total_price}}**


{{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
