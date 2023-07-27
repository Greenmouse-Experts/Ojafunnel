@component('mail::message')
    <h1>An account has been created for you</h1>
    <p>Below are the details of your account:</p>

    @component('mail::panel')
    <p><b>Your Email:</b> {{ $email }}</p>
    <p><b>Your Password:</b> {{ $password }}</p>
    @endcomponent

@endcomponent