<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    use EditorTrait;

    public function page_builder_create()
    {   
        Page::create([
            'user_id' => Auth::user()->id,
            'name' => 'New Page',
            'listable' => 0,
            'gjs_data' => \json_decode('{"components":"[{\"type\":\"text\",\"attributes\":{\"id\":\"igf4\"},\"components\":[{\"type\":\"textnode\",\"removable\":false,\"draggable\":false,\"highlightable\":0,\"copyable\":false,\"content\":\"[[Page-Listing]]\",\"_innertext\":false}]}]","styles":"[{\"selectors\":[\"#igf4\"],\"style\":{\"padding\":\"10px\"}}]","css":"* { box-sizing: border-box; } body {margin: 0;}#igf4{padding:10px;}","html":"<div id=\"igf4\">[[New-Page]]<\/div>"}')
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Blank Page Created'
        ]);
    }

    public function viewEditor($username, Request $request, Page $page)
    {
        return $this->show_gjs_editor($request, $page);
    }

    public function viewPage($username, Request $request, Page $page)
    {
        return view('dashboard.page', compact('page'));
    }
}
