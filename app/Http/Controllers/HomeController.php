<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllRegistration;
use App\Models\MsmeRegistration;
use App\Models\Payment;
use Validator,DB, File,Session,Redirect;
use Intervention\Image\ImageManagerStatic as Image;
use App\Mail\ContactUs;
use App\Mail\SendResume;
use App\Mail\EnquiryEmail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    protected function trackStatus(){
        return view('layouts.track_status');
    }

    protected function showStatus(Request $request){
        $registration = MsmeRegistration::where('order_id', json_decode($request->get('order_id')))->first();

        if(!is_object($registration)){
            return back()->withErrors('Mentioned order id does not exist.please enter correct order id.');
        }
        return view('layouts.show_status', compact('registration'));
    }

    protected function showTrackOrder($orderId){
        $registration = MsmeRegistration::where('order_id', json_decode($orderId))->first();
        if(!is_object($registration)){
            return Redirect::to('/')->withErrors('Mentioned order id does not exist.');
        }
        return view('layouts.show_status', compact('registration'));
    }

    protected function showFaq(){
        return view('layouts.show_faq');
    }

    protected function contactUs(){
        return view('layouts.contact_us');
    }

    protected function sendContactUsEmail(Request $request){
        $data['name'] = $request->get('name');
        $data['email'] = $request->get('email');
        $data['user_message'] = $request->get('message');
        // send mail
        Mail::to('contactus@msme-online.org')->send(new ContactUs($data));
        return Redirect::to('contact-us')->with('message', 'Thanks for email. we will contact you asap.');
    }

    protected function career(){
        return view('layouts.career');
    }

    protected function sendResume(Request $request){
        // send mail
        Mail::to('contactus@msme-online.org')->send(new SendResume($request));
        return Redirect::to('career')->with('message', 'Thanks for resume. we will contact you asap.');
    }

    protected function termsAndConditions(){
        return view('layouts.terms_conditions');
    }

    protected function privacyPolicy(){
        return view('layouts.policies');
    }

    protected function disclaimerPolicy(){
        return view('layouts.disclaimer');
    }

    protected function refundPolicy(){
        return view('layouts.refund');
    }

    protected function aboutUs(){
        return view('layouts.about-us');
    }

    protected function enquiryEmail(Request $request){
        $data['name'] = $request->get('name');
        $data['email'] = $request->get('email');
        $data['mobile'] = $request->get('mobile');
        // send mail
        Mail::to('contactus@msme-online.org')->send(new EnquiryEmail($data));
        return Redirect::to('/')->with('message', 'Thanks for enquiry. we will contact you asap.');
    }

}
