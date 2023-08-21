@component('mail::message')
<h1>An account has been created for you</h1>
<p>We are excited to have you join our community. Below are the details of your account:</p>

Here are your details:
- Name: <b>{{ $email }}</b>
- Email: <b>{{ $password }}</b>

Best regards,<br>
{{ config('app.name') }}
@endcomponent