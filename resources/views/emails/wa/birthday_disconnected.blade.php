<x-mail::message>
# WhatApp Account Disconnected

<p>Hello there, we failed to continue your birthday campaign ({{ $birthday_automation->title }}) due to your WhatsApp account ({{ $birthday_automation->sender_id }}) not connected to Ojafunnel.</p>
<p>Please do well to connect your WhatsApp account and try again.</p> 

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
