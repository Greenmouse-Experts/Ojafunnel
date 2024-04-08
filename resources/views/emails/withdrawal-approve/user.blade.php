<x-mail::message>
# Withdrawal Request

Hello {{ $_user->first_name }} {{ $_user->last_name }}, your withdrawal request of {{ $amount }} has been processed successfully.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
