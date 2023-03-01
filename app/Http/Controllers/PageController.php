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
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        if (str_contains($request->file_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'file name invalid.'
            ]);
        }

        $file = $request->file_name.'.html';
        
        define('MAX_FILE_LIMIT', 1024 * 1024 * 2);//2 Megabytes max html file size
        
        $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        // $datum = strval($request->file_folder);

        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path('pageBuilder') . '/'.$request->file_folder,
            'permissions' => [
                'file' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
                'dir' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
            ],
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
                'title' => $request->title,
                'name' => $file,
                'folder' => $request->file_folder,
                'file_location' => config('app.url').'/pageBuilder/'.$request->file_folder.'/'.$file
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

    public function page_builder_save_page()
    {
        // echo request()->html;

        $page = Page::find(request()->id);

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2);//2 Megabytes max html file size

        $html = "";

        if (isset(request()->html))
        {
            $html = substr(request()->html, 0, MAX_FILE_LIMIT);
        }

        $disk = public_path('pageBuilder/'.$page->folder.'/'.$page->name);

        if (file_put_contents($disk, $html)) {
        	echo "File saved.";
        } else {
        	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        	echo "Error saving file. \nPossible causes are missing write permission or incorrect file path!";
        }	
    }

    public function page_builder_update($id, Request $request)
    {   
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255']
        ]);

        if (str_contains($request->name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'file name invalid.'
            ]);
        }
         
        $idFinder = Crypt::decrypt($id);
        $page = Page::find($idFinder);

        $file = $request->name.'.html';
        
        $disk = public_path('pageBuilder/'.$page->folder.'/'.$page->name);

        rename ($disk, public_path('pageBuilder/'.$page->folder.'/'.$file));

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
                'name' => $file,
                'title' => $request->title,
                'file_location' => config('app.url').'/pageBuilder/'.$page->folder.'/'.$file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Page updated successfully!'
            ]);
        }

        $page->update([
            'name' => $file,
            'title' => $request->title,
            'file_location' => config('app.url').'/pageBuilder/'.$page->folder.'/'.$file
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
                File::deleteDirectory(public_path('pageBuilder/'.$page->folder));
            }

            $page->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Page deleted successfully!'
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
            'root'   => public_path('funnelBuilder') . '/'.$request->file_folder,
            'permissions' => [
                'file' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
                'dir' => [
                    'public' => 0777,
                    'private' => 0777,
                    'custom' => 0777
                ],
            ],
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

    public function funnel_builder_update($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'file_folder' => ['required', 'string', 'max:255'],
        ]);

        $idFinder = Crypt::decrypt($id);

        $funnel = Funnel::findorfail($idFinder);

        $disk = public_path('funnelBuilder/'.$funnel->folder.'/');

        rename ($disk, public_path('funnelBuilder/'.$request->file_folder.'/'));

        $pages = FunnelPage::where('folder_id', $funnel->id)->get();

        if($pages)
        {
            foreach($pages as $page)
            {
                $page->update([
                    'file_location' => config('app.url').'/funnelBuilder/'.$request->file_folder.'/'.$page->name
                ]);
            }
        }
        $funnel->update([
            'folder' => $request->file_folder,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Updated successfully.'
        ]); 
    }

    public function funnel_builder_delete($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if($request->delete_field == "DELETE")
        {
            $idFinder = Crypt::decrypt($id);

            $funnel = Funnel::findorfail($idFinder);

            $disk = public_path('funnelBuilder/'.$funnel->folder.'/');

            File::deleteDirectory($disk);

            $pages = FunnelPage::where('folder_id', $funnel->id)->get();

            if($pages)
            {
                foreach($pages as $page)
                {
                    $page->delete();
                }
            }

            $funnel->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Deleted successfully.'
            ]); 
        } 

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, try again."
        ]); 
    }

    public function funnel_builder_create_page(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        $funnel = Funnel::findorfail($request->file_folder);

        if (str_contains($request->file_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'file name invalid.'
            ]);
        }

        $file = $request->file_name.'.html';
        
        define('MAX_FILE_LIMIT', 1024 * 1024 * 2);//2 Megabytes max html file size
        
        $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        $disk = public_path('funnelBuilder/'.$funnel->folder.'/');
        
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
                'title' => ucfirst($request->title),
                'file_location' => config('app.url').'/funnelBuilder/'.$funnel->folder.'/'.$file
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
        $funnel = Funnel::where('id', $currentpage->folder_id)->first();

        return view('dashboard.funnelEditor', [
            'currentpage' => $currentpage,
            'pages' => $pages,
            'funnel' => $funnel
        ]);
    }

    public function funnel_builder_update_page($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        $idFinder = Crypt::decrypt($id);

        $page = FunnelPage::find($idFinder);
        $funnel = Funnel::findorfail($page->folder_id);

        if (str_contains($request->file_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'file name invalid.'
            ]);
        }

        $file = $request->file_name.'.html';
        
        $disk = public_path('funnelBuilder/'.$funnel->folder.'/'.$page->name);

        rename ($disk, public_path('funnelBuilder/'.$funnel->folder.'/'.$file));

        //Validate User
        if (request()->hasFile('thumbnail')) {
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpeg,png,jpg',
            ]);

            $filename = request()->thumbnail->getClientOriginalName();
            if($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }
            request()->thumbnail->storeAs('funnel_page_thumbnails', $filename, 'public');
            
            $page->update([
                'folder_id' => $funnel->id,
                'name' => $file,
                'title' => ucfirst($request->title),
                'thumbnail' => '/storage/funnel_page_thumbnails/'.$filename,
                'file_location' => config('app.url').'/funnelBuilder/'.$funnel->folder.'/'.$file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name.' updated.'
            ]);
        }

        $page->update([
            'folder_id' => $funnel->id,
            'name' => $file,
            'title' => ucfirst($request->title),
            'file_location' => config('app.url').'/funnelBuilder/'.$funnel->folder.'/'.$file
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $page->name.' updated.'
        ]);
    }
    
    public function funnel_builder_delete_page($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if($request->delete_field == "DELETE")
        {
            $idFinder = Crypt::decrypt($id);

            $page = FunnelPage::findorfail($idFinder);
            $funnel = Funnel::findorfail($page->folder_id);

            $disk = public_path('funnelBuilder/'.$funnel->folder.'/'.$page->name);

            File::delete($disk);

            if($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }

            $page->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Deleted successfully.'
            ]); 
        } 

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, try again."
        ]); 
    }

    public function funnel_builder_save_page()
    {
        $page = FunnelPage::find($_POST['id']);
        $funnel = Funnel::findorfail($page->folder_id);

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2);//2 Megabytes max html file size

        $html = "";

        if (isset($_POST['html']))
        {
            $html = substr($_POST['html'], 0, MAX_FILE_LIMIT);
        }

        $disk = public_path('funnelBuilder/'.$funnel->folder.'/'.$page->name);

        if (file_put_contents($disk, $html)) {
        	echo "File saved.";
        } else {
        	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        	echo "Error saving file. \nPossible causes are missing write permission or incorrect file path!";
        }	
    }

    public function general_builder_scan()
    {
        if (isset($_POST['mediaPath'])) {
            define('UPLOAD_PATH', $_POST['mediaPath']);
        } else {
            define('UPLOAD_PATH', 'media');
        }
        
        $scandir = __DIR__ . '/' . UPLOAD_PATH;
        
        // Run the recursive function
        // This function scans the files folder recursively, and builds a large array
        
        $scan = function ($dir) use ($scandir, &$scan) {
            $files = [];
        
            // Is there actually such a folder/file?
        
            if (file_exists($dir)) {
                foreach (scandir($dir) as $f) {
                    if (! $f || $f[0] == '.') {
                        continue; // Ignore hidden files
                    }
        
                    if (is_dir($dir . '/' . $f)) {
                        // The path is a folder
        
                        $files[] = [
                            'name'  => $f,
                            'type'  => 'folder',
                            'path'  => str_replace($scandir, '', $dir) . '/' . $f,
                            'items' => $scan($dir . '/' . $f), // Recursively get the contents of the folder
                        ];
                    } else {
                        // It is a file
        
                        $files[] = [
                            'name' => $f,
                            'type' => 'file',
                            'path' => str_replace($scandir, '', $dir) . '/' . $f,
                            'size' => filesize($dir . '/' . $f), // Gets the size of this file
                        ];
                    }
                }
            }
        
            return $files;
        };
        
        $response = $scan($scandir);
        
        // Output the directory listing as JSON
        
        header('Content-type: application/json');
        
        echo json_encode([
            'name'  => '',
            'type'  => 'folder',
            'path'  => '',
            'items' => $response,
        ]);
    }

    public function general_builder_upload()
    {
        define('UPLOAD_FOLDER', __DIR__ . '/');

        if (isset($_POST['mediaPath'])) {
            define('UPLOAD_PATH', $this->sanitizeFileName($_POST['mediaPath']) .'/');
        } else {
            define('UPLOAD_PATH', '/');
        }

        // $destination = UPLOAD_FOLDER . UPLOAD_PATH . '/' . $_FILES['file']['name'];
        $disk = public_path('builder/media/'.$_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $disk);

        if (isset($_POST['onlyFilename'])) {
            echo $_FILES['file']['name'];
        } else {
            echo UPLOAD_PATH . $_FILES['file']['name'];
        }
    }
}
