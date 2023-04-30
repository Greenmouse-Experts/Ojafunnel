<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Domain;
use App\Models\Funnel;
use App\Models\FunnelPage;
use Illuminate\Http\Request;

class CustomSubDomain extends Controller
{
    // www - 
    public function subdomainIndex(Request $request, $subdomain)
    {
        if ($subdomain == 'www') return redirect(env('APP_URL'));

        // index.html page handler
        if (str_ends_with($subdomain, '-page')) {
            $slug = str_replace('-page', '', $subdomain);

            $_page = Page::where(['name' => 'index.html', 'slug' => $slug]);

            if ($_page->exists()) {
                $content = file_get_contents(public_path('pageBuilder/' . $slug . '/' . 'index.html'));

                return $content;
            } else return 'The page you\'re looking for doesn\'t exist.';
        }

        // index.html funnel handler
        if (str_ends_with($subdomain, '-funnel')) {
            $slug = str_replace('-funnel', '', $subdomain);

            $funnel = Funnel::where(['slug' => $slug])->first();
            $_page = FunnelPage::where(['name' => 'index.html', 'folder_id' => $funnel->id]);

            if ($_page->exists()) {
                $content = file_get_contents(public_path('funnelBuilder/' . $slug . '/' . 'index.html'));

                return $content;
            } else return 'The funnel you\'re looking for doesn\'t exist.';
        }

        return 'The page you\'re looking for doesn\'t exist.';
    }

    // custom - handle for both page and funnel builder
    public function subdomainPages(Request $request, $subdomain)
    {
        // page handler
        if (str_ends_with($subdomain, '-page')) {
            $slug = str_replace('-page', '', $subdomain);
            $page = $request->page;

            $_page = Page::where(['name' => $page . '.html', 'slug' => $slug]);

            if ($_page->exists()) {
                $content = file_get_contents(public_path('pageBuilder/' . $slug . '/' . $page . '.html'));

                return $content;
            } else return 'The page you\'re looking for doesn\'t exist.';
        }

        // funnel handler
        if (str_ends_with($subdomain, '-funnel')) {
            $slug = str_replace('-funnel', '', $subdomain);
            $page = $request->page;

            $funnel = Funnel::where(['slug' => $slug])->first();
            $_page = FunnelPage::where(['name' => $page . '.html', 'folder_id' => $funnel->id]);

            if ($_page->exists()) {
                $content = file_get_contents(public_path('funnelBuilder/' . $slug . '/' . $page . '.html'));

                return $content;
            } else return 'The funnel you\'re looking for doesn\'t exist.';
        }
    }

    public function domainIndex(Request $request, $domain)
    {
        $_domain = Domain::where('domain', $domain);

        if (!$_domain->exists()) return 'The funnel you\'re looking for doesn\'t exist.';

        // pages
        if ($_domain->first()->type == 'page') {
        }

        // funnels
        if ($_domain->first()->type == 'funnel') {
            $_funnel = Funnel::where(['slug' => $_domain->first()->slug])->first();
            $_page = FunnelPage::where(['name' => 'index.html', 'folder_id' => $_funnel->id]);

            if ($_page->exists()) {
                $content = file_get_contents(public_path('funnelBuilder/' . $_funnel->slug . '/' . 'index.html'));

                return $content;
            } else return 'The funnel you\'re looking for doesn\'t exist.';
        }
    }

    public function domainPages(Request $request, $domain)
    {
    }
}
