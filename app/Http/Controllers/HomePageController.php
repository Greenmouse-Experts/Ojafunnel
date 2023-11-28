<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\ContactUs;
use App\Models\Customer;
use App\Models\Newsletter;
use App\Models\OjafunnelNotification;
use App\Models\OjaPlan;
use App\Models\OjaPlanParameter;
use App\Models\OjaPlanInterval;
use App\Models\Page;
use App\Models\Plan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tzsk\Sms\Facades\Sms;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;

class HomePageController extends Controller
{
    //
    public function index()
    {
        return view('frontend.index');
    }

    function redirects() {
        $user = Auth::user()->id;
        $username = User::where('id', $user)->value('username');
        $js = "<script>";
        $js .= "alert(\"This page has been disabled by the admin, try again later\");";
        $js .= "window.location = `/$username/dashboard/`;";
        $js .= "</script>";
        return $js;
    }

    public function site_features_settings($page_name){
        $site_features = \App\Models\SiteFeature::where('features', $page_name)->where('status', 'disabled')->first();
        return $site_features;
    }
    public function user_site_features_settings($page_name){
        $feature_access = explode(",", Auth::user()->feature_access);
        $user_site_features = \App\Models\SiteFeature::whereIN('id', $feature_access)->pluck('id')->toArray();
        $m=0;
        if(count($user_site_features) > 0){
            $m=0;
            foreach($user_site_features as $user_site_feature){
                $isDisabled = \App\Models\SiteFeature::where('id', $user_site_feature)->where('features', $page_name)->first();
                if($isDisabled){
                    $m+=1;
                }
            }
        }
        return $m;
    }

    public function subscribe_newsletter(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'email' => 'required|email|unique:newsletters',
        ],[
            'email.unique' => 'Sorry! You have already subscribed.',
        ]);

        Newsletter::create([
            'email' => $request->email
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Thanks For Subscribing.'
        ]);
    }
    //  Faqs
    public function faqs()
    {
        return view('frontend.faqs');
    }

    //  Pring
    public function pricing()
    {
        $ojaplans = [];
        $plans = OjaPlan::all();

        foreach($plans as $plan)
        {
            $plan->parameter = OjaPlanParameter::where(['plan_id' => $plan->id])->first();
            $plan->interval = OjaPlanInterval::where(['plan_id' => $plan->id])->get();

            array_push($ojaplans, $plan);
        }

        $headprices = [];

        foreach( $ojaplans as $ojplan )
        {
            array_push($headprices, (object) [
                'name' => $ojplan->name,
                'interval' => $ojplan->interval
            ]);
        }

        $sms = [];
        foreach( $ojaplans as $ojplan )
        {
            $parasm = (int) $ojplan->parameter->sms_automation;

            array_push($sms, (object) [
                'sms' => ($parasm > 0) ? true : false
            ]);
        }

        $whatsapp = [];
        foreach( $ojaplans as $ojplan )
        {
            $wa_auto = (int) $ojplan->parameter->whatsapp_automation;
            $wa_numb = (int) $ojplan->parameter->wa_number;

            array_push($whatsapp, (object) [
                'wa_auto' => $wa_auto,
                'wa_numb' => $wa_numb,
            ]);
        }

        $pagebuilder = [];
        foreach( $ojaplans as $ojplan )
        {
            $pb = (int) $ojplan->parameter->page_builder;
            array_push($pagebuilder, $pb);
        }

        $fbuilder = [];
        foreach( $ojaplans as $ojplan )
        {
            $pb = (int) $ojplan->parameter->funnel_builder;
            array_push($fbuilder, $pb);
        }

        $lms = [];
        foreach( $ojaplans as $ojplan )
        {
            $str = (int) $ojplan->parameter->store;
            array_push($lms, $str);
        }

        $products = [];
        foreach( $ojaplans as $ojplan )
        {
            $prd = (int) $ojplan->parameter->products;
            array_push($products, $prd);
        }

        return view('frontend.pricing', [
            'plans' => $ojaplans,
            'headprices' => $headprices,
            'sms' => $sms,
            'whatsapp' => $whatsapp,
            'pagebuilder' => $pagebuilder,
            'funnelbuilder' => $fbuilder,
            'lms' => $lms,
            'products' => $products
        ]);


    }

    // Contact-Us
    public function contact()
    {
        return view('frontend.contact');
    }

    public function magic_login_link(Request $request, $id){
        $login_magic = User::whereRaw("sha1(id)='$id'")->first();
        if($login_magic){
            Auth::guard("web")->login($login_magic);
            if ($login_magic->status == 'inactive') {
                Auth::logout();
                return back()->with([
                    'type' => 'danger',
                    'message' => 'Account inactive, please contact administrator.'
                ]);
            }
            if ($login_magic->user_type == 'User') {
                return redirect()->route('user.dashboard', $login_magic->username);
            }
            Auth::logout();
            return back()->with([
                'type' => 'danger',
                'message' => 'You are not a User.'
            ]);
        }
        Auth::logout();
        return redirect('/login')->with([
            'type' => 'danger',
            'message' => 'Invalid link or link has expired'
        ]);
    }

    // Login
    public function login()
    {
        Auth::logout();

        return view('auth.login');
    }
    // Sign Up
    public function signup()
    {
        $customer = Customer::newCustomer();
        $user = new User();
        if (request()->has('ref')) {
            session(['referrer' => request()->query('ref')]);
        }

        $referrer = User::whereaffiliate_link(session()->pull('referrer'))->first();

        $referrer_id = $referrer ? $referrer->affiliate_link : null;

        $tz = \App\Library\Tool::getTimezoneSelectOptions();

        $new = [
            'value' => 'Africa/Lagos',
            'text'  => '(GMT+01:00) Africa/Lagos'
        ];

        array_unshift($tz, $new);

        return view('auth.signup', compact('referrer_id', 'customer', 'user', 'tz'));
    }
    // Email Verification
    public function emailverification()
    {
        return view('auth.emailverification');
    }
    // Forgot
    public function forgot()
    {
        return view('auth.forgot');
    }
    // ResetPassword
    public function resetpassword()
    {
        return view('auth.reset');
    }
    // Market Automation
    public function marketauto()
    {
        return view('frontend.marketauto');
    }
    // Pgae Builder
    public function pagebuilder()
    {
        return view('frontend.pagebuilder');
    }
    // Privacy
    public function privacy()
    {
        return view('frontend.privacy');
    }
    // Terms
    public function terms()
    {
        return view('frontend.terms');
    }
    // EmailMarketing
    public function emailmarketing()
    {
        return view('frontend.emailmarketing');
    }
    // Chat Automation
    public function chatautomation()
    {
        return view('frontend.chatautomation');
    }
    // Ecommerce
    public function ecommerce()
    {
        return view('frontend.Ecommerce');
    }

    public function magic_link(){
        return 344;
    }
    // Funnel Builder
    public function funnelbuilder()
    {
        return view('frontend.FunnelBuilder');
    }

    // Affiliate Marketing
    public function affiliate()
    {
        return view('frontend.AffiliateMarketing');
    }

    // Integration
    public function integrations()
    {
        return view('frontend.Integration');
    }

    // Template Design
    public function template()
    {
        return view('frontend.template');
    }

    public function template_details($id)
    {
        $idFinder = Crypt::decrypt($id);
        $page = Page::find($idFinder);

        return view('frontend.templateDetail', [
            'page' => $page
        ]);
    }
    // See Demo
    public function demo()
    {
        return view('frontend.SeeDemo');
    }
    public function test()
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://9r3xk3.api.infobip.com/sms/2/text/advanced',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"messages":[{"destinations":[{"to":"08161215848"}],"from":"Ojafunnel","text":"This is a sample message"}]}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: {3e299022a25c9eb6c26d79bc0850dca3-39356585-14ef-4e9b-8e89-23ea015a616c}',
                    'Content-Type: application/json',
                    'Accept: application/json'
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);
    }

    public function store_cart_details_tmp(Request $request){
        // store temporary user details on the database incase they didnt purchase, we will have to remind them
        // delete back this if they have made payment
        session()->put('customer_email', request()->customer_email);
        $temp_carts = \App\Models\TempCart::create([
            'email' => request()->customer_email,
            'product_id' => request()->product_id,
            'product_type' => request()->product_type,
        ]);
    }


    public function access_course(Request $request){
        $user_email = session()->get('email');
        $user_order_no = session()->get('order_no');
        $auth_details = \App\Models\Enrollment::whereRaw("md5(email) = '$user_email' AND md5(order_no) = '$user_order_no'")->first();
        $data['auths'] = 0;

        if($auth_details){
            $course_id = \App\Models\ShopOrder::where('enrollment_id', $auth_details->id)->value('course_id');
            $course = \App\Models\Course::where('id', $course_id)->first();
            if($course){
                $data['auths'] = 1;
                $data['course'] = $course;
                $data['username'] = $user_email;

                $all_lessions = [];

                // get the course sections in sequence
                $course_sections = \App\Models\Section::where(['course_id' => $course->id])->get();

                // get videos based on the sections serially
                foreach($course_sections as $section) {
                    $courses = \App\Models\Lesson::where(['section_id' => $section->id])->get()->toArray();
                    array_push($all_lessions, ...$courses);
                }

                $candidate_progress = \App\Models\CourseVideoProgress::where([
                    'candidate' => session()->get('email'),
                    'course_id' => $course->id,
                ])->get();

                $all = sizeof($all_lessions);
                $pro = sizeof($candidate_progress);

                $per = ($pro/$all) * 100;
                $data['progress'] = $per;
            }

            $data['quizzes'] = \App\Models\LmsQuiz::where('course_id', $course_id)->get();
        }

        return view('frontend.access_course', $data);
    }

    public function access_course_quiz(Request $request, $quizId, $sessionId)
    {
        $user_email = session()->get('email');
        $user_order_no = session()->get('order_no');
        $auth_details = \App\Models\Enrollment::whereRaw("md5(email) = '$user_email' AND md5(order_no) = '$user_order_no'")->first();
        $data['auths'] = 0;

        if(!$auth_details){
            return view('frontend.access_course', $data);
        }

        $quiz = \App\Models\LmsQuiz::where('id', $quizId)->first();
        $data['quiz'] = $quiz;

        $questions = \App\Models\Quiz::where('course_id', $quiz->course_id)->get();

        if(sizeof($questions) > 0) {
            $submittedIndex = $request->sindex ?? 0;
            $data['index'] = $submittedIndex;
            $data['raw'] = sizeof($questions);

            $data['question'] = $questions[$submittedIndex];
        } else {
            return redirect()->back();
        }

        return view('frontend.view_course_quiz', $data);
    }

    public function submit_course_quiz(Request $request, $quizId, $sessionId)
    {
        $user_email = session()->get('email');
        $user_order_no = session()->get('order_no');
        $auth_details = \App\Models\Enrollment::whereRaw("md5(email) = '$user_email' AND md5(order_no) = '$user_order_no'")->first();
        $data['auths'] = 0;

        if(!$auth_details){
            return view('frontend.access_course', $data);
        }

        $quiz = \App\Models\LmsQuiz::where('id', $quizId)->first();
        $questions = \App\Models\Quiz::where('course_id', $quiz->course_id)->get();
        $question = \App\Models\Quiz::where('session', $quiz->session)->first();

        $next = $request->next;
        $question_id = $request->question_id;
        $answer = $request->ans;

        $attendedQuestion = $question;
        $indexSize = sizeof($questions) - 1;

        $status = "Wrong";

        if($attendedQuestion->ans == $answer)
        {
            $status = "Pass";
        }

        $alreadySubmitted = \App\Models\QuizSubmission::where([
            'course_id' => $attendedQuestion->course_id,
            'quiz_id' => $quiz->id,
            'course_id' => $quiz->course_id,
            'session' => $quiz->session,
            'question_id' => $attendedQuestion->id,
        ])->first();

        if(!$alreadySubmitted) {
            \App\Models\QuizSubmission::create([
                'course_id' => $attendedQuestion->course_id,
                'quiz_id' => $quiz->id,
                'course_id' => $quiz->course_id,
                'session' => $quiz->session,
                'question_id' => $attendedQuestion->id,
                'submitted' => $answer,
                'answer' => $attendedQuestion->ans,
                'status' => $status,
                'candidate' => session()->get('email')
            ]);
        }

        if($indexSize > $next) {
            $next = $next + 1;
            return redirect()->route('access_course_quiz', ['quizId' => $quizId, 'sessionId' => $sessionId, 'sindex' => $next]);
        } else {
            // redirect to result page.
            return redirect()->route('course_quiz_result', [
                'quizId' => $quizId,
                'sessionId' => $sessionId
            ]);
        }
    }

    public function course_quiz_result(Request $request, $quizId, $sessionId)
    {
        $user_email = session()->get('email');
        $user_order_no = session()->get('order_no');
        $auth_details = \App\Models\Enrollment::whereRaw("md5(email) = '$user_email' AND md5(order_no) = '$user_order_no'")->first();
        $data['auths'] = 0;

        if(!$auth_details){
            return view('frontend.access_course', $data);
        }

        $quiz = \App\Models\LmsQuiz::where('id', $quizId)->first();
        $questions = \App\Models\Quiz::where('course_id', $quiz->course_id)->get();
        $question = \App\Models\Quiz::where('session', $quiz->session)->first();

        $questions = \App\Models\QuizSubmission::where([
            'course_id' => $question->course_id,
            'quiz_id' => $quiz->id,
            'session' => $quiz->session])
            ->with(['course', 'quiz', 'question'])
            ->get();


        return view('frontend.quiz_result')->with(['questions' => $questions]);
    }

    public function access_auth_course(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'order_no'  => 'required',
        ]);

        $auth_details = \App\Models\Enrollment::where('email', trim($request->email))->where('order_no', trim($request->order_no))->first();

        if($auth_details){
            session()->put('email', md5(trim($request->email)));
            session()->put('order_no', md5(trim($request->order_no)));

            return response()->json([
                'status' => 'success',
                'message' => 'authenticated',
                'data' => ''
            ],200);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid details entered!',
            'data' => ''
        ],200);
    }

    private function checkVideoIndex($lessons, $selectedLessionId)
    {
        $index = -1;
        for($i=0; $i<sizeof($lessons); $i++) {
            $lesson = (object) $lessons[$i];

            if($selectedLessionId == $lesson->id){
                $index = $i;
                break;
            }
        }

        return $index;
    }

    public function checkForCourseEligibility(Request $request)
    {
        $email = $request->email;
        $courseId = $request->courseId;
        $sectionId = $request->sectionId;
        $lessionId = $request->lessonId;

        $all_lessions = [];

        // get the course sections in sequence
        $course_sections = \App\Models\Section::where(['course_id' => $courseId])->get();

        // get videos based on the sections serially
        foreach($course_sections as $section) {
            $courses = \App\Models\Lesson::where(['section_id' => $section->id])->get()->toArray();
            array_push($all_lessions, ...$courses);
        }

        //check the index of the lesson video selected.
        $lession_Index = $this->checkVideoIndex($all_lessions, $lessionId);

        // register if the video selected is the first video of the course.
        if($lession_Index == 0) {
            // check if the course progress has been recorded or not -  then record or update the progress.
            $alreadyRecorded = \App\Models\CourseProgress::where(['candidate' => session()->get('email'),
                'course_id' => $courseId])->first();

            if(!$alreadyRecorded) {
                \App\Models\CourseProgress::create([
                    'candidate' => session()->get('email'),
                    'course_id' => $courseId,
                    'bound' => sizeof($all_lessions),
                    'achieved' => 1,
                ]);

                \App\Models\CourseVideoProgress::create([
                    'candidate' => session()->get('email'),
                    'course_id' => $courseId,
                    'section_id' => $sectionId,
                    'lesson_id' => $lessionId,
                    'time' => '2', //  2mins default -> considerable time.
                    'achieved' => 0
                ]);

                return response()->json(['success' => true, 'message' => 'Course lesson registered successfully'], 200,);
            } else {
                // record the learning progress
                return $this->recordLearningProgress(
                    session()->get('email'),
                    $courseId,
                    $sectionId,
                    $lessionId
                );
            }
        }

        // check if the video is serially selected and record if true.
        $listened_courses = \App\Models\CourseVideoProgress::where([
            'course_id' => $courseId, 'candidate' => session()->get('email')])
            ->get();

        if(sizeof($listened_courses) > 0)
        {
            $last_listened_course = $listened_courses[sizeof($listened_courses) - 1];
            if ($lessionId <= $last_listened_course->lesson_id)
            {
                // record the learning progress
                return $this->recordLearningProgress(
                    session()->get('email'),
                    $courseId,
                    $sectionId,
                    $lessionId
                );
            } else {
                if($last_listened_course->time == $last_listened_course->achieved) {
                    // check if the selected course Id is next video to proceed with.
                    return $this->validateNextLessonVideo($all_lessions, $last_listened_course->lesson_id, $lessionId);
                } else {
                    return response()->json(['success' => false, 'message' => 'Please complete the current lesson video before moving to next.']);
                }
            }

        } else {
            return response()->json(['success' => false, 'message' => 'Please start from the first section of the course video.']);
        }
    }

    private function validateNextLessonVideo($lessons, $currentLessonId, $selectedLessionId)
    {
        $currentIndex = null;
        for($i=0;$i<sizeof($lessons); $i++) {
            $lesson = (object) $lessons[$i];
            if ($lesson->id == $currentLessonId)
            {
                $currentIndex = $i;
                break;
            }
        }

        if($currentIndex == (sizeof($lessons) - 1)) {
            return response()->json(['success' => false, 'message' => 'Current video lesson is the last of video for the course.'], 200);
        }

        $nextLessonVideo = (object) $lessons[$currentIndex + 1];
        if($nextLessonVideo->id == $selectedLessionId)
        {
            $selectedLesson = \App\Models\Lesson::find($selectedLessionId);
            // register video progress
            \App\Models\CourseVideoProgress::create([
                'candidate' => session()->get('email'),
                'course_id' => $selectedLesson->course_id,
                'section_id' => $selectedLesson->section_id,
                'lesson_id' => $selectedLesson->id,
                'time' => '2', //  2mins default -> considerable time.
                'achieved' => 0
            ]);

            return response()->json(['success' => true, 'message' => 'Course lesson registered successfully'], 200);
        } else {
            // wrong selection.
            return response()->json(['success' => false, 'message' => 'Please select the next video.'], 200);
        }
    }

    private function recordLearningProgress($email, $courseId, $sectionId, $lessionId)
    {
        $progress = \App\Models\CourseVideoProgress::where([
            'candidate' => $email,
            'course_id' => $courseId,
            'section_id' => $sectionId,
            'lesson_id' => $lessionId,
        ])->first();

        $time = $progress->time;
        $achieved = $progress->achieved;

        if($achieved == $time) {
            // Course completed
            $progress->update(['achieved' => $achieved]);

            return response()->json(['success' => true, 'message' => 'Video completed']);
        } else {
            // Course incompleted
            $achieved += 0.5;
            $progress->update(['achieved' => $achieved]);

            return response()->json(['success' => true, 'message' => 'Video inprogress']);
        }

    }

    public function generateCertificate(Request $request)
    {
        $courseId = $request->courseId;

        $all_lessions = [];

        // get the course sections in sequence
        $course_sections = \App\Models\Section::where(['course_id' => $courseId])->get();

        // get videos based on the sections serially
        foreach($course_sections as $section) {
            $courses = \App\Models\Lesson::where(['section_id' => $section->id])->get()->toArray();
            array_push($all_lessions, ...$courses);
        }

        $candidate_progress = \App\Models\CourseVideoProgress::where([
            'candidate' => session()->get('email'),
            'course_id' => $courseId,
        ])->get();

        if(sizeof($candidate_progress) == sizeof($all_lessions))
        {
            // candidate has completed the course
            return response()->json(['success' => true, 'message' => 'Certificate issued.']);
        } else {
            // candidate has not completed the course
            return response()->json(['success' => false, 'message' => 'Please complete your courses to be eligible for certificate.']);
        }
    }

    public function issueCertificate(Request $request)
    {

        $courseId = $request->courseId;

        $all_lessions = [];

        // get the course sections in sequence
        $course_sections = \App\Models\Section::where(['course_id' => $courseId])->get();

        // get videos based on the sections serially
        foreach($course_sections as $section) {
            $courses = \App\Models\Lesson::where(['section_id' => $section->id])->get()->toArray();
            array_push($all_lessions, ...$courses);
        }

        $candidate_progress = \App\Models\CourseVideoProgress::where([
            'candidate' => session()->get('email'),
            'course_id' => $courseId,
        ])->get();

        if(sizeof($candidate_progress) == sizeof($all_lessions))
        {
            $user_email = session()->get('email');
            $user_order_no = session()->get('order_no');
            $auth_details = \App\Models\Enrollment::whereRaw("md5(email) = '$user_email' AND md5(order_no) = '$user_order_no'")->first();
            $course = \App\Models\Course::find($courseId);
            $last_progress = $candidate_progress[sizeof($candidate_progress) - 1];

            $data['candidate_name'] = $auth_details->name;
            $data['course_name'] = $course->title;
            $data['completion_date'] = $last_progress->created_at->format('d M, Y');
            return view('frontend.certificate', $data);
        } else {
            abort(404);
        }
    }

    public function contactConfirm(Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'phone' => 'required|numeric',
            // 'g-recaptcha-response' => 'required|captcha'
        ]);

        $contact = ContactUs::create([
            'name' => request()->name,
            'email' => request()->email,
            'phone_number' => request()->phone,
            'subject' => request()->subject,
            'message' => request()->message,
        ]);

        $admin = Admin::latest()->first();

        OjafunnelNotification::create([
            'admin_id' => $admin->id,
            'title' => config('app.name'),
            'body' => $contact->name . ' sent a contact us form.'
        ]);

        $firebaseToken = Admin::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

        $SERVER_API_KEY = config('app.fcm_token');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => config('app.name'),
                "body" => 'Contact form submitted from ' . $contact->name,
                'image' => URL::asset('assets/images/Logo-fav.png'),
            ],
            'vibrate' => 1,
            'sound' => 1
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_exec($ch);

        return back()->with([
            'type' => 'success',
            'message' => 'Form submitted successfully, we will get back to you shortly.'
        ]);
    }
}
