<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomSubDomain extends Controller
{
    // handle for both page and funnel builder
    public function handle(Request $request, $subdomain)
    {
        return $subdomain;
    }
}
