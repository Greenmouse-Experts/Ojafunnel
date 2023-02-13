<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
}
