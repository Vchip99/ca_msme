<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MsmeRegistration;
use App\Models\Payment;
use Validator,DB, File,Session,Redirect,Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Mail\RegistrationCompeleted;
use App\Mail\PaymentReceived;
use Illuminate\Support\Facades\Mail;

class MsmeController extends Controller
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

    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validateMsmeRegistration = [
        'adhaar_number' => 'required',
        'adhaar_name' => 'required',
        'application_category' => 'required',
        'gender' => 'required',
        'disability' => 'required',
        'enterprise_name' => 'required',
        'organisation_type' => 'required',
        'pan_no' => 'required',
        'building_no' => 'required',
        'floor_no' => 'required',
        'building_name' => 'required',
        'street' => 'required',
        'city' => 'required',
        'pin' => 'required',
        'state' => 'required',
        'district' => 'required',
        'is_same_address' => 'required',
        'mob_no' => 'required',
        'email' => 'required',
        'business_start_date' => 'required',
        'account_no' => 'required',
        'ifsc' => 'required',
        'business_activity' => 'required',
        'nic2_digit_code' => 'required',
        'employees' => 'required',
        'investment_amount' => 'required',
    ];


    protected function create(){
        $msmePrice = MsmeRegistration::$msmePrice;
        return view('msme.msme_registration', compact('msmePrice'));
    }

    protected function store(Request $request){
        $v = Validator::make($request->all(), $this->validateMsmeRegistration);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        DB::beginTransaction();
        try
        {
            $newMsmeRegistration = MsmeRegistration::addOrUpdateMsmeRegistration($request);
            if(!is_object($newMsmeRegistration)){
                DB::rollback();
                return back()->withErrors('something went wrong.');
            }
            DB::commit();
            $orderId = $newMsmeRegistration->order_id;
            $data['service'] = 'MSME';
            $data['order_id'] = $orderId;
            // send mail to user after new registration
            Mail::to($request->email)->send(new RegistrationCompeleted($data));
            $phone = $newMsmeRegistration->mob_no;
            $email = $newMsmeRegistration->email;
            $servicePrice = MsmeRegistration::$msmePrice;
            Session::put('order_id', $orderId);
            Session::put('service_price', $servicePrice);
            Session::save();
            $purpose = substr($orderId.':'.$servicePrice, 0, 29);
            $name = substr($newMsmeRegistration->adhaar_name, 0, 29);
            if('local' == \Config::get('app.env')){
                $api = new Instamojo('4a6718254b142b18f154158d73ec5e51', '370f403cdfc0a5f12eb6395f110b8da9','https://test.instamojo.com/api/1.1/');
            } else {
                $api = new Instamojo('4c7a535ff5b55a6145826686dc262792', 'd4eeb70cbc4e47f65f304f83eed6c205','https://www.instamojo.com/api/1.1/');
            }

            try {
                $response = $api->paymentRequestCreate(array(
                    "purpose" => trim($purpose),
                    "amount" => $servicePrice,
                    "buyer_name" => $name,
                    "phone" => $phone,
                    "send_email" => true,
                    "send_sms" => false,
                    "email" => $email,
                    'allow_repeated_payments' => false,
                    "redirect_url" => url('thankyouMsmeRegistration'),
                    "webhook" => url('webhookMsmeRegistration')
                    ));

                $pay_ulr = $response['longurl'];
                header("Location: $pay_ulr");
                exit();
            }
            catch (Exception $e) {
                return redirect('registration')->withErrors([$e->getMessage()]);
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong while msme registration.');
        }
        return Redirect::to('registration');
    }

    protected function thankyouMsmeRegistration(Request $request){
        if('local' == \Config::get('app.env')){
            $api = new Instamojo('4a6718254b142b18f154158d73ec5e51', '370f403cdfc0a5f12eb6395f110b8da9','https://test.instamojo.com/api/1.1/');
        } else {
            $api = new Instamojo('4c7a535ff5b55a6145826686dc262792', 'd4eeb70cbc4e47f65f304f83eed6c205','https://www.instamojo.com/api/1.1/');
        }

        $payid = $request->get('payment_request_id');

        try {
            $response = $api->paymentRequestStatus($payid);

            if( 'Credit' == $response['payments'][0]['status']){
                // create a client
                $paymentRequestId = $response['id'];
                $paymentId = $response['payments'][0]['payment_id'];
                $name = $response['payments'][0]['buyer_name'];
                $email = $response['payments'][0]['buyer_email'];
                $amount = $response['payments'][0]['amount'];
                $status = 'Paid';

                $orderId = Session::get('order_id');
                $servicePrice = Session::get('service_price');

                DB::beginTransaction();
                try
                {
                    $paymentArray = [
                                        'order_id' => $orderId,
                                        'service_price' => $servicePrice,
                                        'payment_id' => $paymentId,
                                        'payment_request_id' => $paymentRequestId,
                                        'status' => $status,
                                        'done_by' => 'instamojo',
                                    ];
                    Payment::addPayment($paymentArray);
                    MsmeRegistration::changeOrderStatusByOrderIdByStatusId($orderId, 2);
                    MsmeRegistration::changePaymentStatusByOrderIdByPaymentStatus($orderId, 'Paid');
                    DB::commit();
                    $subject = 'Transaction Alert: msme-online.org for '.$orderId.' is successful';
                    $message = "<h1>Dear ".$name."</h1></br>";
                    $message .= "Transaction of Rs.".$amount." on dated ".date('d-m-Y h:i:s')." has been processed successfully.";
                    $message .= "<hr>";
                    $message .= "<h1>Payment Details</h1>";
                    $message .= '<p><b>Payment Id:</b> '.$paymentId.'</p>';
                    $message .= '<p><b>Payment Status:</b> '.$status.'</p>';
                    $message .= '<p><b>Amount:</b> '.$amount.'</p>';
                    $message .= "<p>Thank</p>";
                    $message .= "<p>msme-online.org</p>";

                    $headers  = "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    // send email
                    Mail::to($email)->send(new PaymentReceived($message,$subject));
                }
                catch(Exception $e)
                {
                    DB::rollback();
                    return redirect('/')->withErrors([$e->getMessage()]);
                }
                Session::remove('order_id');
                Session::remove('service_price');
                return redirect('contact-us')->with('message', 'Your request has been submitted.');
            }
            return redirect('registration');
        }
        catch (Exception $e) {
            return redirect('registration')->withErrors([$e->getMessage()]);
        }
    }

    public function webhookMsmeRegistration(Request $request){
        $data = $request->all();
        $mac_provided = $data['mac'];  // Get the MAC from the POST data
        unset($data['mac']);  // Remove the MAC key from the data.
        ksort($data, SORT_STRING | SORT_FLAG_CASE);

        if('local' == \Config::get('app.env')){
            $mac_calculated = hash_hmac("sha1", implode("|", $data), "aa7af601d8f946c49653c14e6d88d6c6");
        } else {
            $mac_calculated = hash_hmac("sha1", implode("|", $data), "e39308a0e531454e97de1c8a158c0719");
        }
        if($mac_provided == $mac_calculated){
            $to = 'support@msme-online.org';
            $subject = 'Service Payment Request ' .$data['buyer_name'].'';
            $message = "<h1>Payment Details</h1>";
            $message .= "<hr>";
            $message .= '<p><b>Payment Id:</b> '.$data['payment_id'].'</p>';
            $message .= '<p><b>Payment Status:</b> '.$data['status'].'</p>';
            $message .= '<p><b>Amount:</b> '.$data['amount'].'</p>';
            $message .= "<hr>";
            $message .= '<p><b>Name:</b> '.$data['buyer_name'].'</p>';
            $message .= '<p><b>Email:</b> '.$data['buyer'].'</p>';
            $message .= "<hr>";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            // send email
            mail($to, $subject, $message, $headers);
        }
    }
}
