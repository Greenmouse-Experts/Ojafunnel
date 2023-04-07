<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomSubDomain extends Controller
{
    // handle for both page and funnel builder
    public function handle(Request $request, $subdomain)
    {
        // treat
        if ($subdomain == 'www') return redirect(env('APP_URL') . '/' . $request->content);

        return $subdomain . $request->content;
    }
}
