<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    use EditorTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
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

    public function page_builder_update($id, Request $request)
    {   
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255']
        ]);

        $idFinder = Crypt::decrypt($id);

        //Page
        $page = Page::find($idFinder);

        //Validate User
        if (request()->hasFile('thumbnail')) {
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->thumbnail->getClientOriginalName();
            if($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }
            request()->thumbnail->storeAs('pages', $filename, 'public');

            $page->update([
                'thumbnail' => '/storage/pages/'.$filename,
                'name' => $request->name,
                'title' => $request->title,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Page Updated Successfully!'
            ]);
        }

        $page->update([
            'name' => $request->name,
            'title' => $request->title,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Page Updated Successfully!'
        ]);
    }

    public function page_builder_delete($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if($request->delete_field == "DELETE")
        {
            $idFinder = Crypt::decrypt($id);

            $page = Page::findorfail($idFinder);

            if($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }

            $page->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Page Deleted Successfully!'
            ]); 
        } 

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, Try Again!"
        ]); 
    }
}
