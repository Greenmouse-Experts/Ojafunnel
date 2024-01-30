<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Learn;
use App\Models\Lesson;
use App\Models\OjaPlanParameter;
use App\Models\Requirement;
use App\Models\Section;
use App\Models\Shop;
use App\Models\Video;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class CMSController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function start_course_creation(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string'],
            'category' => ['required', 'string', 'max:255'],
        ]);

        if (Course::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->courses) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access'
            ]);
        }

        $course = Course::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'title' => $request->title
        ]);

        return redirect()->route('user.course.content', [Auth::user()->username, Crypt::encrypt($course->id)]);
    }

    public function save_course($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $course = Course::find($finder);

        $category = Category::find($request->category);

        if ($request->courseUpdate) {
            if ($request->price == null) {
                $price = 0;
            } else {
                $price = $request->price;
            }

            if (request()->hasFile('image')) {
                $this->validate($request, [
                    'image' => 'required|mimes:jpeg,png,jpg',
                ]);
                $filename = request()->image->getClientOriginalName();
                if ($course->image) {
                    Storage::delete(str_replace("storage", "public", $course->image));
                }
                request()->image->storeAs('course_photo', $filename, 'public');

                $course->update([
                    'category_id' => $category->id,
                    'title' => $request->title,
                    'subtitle' => $request->subtitle,
                    'description' => $request->course_description,
                    'language' => $request->language,
                    'level' => $request->level,
                    'price' => $price,
                    'image' => '/storage/course_photo/' . $filename,
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Save successfully.'
                ]);
            }

            $course->update([
                'category_id' => $category->id,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'description' => $request->course_description,
                'language' => $request->language,
                'image' => $request->image,
                'level' => $request->level,
                'price' => $price
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Save successfully.'
            ]);
        }

        //Validate Request
        $this->validate($request, [
            'title' => ['required'],
            'subtitle' => ['required'],
            'course_description' => ['required'],
            'language' => ['required'],
            'level' => ['required'],
            'price' => ['required'],
        ]);

        $course->update([
            'published' => true
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Published successfully.'
        ]);
    }

    public function save_curriculum($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'section_title' => ['required', 'string', 'max:255']
        ]);

        $finder = Crypt::decrypt($id);

        $course = Course::find($finder);

        Section::create([
            'course_id' => $course->id,
            'title' => $request->section_title,
            'objective' => $request->section_objective
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Section save successfully.'
        ]);
    }

    public function action_curriculum($id, Request $request)
    {
        switch ($request->submitbutton) {

            case 'Delete':
                //action save here
                $finder = Crypt::decrypt($id);

                $section = Section::find($finder);

                $lessons = Lesson::where('section_id', $section->id)->get();

                if ($lessons) {
                    foreach ($lessons as $lesson) {
                        $video = Video::where('lesson_id', $lesson->id)->first();
                        $token = explode('/', $video->original_filename);
                        $token2 = explode('.', $token[sizeof($token) - 1]);

                        if ($video->original_filename) {
                            cloudinary()->destroy(config('app.name') . '/' . $token2[0]);
                        }

                        $video->delete();

                        $lesson->delete();
                    }
                }

                $section->delete();

                return back()->with([
                    'type' => 'success',
                    'message' => 'Section deleted successfully.'
                ]);
                break;

            case 'Update':
                //action for save-draft here

                //Validate Request
                $this->validate($request, [
                    'section_title' => ['required', 'string', 'max:255']
                ]);

                $finder = Crypt::decrypt($id);

                $section = Section::find($finder);

                $section->update([
                    'title' => $request->section_title,
                    'objective' => $request->section_objective
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Section updated successfully.'
                ]);
                break;
        }
    }

    public function save_lesson(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'lesson_title' => ['required', 'string', 'max:255'],
            'lesson_duration' => ['required', ], //'numeric'
            'content_type' => ['required', 'string', 'max:255'],
        ]);

        $section = Section::find($request->section_id);

        if ($request->content_type == 'Video') {
            try {
                // $this->validate($request, [
                //     'lesson_video' => [
                //         'required',
                //         File::types(['mp3', 'mp4'])
                //             ->max(100 * 1024),
                //     ],
                // ]);

                $this->validate($request, [
                    'lesson_video' => [
                        'required',
                        'file',
                        'mimes:mp3,mp4',
                        'max:100000', // 100 MB in kilobytes
                    ],
                ]);

                $file = request()->lesson_video->getClientOriginalName();

                $filename = pathinfo($file, PATHINFO_FILENAME);

                try {
                    $response = cloudinary()->uploadFile(
                        $request->file('lesson_video')->getRealPath(),
                        [
                            'folder' => config('app.name'),
                            "public_id" => $filename,
                            "use_filename" => TRUE
                        ]
                    )->getSecurePath();

                } catch (\Exception $e) {
                    // Handle the error appropriately
                    return back()->with([
                        'type' => 'danger',
                        'message' => $e->getMessage()
                    ]);
                }

                $lesson = Lesson::create([
                    'section_id' => $section->id,
                    'course_id' => $section->course_id,
                    'title' => $request->lesson_title,
                    'description' => $request->course_id,
                    'content_type' => $request->content_type,
                    'duration' => $request->lesson_duration,
                ]);

                Video::create([
                    'lesson_id' => $lesson->id,
                    'original_filename' => $response
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Lesson save successfully.'
                ]);
            } catch (Exception $e) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'File size should not be greater than 100MB.'
                ]);
            }
        } elseif ($request->content_type == 'Youtube') {
            $this->validate($request, [
                'lesson_youtube' => ['required', 'string', 'max:255'],
            ]);

            $lesson = Lesson::create([
                'section_id' => $section->id,
                'course_id' => $section->course_id,
                'title' => $request->lesson_title,
                'description' => $request->course_id,
                'content_type' => $request->content_type,
                'duration' => $request->lesson_duration,
            ]);

            Video::create([
                'lesson_id' => $lesson->id,
                'youtube_link' => $request->lesson_youtube
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Lesson save successfully.'
            ]);
        } else {
            return back()->with([
                'type' => 'success',
                'message' => "Content type doesn't exist on our database."
            ]);
        }
    }

    public function update_lesson($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'code' => ['required', 'string'],
            'percent' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'expires' => ['required', 'date'],
        ]);

        $finder = Crypt::decrypt($id);

        $coupon = Coupon::find($finder);

        $coupon->update([
            'code' => $request->code,
            'percent' => $request->percent,
            'quantity' => $request->quantity,
            'expires' => $request->expires
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Updated successfully.'
        ]);
    }

    public function delete_lesson($id)
    {
        $finder = Crypt::decrypt($id);

        $lesson = Lesson::findorfail($finder);

        $video = Video::where('lesson_id', $lesson->id)->first();
        $token = explode('/', $video->original_filename);
        $token2 = explode('.', $token[sizeof($token) - 1]);

        if ($video->original_filename) {
            cloudinary()->destroy(config('app.name') . '/' . $token2[0]);
        }

        $video->delete();

        $lesson->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Lesson deleted successfully.'
        ]);
    }

    public function save_requirement($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'description' => ['required', 'string']
        ]);

        $finder = Crypt::decrypt($id);

        $course = Course::find($finder);

        Requirement::create([
            'course_id' => $course->id,
            'description' => $request->description,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Save successfully.'
        ]);
    }

    public function delete_requirement($id)
    {
        $finder = Crypt::decrypt($id);

        Requirement::find($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Requirement deleted successfully.'
        ]);
    }

    public function save_what_to_learn($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'description' => ['required', 'string']
        ]);

        $finder = Crypt::decrypt($id);

        $course = Course::find($finder);

        Learn::create([
            'course_id' => $course->id,
            'description' => $request->description,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Save successfully.'
        ]);
    }

    public function delete_what_to_learn($id)
    {
        $finder = Crypt::decrypt($id);

        Learn::find($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Outline deleted successfully.'
        ]);
    }


    public function save_coupon($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'code' => ['required', 'string'],
            'percent' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'expires' => ['required', 'date'],
        ]);

        $finder = Crypt::decrypt($id);

        $course = Course::find($finder);

        Coupon::create([
            'course_id' => $course->id,
            'code' => $request->code,
            'percent' => $request->percent,
            'quantity' => $request->quantity,
            'expires' => $request->expires
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Save successfully.'
        ]);
    }

    public function update_coupon($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'code' => ['required', 'string'],
            'percent' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'expires' => ['required', 'date'],
        ]);

        $finder = Crypt::decrypt($id);

        $coupon = Coupon::find($finder);

        $coupon->update([
            'code' => $request->code,
            'percent' => $request->percent,
            'quantity' => $request->quantity,
            'expires' => $request->expires
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Updated successfully.'
        ]);
    }

    public function delete_coupon($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if ($request->delete_field == "DELETE") {
            $finder = Crypt::decrypt($id);

            Coupon::find($finder)->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Coupon deleted successfully.'
            ]);
        }

        return back()->with([
            'type' => 'danger',
            'message' => "Field doesn't match, Try Again!"
        ]);
    }

    public function create_shop(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:shops|max:255',
                'description' => 'required',
                'link' => 'required',
                'logo' => 'required|mimes:jpeg,png,jpg',
                'currency' => 'required',
                'currency_sign' => 'required',
            ],
            [
                'name.unique' => 'Shop name has already been taken, please use another one!',
            ]
        );

        if (Shop::where('user_id', Auth::user()->id)->get()->count() >= OjaPlanParameter::find(Auth::user()->plan)->shop) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upgrade to enjoy more access'
            ]);
        }

        $shops = Shop::latest()->where('user_id', Auth::user()->id)->get();

        if ($shops->isEmpty()) {

            if ($request->primaryColor == '#000000') {
                $request->validate(
                    [
                        'theme' => 'required'
                    ]
                );
                $filename = request()->logo->getClientOriginalName();
                request()->logo->storeAs('courseShopLogo', $filename, 'public');

                Shop::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'link' => $request->link,
                    'logo' => '/storage/courseShopLogo/' . $filename,
                    'theme' => $request->theme,
                    'color' => '#fff',
                    'user_id' => Auth::user()->id,
                    'currency' => $request->currency,
                    'currency_sign' => $request->currency_sign
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => $request->name . ' shop created successfully'
                ]);
            } else {
                $filename = request()->logo->getClientOriginalName();
                request()->logo->storeAs('courseShopLogo', $filename, 'public');

                Shop::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'link' => $request->link,
                    'logo' => '/storage/courseShopLogo/' . $filename,
                    'theme' => $request->primaryColor,
                    'color' => '#fff',
                    'user_id' => Auth::user()->id,
                    'currency' => $request->currency,
                    'currency_sign' => $request->currency_sign
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => $request->name . ' shop created successfully'
                ]);
            }
        } else {
            foreach ($shops as $shop) {
                $user_id[] = $shop->user_id;
            }
            if (in_array(Auth::user()->id, $user_id)) {

                return back()->with([
                    'type' => 'danger',
                    'message' => 'You already have a shop.'
                ]);
            } else {
                if ($request->primaryColor == '#000000') {
                    $request->validate(
                        [
                            'theme' => 'required'
                        ]
                    );
                    $filename = request()->logo->getClientOriginalName();
                    request()->logo->storeAs('courseShopLogo', $filename, 'public');

                    Shop::create([
                        'name' => $request->name,
                        'description' => $request->description,
                        'link' => $request->link,
                        'logo' => '/storage/courseShopLogo/' . $filename,
                        'theme' => $request->theme,
                        'color' => '#fff',
                        'user_id' => Auth::user()->id,
                        'currency' => $request->currency,
                        'currency_sign' => $request->currency_sign
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => $request->name . ' shop created successfully'
                    ]);
                } else {
                    $filename = request()->logo->getClientOriginalName();
                    request()->logo->storeAs('courseShopLogo', $filename, 'public');

                    Shop::create([
                        'name' => $request->name,
                        'description' => $request->description,
                        'link' => $request->link,
                        'logo' => '/storage/courseShopLogo/' . $filename,
                        'theme' => $request->primaryColor,
                        'color' => '#fff',
                        'user_id' => Auth::user()->id,
                        'currency' => $request->currency,
                        'currency_sign' => $request->currency_sign
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => $request->name . ' shop created successfully'
                    ]);
                }
            }
        }
    }

    public function update_shop(Request $request)
    {
        $shop = Shop::findOrFail($request->id);

        if ($request->name == $shop->name) {
            $request->validate(
                [
                    'description' => 'required',
                    'currency' => 'required',
                    'currency_sign' => 'required',
                ]
            );

            if ($request->primaryColor == '#000000') {
                if (request()->hasFile('logo')) {
                    $this->validate($request, [
                        'logo' => 'required|mimes:jpeg,png,jpg',
                    ]);

                    $filename = request()->logo->getClientOriginalName();
                    if ($shop->logo) {
                        Storage::delete(str_replace("storage", "public", $shop->logo));
                    }
                    request()->logo->storeAs('courseShopLogo', $filename, 'public');

                    $shop->update([
                        'description' => $request->description,
                        'logo' => '/storage/courseShopLogo/' . $filename,
                        'theme' => $request->theme,
                        'color' => '#fff',
                        'currency' => $request->currency,
                        'currency_sign' => $request->currency_sign
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => $request->name . ' shop updated successfully.'
                    ]);
                }

                $shop->update([
                    'description' => $request->description,
                    'theme' => $request->theme,
                    'color' => '#fff',
                    'currency' => $request->currency,
                    'currency_sign' => $request->currency_sign
                ]);
            } else {
                if (request()->hasFile('logo')) {
                    $this->validate($request, [
                        'logo' => 'required|mimes:jpeg,png,jpg',
                    ]);

                    $filename = request()->logo->getClientOriginalName();
                    if ($shop->logo) {
                        Storage::delete(str_replace("storage", "public", $shop->logo));
                    }
                    request()->logo->storeAs('courseShopLogo', $filename, 'public');

                    $shop->update([
                        'description' => $request->description,
                        'logo' => '/storage/courseShopLogo/' . $filename,
                        'theme' => $request->primaryColor,
                        'color' => '#fff',
                        'currency' => $request->currency,
                        'currency_sign' => $request->currency_sign
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => $request->name . ' shop updated successfully.'
                    ]);
                }

                $shop->update([
                    'description' => $request->description,
                    'theme' => $request->primaryColor,
                    'color' => '#fff',
                    'currency' => $request->currency,
                    'currency_sign' => $request->currency_sign
                ]);
            }

            return back()->with([
                'type' => 'success',
                'message' => $request->name . ' shop updated successfully.'
            ]);
        } else {
            $request->validate(
                [
                    'name' => 'required|unique:shops|max:255',
                    'description' => 'required',
                    'link' => 'required',
                    'currency' => 'required',
                    'currency_sign' => 'required',
                ],
                [
                    'name.unique' => 'Shop name has already been taken, please use another one!',
                ]
            );

            if ($request->primaryColor == '#000000') {
                if (request()->hasFile('logo')) {
                    $this->validate($request, [
                        'logo' => 'required|mimes:jpeg,png,jpg',
                    ]);

                    $filename = request()->logo->getClientOriginalName();
                    if ($shop->logo) {
                        Storage::delete(str_replace("storage", "public", $shop->logo));
                    }
                    request()->logo->storeAs('courseShopLogo', $filename, 'public');

                    $shop->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'link' => $request->link,
                        'logo' => '/storage/courseShopLogo/' . $filename,
                        'theme' => $request->theme,
                        'color' => '#fff',
                        'currency' => $request->currency,
                        'currency_sign' => $request->currency_sign
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => $request->name . ' shop updated successfully.'
                    ]);
                }

                $shop->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'link' => $request->link,
                    'theme' => $request->theme,
                    'color' => '#fff',
                    'currency' => $request->currency,
                    'currency_sign' => $request->currency_sign
                ]);
            } else {
                if (request()->hasFile('logo')) {
                    $this->validate($request, [
                        'logo' => 'required|mimes:jpeg,png,jpg',
                    ]);

                    $filename = request()->logo->getClientOriginalName();
                    if ($shop->logo) {
                        Storage::delete(str_replace("storage", "public", $shop->logo));
                    }
                    request()->logo->storeAs('courseShopLogo', $filename, 'public');

                    $shop->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'link' => $request->link,
                        'logo' => '/storage/courseShopLogo/' . $filename,
                        'theme' => $request->primaryColor,
                        'color' => '#fff',
                        'currency' => $request->currency,
                        'currency_sign' => $request->currency_sign
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => $request->name . ' shop updated successfully.'
                    ]);
                }

                $shop->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'link' => $request->link,
                    'theme' => $request->primaryColor,
                    'color' => '#fff',
                    'currency' => $request->currency,
                    'currency_sign' => $request->currency_sign
                ]);
            }

            return back()->with([
                'type' => 'success',
                'message' => $request->name . ' shop updated successfully.'
            ]);
        }
    }

    public function delete_shop(Request $request)
    {
        $shop = Shop::findOrFail($request->id);

        if ($shop->logo) {
            Storage::delete(str_replace("storage", "public", $shop->logo));
        }

        $shop->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Shop deleted successfully'
        ]);
    }
}
