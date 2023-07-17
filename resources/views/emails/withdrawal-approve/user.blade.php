<x-mail::message>


@if(isset($page) && $page == "list_mgt")

    # List Approved
    
    Hello {{ $_user }}, {{ $message }}

@else

    # Withdrawal Request

    Hello {{ $_user }}, your withdrawal request of {{ $amount }} has been processed successfully.
    
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
