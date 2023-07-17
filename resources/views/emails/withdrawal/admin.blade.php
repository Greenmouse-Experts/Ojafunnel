<x-mail::message>
# Withdrawal Request

Hello {{ config('app.name') }}, you have a new withdrawal request of {{ $amount }} from {{ $_user }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
