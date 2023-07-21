<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Domain;
use App\Models\Funnel;
use App\Models\FunnelPage;
use Illuminate\Http\Request;
use App\Models\OjaPlanParameter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;

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
        $this->middleware(['auth', 'verified']);
    }

    public function generatePageSlug($folder)
    {
        $slug = strtolower(implode('-', explode(' ', $folder)));

        $page = Page::where(['slug' => $slug]);

        if ($page->exists()) {
            if ($page->first()->user_id == Auth::user()->id) {
                return [true, $slug];
            } else return [false, $slug];
        }

        return [true, $slug];
    }

    public function page_builder_create(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
            'page_type' => ['required', 'string']
        ]);

        if (Page::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->page_builder) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access.'
            ]);
        }

        $page_name = strtolower(implode('-', explode(' ', $request->file_name)));

        $res =  $this->generatePageSlug($request->file_folder);

        // check if sub domain name taken
        if (!$res[0]) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain already taken.'
            ]);
        }

        // check if subdomain contains .
        if (str_contains($res[1], '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain is invalid. Can\'t contain dot(s)'
            ]);
        }

        if (str_contains($page_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name is invalid. Can\'t contain dot(s)'
            ]);
        }

        $file = $page_name . '.html';

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        // $datum = strval($request->file_folder);

        $_page = Page::where(['name' => $file, 'slug' => $res[1], 'user_id' => Auth::user()->id]);

        if ($_page->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'This page already exist on your subdomain.'
            ]);
        }

        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path('pageBuilder') . '/' . $res[1],
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

        if (!$disk->put($file, $html)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            return back()->with([
                'type' => 'danger',
                'message' => 'Error saving file  ' . $file . '\nPossible causes are missing write permission or incorrect file path!'
            ]);
        } else {
            $page = Page::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'name' => $file,
                'type' => $request->page_type,
                'folder' => $request->file_folder,
                'file_location' => config('app.url') . '/pageBuilder/' . $res[1] . '/' . $file,
                'slug' => $res[1]
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name . ' created.'
            ]);
        };
    }

    function sanitizeFileName($file)
    {
        //sanitize, remove double dot .. and remove get parameters if any
        $file = preg_replace('@\?.*$@', '', preg_replace('@\.{2,}@', '', preg_replace('@[^\/\\a-zA-Z0-9\-\._]@', '', $file)));
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
        $page = Page::find($_POST['id']);

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $html = "";

        if (isset($_POST['html'])) {
            $html = substr($_POST['html'], 0, MAX_FILE_LIMIT);
        }

        $disk = public_path('pageBuilder/' . $page->slug . '/' . $page->name);

        if (file_put_contents($disk, $html)) {
            echo "File saved.";
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            echo "Error saving file. \nPossible causes are missing write permission or incorrect file path!";
        }
    }

    public function page_builder_template_view($username, $id, Request $request)
    {
        $templates = ['landing_page', 'optin_page', 'order_form_page', 'order_bump_upsell_page', 'thank_you_page'];
        $template_folder = ['landing', 'opt-in', 'order-form', 'order-bump', 'thank-you'];
        $template_index = (int) $id;

        if ($template_index >= sizeof($templates)) {
            return redirect()->back();
        }

        $template_name = $templates[$template_index];

        // $template = file_get_contents(resource_path("views/pages/default/$template_name.blade.php"));
        // $template_data_bindings = ['page_title'];
        // $currentpage = FunnelPage::find(1);
        // $pages = FunnelPage::where('user_id', Auth::user()->id)->get();
        // $pbuilder = Funnel::where('id', 1)->first();

        $currentpage = new \StdClass();
        $currentpage->file_location = env('APP_URL') . "/pageBuilder/$template_folder[$template_index]/index.html";
        $currentpage->folder_id = $template_index;
        $currentpage->id = $template_index;
        $currentpage->name = "index.html";
        $currentpage->title = "Template " . ($template_index + 1);

        $pbuilder = new \StdClass();
        $pbuilder->user_id = Auth::user()->id;
        $pbuilder->folder = 'template';
        $pbuilder->slug = 'template';
        $pbuilder->id = $template_index;

        return view('dashboard.pageBuilderEditor', [
            'currentpage' => $currentpage,
            'pages' => [],
            'pbuilder' => $pbuilder
        ]);
    }

    public function page_builder_update($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255']
        ]);

        $page_name = strtolower(implode('-', explode(' ', $request->name)));

        if (str_contains($page_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name is invalid. Can\'t contain dot(s)'
            ]);
        }

        $idFinder = Crypt::decrypt($id);
        $page = Page::find($idFinder);

        $file = $page_name . '.html';

        $disk = public_path('pageBuilder/' . $page->slug . '/' . $page->name);

        rename($disk, public_path('pageBuilder/' . $page->slug . '/' . $file));

        // validate User
        if (request()->hasFile('thumbnail')) {
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->thumbnail->getClientOriginalName();
            if ($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }
            request()->thumbnail->storeAs('pages', $filename, 'public');

            $page->update([
                'thumbnail' => '/storage/pages/' . $filename,
                'name' => $file,
                'title' => $request->title,
                'file_location' => config('app.url') . '/pageBuilder/' . $page->slug . '/' . $file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Page updated successfully!'
            ]);
        }

        $page->update([
            'name' => $file,
            'title' => $request->title,
            'file_location' => config('app.url') . '/pageBuilder/' . $page->slug . '/' . $file
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Page Updated Successfully!'
        ]);
    }

    public function page_builder_delete($id, Request $request)
    {
        // validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if ($request->delete_field == "DELETE") {
            $idFinder = Crypt::decrypt($id);

            $page = Page::findorfail($idFinder);

            if ($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }

            if ($page->file_location) {
                File::deleteDirectory(public_path('pageBuilder/' . $page->slug));
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

    public function generateFunnelSlug($folder)
    {
        $slug = strtolower(implode('-', explode(' ', $folder)));

        $funnel = Funnel::where(['slug' => $slug]);

        if ($funnel->exists()) return [false, $slug];

        return [true, $slug];
    }

    public function funnel_builder_create_folder(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'file_folder' => ['required', 'string', 'max:255'],
        ]);

        if (Funnel::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->funnel_builder) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access.'
            ]);
        }

        $res = $this->generateFunnelSlug($request->file_folder);

        // check if sub domain name taken
        if (!$res[0]) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain already taken.'
            ]);
        }

        // check if subdomain contains .
        if (str_contains($res[1], '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain is invalid. Can\'t contain dot(s)'
            ]);
        }

        $disk = Storage::build([
            'driver' => 'local',
            'root'   => public_path('funnelBuilder') . '/' . $res[1],
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

        if ($disk) {
            Funnel::create([
                'user_id' => Auth::user()->id,
                'folder' => $request->file_folder,
                'slug' => $res[1],
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Funnel subdomain and folder created.'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'Failed to create funnel subdomain and folder.'
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

        $disk = public_path('funnelBuilder/' . $funnel->slug . '/');

        $res = $this->generateFunnelSlug($request->file_folder);

        // check slug exists on domain...
        $domain = Domain::where(['type' => 'funnel', 'slug' => $funnel->slug, 'user_id' => Auth::user()->id]);

        // check if sub domain name taken
        if (!$res[0]) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain  already taken.'
            ]);
        }

        // check if subdomain contains .
        if (str_contains($res[1], '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Sub domain is invalid. Can\'t contain dot(s)'
            ]);
        }

        rename($disk, public_path('funnelBuilder/' . $res[1] . '/'));

        $pages = FunnelPage::where('folder_id', $funnel->id)->get();

        if ($pages) {
            foreach ($pages as $page) {
                $page->update([
                    'file_location' => config('app.url') . '/funnelBuilder/' . $res[1] . '/' . $page->name
                ]);
            }
        }

        $funnel->update([
            'folder' => $request->file_folder,
            'slug' => $res[1]
        ]);

        //  then update on domain
        $domain->update([
            'subdomain' => $res[1] . '-funnel',
            'slug' => $res[1]
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

        if ($request->delete_field == "DELETE") {
            $idFinder = Crypt::decrypt($id);

            $funnel = Funnel::findorfail($idFinder);

            // check slug exists on domain...
            $domain = Domain::where(['type' => 'funnel', 'slug' => $funnel->slug, 'user_id' => Auth::user()->id]);

            $disk = public_path('funnelBuilder/' . $funnel->slug . '/');

            File::deleteDirectory($disk);

            $pages = FunnelPage::where('folder_id', $funnel->id)->get();

            if ($pages) {
                foreach ($pages as $page) {
                    $page->delete();
                }
            }

            $funnel->delete();

            //  then delete on domain
            $domain->delete();

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
        // Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'file_folder' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        $page_name = strtolower(implode('-', explode(' ', $request->file_name)));

        if (str_contains($page_name, '.')) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name is invalid. Can\'t contain dot(s)'
            ]);
        }

        $funnel = Funnel::where(['id' => $request->file_folder])->first();

        $file = $page_name . '.html';

        $funnel_page = FunnelPage::where(['name' => $file, 'folder_id' => $funnel->id]);

        if ($funnel_page->exists()) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Page name exists in the funnel'
            ]);
        }

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $data = file_get_contents(resource_path('views/builder/new-page-blank-template.blade.php'));

        $html = substr($data, 0, MAX_FILE_LIMIT);

        $file = $this->sanitizeFileName($file);

        $disk = public_path('funnelBuilder/' . $funnel->slug . '/');

        if (!file_put_contents($disk . $file, $html)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            return back()->with([
                'type' => 'danger',
                'message' => 'Error saving file  ' . $file . '\nPossible causes are missing write permission or incorrect file path!'
            ]);
        } else {
            $page = FunnelPage::create([
                'user_id' => Auth::user()->id,
                'folder_id' => $funnel->id,
                'name' => $file,
                'title' => ucfirst($request->title),
                'file_location' => config('app.url') . '/funnelBuilder/' . $funnel->slug . '/' . $file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name . ' created.'
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

        $page_name = strtolower(implode('-', explode(' ', $request->file_name)));
        $file = $page_name . '.html';

        if ($page->name != $file) {
            $funnel_page = FunnelPage::where(['folder_id' => $funnel->id, 'name' => $file]);

            if ($funnel_page->exists()) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Page name already exists in this funnel.'
                ]);
            }
        }

        $disk = public_path('funnelBuilder/' . $funnel->slug . '/' . $page->name);
        rename($disk, public_path('funnelBuilder/' . $funnel->slug . '/' . $file));

        //Validate User
        if (request()->hasFile('thumbnail')) {
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpeg,png,jpg',
            ]);

            $filename = request()->thumbnail->getClientOriginalName();
            if ($page->thumbnail) {
                Storage::delete(str_replace("storage", "public", $page->thumbnail));
            }
            request()->thumbnail->storeAs('funnel_page_thumbnails', $filename, 'public');

            $page->update([
                'folder_id' => $funnel->id,
                'name' => $file,
                'title' => ucfirst($request->title),
                'thumbnail' => '/storage/funnel_page_thumbnails/' . $filename,
                'file_location' => config('app.url') . '/funnelBuilder/' . $funnel->slug . '/' . $file
            ]);

            return back()->with([
                'type' => 'success',
                'message' => $page->name . ' updated.'
            ]);
        }

        $page->update([
            'folder_id' => $funnel->id,
            'name' => $file,
            'title' => ucfirst($request->title),
            'file_location' => config('app.url') . '/funnelBuilder/' . $funnel->slug . '/' . $file
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $page->name . ' updated.'
        ]);
    }

    public function funnel_builder_delete_page($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if ($request->delete_field == "DELETE") {
            $idFinder = Crypt::decrypt($id);

            $page = FunnelPage::findorfail($idFinder);
            $funnel = Funnel::findorfail($page->folder_id);

            $disk = public_path('funnelBuilder/' . $funnel->slug . '/' . $page->name);

            File::delete($disk);

            if ($page->thumbnail) {
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

    public function funnel_builder_save_page(Request $request)
    {
        $id = Crypt::decrypt($request->page);
        $page = FunnelPage::find($id);

        $funnel = Funnel::findorfail($page->folder_id);

        define('MAX_FILE_LIMIT', 1024 * 1024 * 2); //2 Megabytes max html file size

        $html = "";

        if (isset($_POST['html'])) {
            $html = substr($_POST['html'], 0, MAX_FILE_LIMIT);
        }

        $disk = public_path('funnelBuilder/' . $funnel->slug . '/' . $page->name);

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
                    if (!$f || $f[0] == '.') {
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
            define('UPLOAD_PATH', $this->sanitizeFileName($_POST['mediaPath']) . '/');
        } else {
            define('UPLOAD_PATH', '/');
        }

        // $destination = UPLOAD_FOLDER . UPLOAD_PATH . '/' . $_FILES['file']['name'];
        $disk = public_path('builder/media/' . $_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $disk);

        if (isset($_POST['onlyFilename'])) {
            echo $_FILES['file']['name'];
        } else {
            echo UPLOAD_PATH . $_FILES['file']['name'];
        }
    }
}
