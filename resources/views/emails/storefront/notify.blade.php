<x-mail::message>
# {{ $_subject }}

{{ $_content }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
