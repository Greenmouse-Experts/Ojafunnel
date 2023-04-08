<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomSubDomain extends Controller
{
    // www - 
    public function www(Request $request, $subdomain)
    {
        if ($subdomain == 'www') return redirect(env('APP_URL'));

        return 'The page you\'re looking for doesn\'t exist.';
    }

    // custom - handle for both page and funnel builder
    public function custom(Request $request, $subdomain)
    {
        // vee-varieties-page.ojafunnel.com/home
        return $subdomain . $request->content;
    }
}
