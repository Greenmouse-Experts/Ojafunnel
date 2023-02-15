<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class CMSController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function start_course_creation(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string'],
            'category' => ['required', 'string', 'max:255'],
        ]);

        $course = Course::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'title' => $request->title
        ]);

        return redirect()->route('user.course.content', [Auth::user()->username, Crypt::encrypt($course->id)]);
    }

    public function save_course($id, Request $request)
    {
        // dd($request->course_description);

        // switch($request->submitbutton) {

        //     case 'save-draft': 
        //         //action save here
        //         return back()->with([
        //             'type' => 'success',
        //             'message' => 'Saved'
        //         ]);
        //     break;
        
        //     case 'save-review': 
        //         //action for save-draft here
        //         return back()->with([
        //             'type' => 'success',
        //             'message' => 'Confirm'
        //         ]);
        //     break;
        // }

        $finder = Crypt::decrypt($id);

        $course = Course::find($finder);

        $category = Category::find($request->category);

        if($request->price == null)
        {
            $price = 0;
        } else {
            $price = $request->price;
        }

        if (request()->hasFile('image')) 
        {
            $this->validate($request, [
                'image' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->image->getClientOriginalName();
            if($course->image) {
                Storage::delete(str_replace("storage", "public", $course->image));
            }
            request()->image->storeAs('course_photo', $filename, 'public');
            
            $course->update([
                'category_id' => $category->id,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'description' => $request->course_description,
                'language' => $request->language,
                'image' => $request->image,
                'level' => $request->level,
                'currency' => $request->currency,
                'price' => $price,
                'image' => '/storage/course_photo/'.$filename,
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
            'currency' => $request->currency,
            'price' => $price
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Save successfully.'
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

    public function update_curriculum($id, Request $request)
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

    public function delete_curriculum($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if($request->delete_field == "DELETE")
        {
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

    public function save_lesson($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'lesson_title' => ['required', 'string', 'max:255'],
            'lesson_duration' => ['required', 'numeric'],
            'content_type' => ['required', 'string', 'max:255'],
        ]);

        $finder = Crypt::decrypt($id);

        $section = Section::find($finder);

        if($$request->content_type == 'Video')
        {
            // $this->validate($request, [
            //     'lesson_video' => ['required', 'string', 'max:255'],
            // ]);

            // Lesson::create([
            //     'section_id' => $section->id,
            //     'course_id' => $request->course_id,
            //     'title' => $request->lesson_title,
            //     'description' => $request->course_id,
            //     'content_type' => $request->content_type,
            //     'duration' => $request->lesson_duration,
            // ]);

        } elseif($$request->content_type == 'Youtube') 
        {
            $this->validate($request, [
                'lesson_video' => ['required', 'string', 'max:255'],
            ]);

            Lesson::create([
                'section_id' => $section->id,
                'course_id' => $request->course_id,
                'title' => $request->lesson_title,
                'description' => $request->course_id,
                'content_type' => $request->content_type,
                'duration' => $request->lesson_duration,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Section save successfully.'
            ]);
        }

        return back()->with([
            'type' => 'success',
            'message' => 'Section save successfully.'
        ]);
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

    public function delete_lesson($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'delete_field' => ['required', 'string', 'max:255']
        ]);

        if($request->delete_field == "DELETE")
        {
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

        if($request->delete_field == "DELETE")
        {
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
}
