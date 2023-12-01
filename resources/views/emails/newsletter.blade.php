{{-- resources/views/emails/newsletter.blade.php --}}

@component('mail::message')
{!! $message !!}

{{-- Attachment --}}
@endcomponent