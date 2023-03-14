<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ \App\Models\Setting::get("site_description") }}">
<meta name="keywords" content="{{ \App\Models\Setting::get("site_keyword") }}" />
<meta name="php-version" content="{{ phpversion() }}" />

<title>@yield('title') - {{ \App\Models\Setting::get("site_name") }}</title>

@if (\App\Models\Setting::get('site_favicon'))
    <link rel="shortcut icon" type="image/png" href="{{ action('SettingController@file', \App\Models\Setting::get('site_favicon')) }}"/>
@else
    @include('layouts.core._favicon')
@endif

@include('layouts.core._includes')
