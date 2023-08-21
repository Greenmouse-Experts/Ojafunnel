@component('mail::message')
    <h1>An account has been created for you</h1>
    <p>Below are the details of your account:</p>

    {{ $email_message }}


@endcomponent