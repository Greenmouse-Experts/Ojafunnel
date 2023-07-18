<x-mail::message>

Hello {{ $name }},<br>
{{ $body }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
