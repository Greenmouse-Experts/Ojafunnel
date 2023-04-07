<x-mail::message>
# WhatApp Account Disconnected

<p>Hello there, we failed to continue your campaign ({{ $campaign->name }}) due to your WhatsApp account ({{ $campaign->whatsapp_account }}) not connected to Ojafunnel.</p>
<p>Please do well to connect your WhatsApp account and try again.</p> 

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
