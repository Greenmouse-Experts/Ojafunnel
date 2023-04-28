<x-mail::message>
# Withdrawal Request

Hello {{ config('app.name') }}, you have successfully processed the withdrawal request of {{ $amount }} to {{ $_user }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
