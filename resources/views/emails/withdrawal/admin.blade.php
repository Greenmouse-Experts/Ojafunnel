<x-mail::message>
# Withdrawal Request

Hello {{ config('app.name') }}, you have a new withdrawal request of {{ $amount }} from {{ $user }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
