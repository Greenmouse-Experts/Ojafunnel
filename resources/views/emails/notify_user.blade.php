<x-mail::message>

Hello {{ $user }}<br>
{{ $message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
