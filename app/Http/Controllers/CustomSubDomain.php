<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Funnel;
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
        // page handler
        if (str_ends_with($subdomain, '-page')) {
            $slug = str_replace('-page', '', $subdomain);
            $page = $request->page;

            $_page = Page::where(['file' => $page . '.html', 'slug' => $slug]);

            if ($_page->exits()) {
                $content = file_get_contents(public_path('pageBuilder/' . $slug . '/' . $page . '.html'));

                return $content;
            } else return 'The page you\'re looking for doesn\'t exist.';
        }

        // funnel handler
        if (str_ends_with($subdomain, '-funnel')) {
            Funnel::where();
        }
    }
}
