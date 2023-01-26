<?php

namespace App\Http\Controllers;

use App\Models\Funnel;
use App\Models\FunnelPage;
use App\Models\Page;
use Illuminate\Http\Request;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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
    
    public function page_builder_create(Request $request)
    {   
        //Validate Request
        $this->validate($request, [
            'page_name' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        $file = $request->file_name.'.html';
        
        define('MAX_FILE_LIMIT', 1024 * 1024 * 2);//2 Megabytes max html file size
        
        $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        // $datum = strval($request->file_folder);

        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path() . '/'.$request->file_folder,
        ]);
        
        if(!$disk->put($file, $html)){
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            return back()->with([
                'type' => 'danger',
                'message' => 'Error saving file  '.$file.'\nPossible causes are missing write permission or incorrect file path!'
            ]);
        } else {
            $page = Page::create([
                'user_id' => Auth::user()->id,
                'name' => $request->page_name,
                'file_name' => $file,
                'folder' => $request->file_folder,
                'file_location' => config('app.url').'/'.$request->file_folder.'/'.$file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name.' created.'
            ]);
        };
    }

    function sanitizeFileName($file)
    {
        //sanitize, remove double dot .. and remove get parameters if any
        $file = preg_replace('@\?.*$@' , '', preg_replace('@\.{2,}@' , '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $file)));
        return $file;
    }

    public function viewEditor($username, $id)
    {
        $finder = Crypt::decrypt($id);

        $page = Page::find($finder);

        return view('dashboard.editor', [
            'page' => $page
        ]);
    }

    public function viewPage($username, Request $request, Page $page)
    {
        return view('dashboard.page', compact('page'));
    }

    public function page_builder_save_page($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $page = Page::find($finder);

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2);//2 Megabytes max html file size

        $html = "";

        if (isset($_POST['html']))
        {
            $html = substr($_POST['html'], 0, MAX_FILE_LIMIT);
        }

        dd($html);
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

            if($page->file_location) {
                File::delete(public_path($page->folder.'/'.$page->file_name));
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


    public function funnel_builder_create_folder(Request $request)
    {   
        //Validate Request
        $this->validate($request, [
            'file_folder' => ['required', 'string', 'max:255'],
        ]);

        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path('user_funnel') . '/'.$request->file_folder,
        ]);

        if($disk)
        {
            Funnel::create([
                'user_id' => Auth::user()->id,
                'folder' => $request->file_folder,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Folder created.'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to create folder.'
            ]);
        }
    }

    public function funnel_builder_create_page(Request $request)
    {
        $funnel = Funnel::findorfail($request->file_folder);

        $file = $request->file_name.'.html';
        
        define('MAX_FILE_LIMIT', 1024 * 1024 * 2);//2 Megabytes max html file size
        
        $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        $disk = public_path('user_funnel/'.$funnel->folder.'/');
        
        if(!file_put_contents($disk.$file, $html)){
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            return back()->with([
                'type' => 'danger',
                'message' => 'Error saving file  '.$file.'\nPossible causes are missing write permission or incorrect file path!'
            ]);
        } else {
            $page = FunnelPage::create([
                'user_id' => Auth::user()->id,
                'folder_id' => $funnel->id,
                'name' => $file,
                'title' => $request->title,
                'file_location' => config('app.url').'/user_funnel/'.$funnel->folder.'/'.$file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name.' created.'
            ]);
        }
    }

    public function viewFunnelEditor($username, $id)
    {
        $finder = Crypt::decrypt($id);

        $currentpage = FunnelPage::find($finder);
        
        $pages = FunnelPage::where('user_id', Auth::user()->id)->get();
        
        return view('dashboard.funnelEditor', [
            'currentpage' => $currentpage,
            'pages' => $pages
        ]);
    }
    
}
