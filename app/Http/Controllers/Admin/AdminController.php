<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use App\Models\MsmeRegistration;
use App\Models\Payment;
use App\Libraries\InputSanitise;
use Auth,Hash,Session,Redirect,Validator,DB;
use Excel;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    protected function home(){

        $loginUser = Auth::guard('admin')->user();
        if(1 == $loginUser->is_subadmin){
            $allRegistrations = MsmeRegistration::where('application_status', '<', 5)->where('assigned_sub_admin', $loginUser->id)->orderBy('id', 'desc')->get();
            $unCompletedCount = $allRegistrations->count();
        } else {
            $allRegistrations = MsmeRegistration::orderBy('id', 'desc')->get();
            $unCompletedCount = MsmeRegistration::where('application_status', '<', 5)->count();
        }
        $subadmins = Admin::all();
        return view('admin.home', compact('allRegistrations', 'loginUser', 'subadmins', 'unCompletedCount'));
    }

    protected static function enquiry($orderId){
        $registeredRecord = MsmeRegistration::where('order_id', json_decode($orderId))->first();
        if(!is_object($registeredRecord)){
            return back()->withErrors('something went wrong.');
        }
        if('Manufacturer' == $registeredRecord->business_activity){
            $activities = ['01- Crop and animal production, hunting and related service activities','05-Mining and quarring','06-Extraction of crude petroleum and natural gas','07-Mining of metal ores','08-Other mining and quarring','09-Mining support service activities','10-Manufacture of food products','11-Manufacture of beverages','12-Manufacture of tobacco products','13-Manufacture of textiles','14-Manufacture of wearing apparel','15-Manufacture of leather and related products','16-Manufacture of wood and products of wood and cork, except furniture; manufacture of articles of straw and plaiting materials','17-Manufacture of paper and paper products','18-Printing and reproduction of recorded media','19-Manufacture of coke and refined petroleum products','20-Manufacture of chemicals and chemical products','21-Manufacture of pharmaceuticals, medicinal chemical and botanical products','22-Manufacture of rubber and plastics products','23-Manufacture of other non-metallic mineral products','24-Manufacture of basic metals','25-Manufacture of fabricated metal products, except machinery and equipment','26-Manufacture of computer, electronic and optical products','27-Manufacture of electrical equipment','28-Manufacture of machinery and equipment n.e.c.','29-Manufacture of motor vehicles, trailers and semi-trailers','30-Manufacture of other transport equipment','31-Manufacture of furniture','32-Other manufacturing','33-Repair and installation of machinery and equipment','35-Electricity, gas, steam and air conditioning supply','36-Water collection, treatment and supply','37-Sewerage','38-Waste collection, treatment and disposal activities; materials recovery','39-Remediation activities and other waste management services','41-Construction of building','42-Civil Engineering','43-Specialized construction activities'];
        } else {
            $activities = ['49-Land transport and transport via pipelines','50-Water transport','51-Air Transport','52-Warehousing and support activities for transportation','53-Postal and courier activities','55-Accommodation','56-Food and beverage service activities','58-Publishing activities','59-Motion picture, video and television programme production, sound recording  and music publishing activities','60-Broadcasting and programming activities','61-Telecommunications','62-Computer programming, consultancy and related activities','63-Information service activities','64-Financial service activities, except insurance and pension funding','65-Insurance, reinsurance and pension funding, except compulsory social security','66-Other financial activities','68-Real estate activities','69-Legal and accounting activities','70-Activities of head offices; management consultancy activities','71-Architecture and engineering activities; technical testing and analysis','72-Scientific research and development','73-Advertising and market research','74-Other professional, scientific and technical activities','75-Veterinary activities','77-Rental and leasing ctivities','78-Employment activities','79-Travel agency, tour operator and other reservation service activities','80-Security and investigation activities','81-Services to buildings and landscape activities','82-Office administrative, office support and other business support activities','84-Public administration and defence; compulsory social security','85-Education','86-Human health activities','87-Residential care activities','88-Social work activities without accommodation','90-Creative, arts and entertainment activities','91-Libraries, archives, museums and other cultural activities','92-Gambling and betting activities','93-Sports activities and amusement and recreation activities','94-Activities of membership organizations','95-Repair of computers and personal and household goods','96-Other personal service activities'];
        }
        // dd($activities);
        return view('admin.enquiry.msme_enquiry', compact('registeredRecord','activities'));
    }

    protected static function msmeUpdate(Request $request){
        DB::beginTransaction();
        try
        {
            $orderId = $request->order_id;
            MsmeRegistration::addOrUpdateMsmeRegistration($request, true);
            DB::commit();
            return Redirect::to('admin/home')->with('message', 'msme record updated successfully');
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return Redirect::to('admin/home')->withErrors('something went wrong.');
        }
        return Redirect::to('admin/home');
    }

    /**
     * delete registered record
     */
    protected function deleteOrder(Request $request){
        $orderId = strip_tags(trim($request->get('order_id')));
        if(isset($orderId)){
            DB::beginTransaction();
            try
            {
                $registeredOrder = MsmeRegistration::where('order_id', json_decode($orderId))->first();
                if(is_object($registeredOrder)){
                    $path = 'documents/'.$orderId;
                    InputSanitise::delFolder($path);
                    Payment::deleteRecordByOrderId($orderId);
                    $registeredOrder->delete();
                    DB::commit();
                    return Redirect::to('admin/home')->with('message', 'Registered order deleted successfully!');
                }
            }
            catch(\Exception $e)
            {
                DB::rollback();
                return Redirect::to('admin/home')->withErrors('something went wrong.');
            }
        }
        return Redirect::to('admin/home');
    }


    protected function changeOrderStatus(Request $request){
        $orderId = strip_tags(trim($request->get('order_id')));
        $applicationStatus = strip_tags(trim($request->get('application_status')));
        if(!empty($orderId) && !empty($applicationStatus)){
            DB::beginTransaction();
            try
            {
                $registeredRecord = MsmeRegistration::changeOrderStatusByOrderIdByStatusId($orderId, $applicationStatus);
                if(is_object($registeredRecord)){
                    DB::commit();
                    return Redirect::to('admin/home')->with('message', 'Order Status changed successfully!');
                }
            }
            catch(\Exception $e)
            {
                DB::rollback();
                return Redirect::to('admin/home')->withErrors('something went wrong.');
            }
        }
        return Redirect::to('admin/home');
    }

    protected function changePaymentStatus(Request $request){
        $orderId = strip_tags(trim($request->get('order_id')));
        $paymentStatus = strip_tags(trim($request->get('payment_status')));
        if(!empty($orderId) && !empty($paymentStatus)){
            DB::beginTransaction();
            try
            {
                $registeredRecord = MsmeRegistration::changePaymentStatusByOrderIdByPaymentStatus($orderId, $paymentStatus);
                if(is_object($registeredRecord)){
                    $newPayment = Payment::changeOrderPaymentStatus($registeredRecord->order_id);
                    if(is_object($newPayment)){
                        DB::commit();
                        return Redirect::to('admin/home')->with('message', 'Payment Status changed successfully!');
                    }
                }
            }
            catch(\Exception $e)
            {
                DB::rollback();
                return Redirect::to('admin/home')->withErrors('something went wrong.');
            }
        }
        return Redirect::to('admin/home');
    }

    protected function searchByArr(Request $request){
        $applicationStatus = $request->get('application_status');
        $paymentStatus = $request->get('payment_status');
        $loginUser = Auth::guard('admin')->user();
        $result = DB::table('msme_registrations')->select('msme_registrations.*');

        if(!empty($applicationStatus) && 'All' != $applicationStatus){
            $result->where('msme_registrations.application_status', $applicationStatus);
        }
        if(!empty($paymentStatus) && 'All' != $paymentStatus){
            if('Paid' == $paymentStatus){
                $result->where('msme_registrations.payment_status', $paymentStatus);
            } else {
                $result->where('msme_registrations.payment_status', NULL);
            }
        }
        if(1 == $loginUser->is_subadmin){
            $finalResults = $result->where('assigned_sub_admin', $loginUser->id)->where('application_status', '<', 5)->orderBy('id', 'desc')->get();
        } else {
            $finalResults = $result->orderBy('id', 'desc')->get();
        }
        $allRecords = [];
        $searchResult = [];
        if(is_object($finalResults) && false == $finalResults->isEmpty()){
            $index = 1;
            foreach($finalResults as $finalResult){
                $allRecords[$index]['order_id'] = $finalResult->order_id;
                $allRecords[$index]['created_at'] = date('Y-m-d', strtotime($finalResult->created_at));
                $allRecords[$index]['name'] = $finalResult->adhaar_name;
                $allRecords[$index]['city'] = $finalResult->city;
                $allRecords[$index]['application_status'] = MsmeRegistration::$applicationStatus[$finalResult->application_status];
                $allRecords[$index]['payment_status'] = $finalResult->payment_status;
                $allRecords[$index]['assigned_sub_admin'] = $finalResult->assigned_sub_admin;
                $index++;
            }
            $searchResult['allRecords'] = $allRecords;
        }
        $allSubadmins = [];

        $subadmins = Admin::all();
        if(is_object($subadmins) && false == $subadmins->isEmpty()){
            foreach($subadmins as $subadmin){
                $allSubadmins[] = [
                    'id' => $subadmin->id,
                    'name' => $subadmin->name,
                ];
            }
            $searchResult['allSubadmins'] = $allSubadmins;
        }
        return $searchResult;
    }

    protected function searchByOrderId(Request $request){
        $orderId = $request->get('order_id');
        $loginUser = Auth::guard('admin')->user();
        if(1 == $loginUser->is_subadmin){
            $result = DB::table('msme_registrations')->where('assigned_sub_admin', $loginUser->id)->where('order_id', 'LIKE','%'.$orderId.'%')->where('application_status', '<', 5)->select('msme_registrations.*')->orderBy('id', 'desc')->get();
        } else {
            $result = DB::table('msme_registrations')->where('order_id', 'LIKE','%'.$orderId.'%')->select('msme_registrations.*')->orderBy('id', 'desc')->get();
        }
        $allRecords = [];
        $searchResult = [];
        if(is_object($result) && false == $result->isEmpty()){
            $index = 1;
            foreach($result as $finalResult){
                $allRecords[$index]['order_id'] = $finalResult->order_id;
                $allRecords[$index]['created_at'] = date('Y-m-d', strtotime($finalResult->created_at));
                $allRecords[$index]['name'] = $finalResult->adhaar_name;
                $allRecords[$index]['city'] = $finalResult->city;
                $allRecords[$index]['application_status'] = MsmeRegistration::$applicationStatus[$finalResult->application_status];
                $allRecords[$index]['payment_status'] = $finalResult->payment_status;
                $allRecords[$index]['assigned_sub_admin'] = $finalResult->assigned_sub_admin;
                $index++;
            }
            $searchResult['allRecords'] = $allRecords;
        }
        $allSubadmins = [];

        $subadmins = Admin::all();
        if(is_object($subadmins) && false == $subadmins->isEmpty()){
            foreach($subadmins as $subadmin){
                $allSubadmins[] = [
                    'id' => $subadmin->id,
                    'name' => $subadmin->name,
                ];
            }
            $searchResult['allSubadmins'] = $allSubadmins;
        }
        return $searchResult;
    }

    protected function allPayments(){
        if(1 == Auth::guard('admin')->user()->is_subadmin){
            return Redirect::to('admin/home');
        }
        $allPayments = Payment::orderBy('id','desc')->get();
        $totalAmount = 0;
        return view('admin.payments', compact('allPayments', 'totalAmount'));
    }

    protected function showAdmin(){
        return view('admin.update_password');
    }

    protected function updateAdmin(Request $request){
        $v = Validator::make($request->all(), [
                'old_password'     => 'required',
                'new_password'     => 'required|different:old_password',
                'confirm_password' => 'required|same:new_password',
            ]);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        $data = $request->all();
        DB::beginTransaction();
        try
        {
            $admin = Auth::guard('admin')->user();
            if(!Hash::check($data['old_password'], $admin->password)){
                return back()->withErrors(['The given password does not match the database password']);
            }else{
                $admin->password = bcrypt($data['new_password']);
                $admin->save();
                DB::commit();
                Auth::guard('admin')->logout();
                Session::flush();
                Session::regenerate();
                return Redirect::to('admin/login')->with('message', 'please login with updated password');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return Redirect::to('admin/home')->withErrors('something went wrong.');
        }
        return Redirect::to('admin/home');
    }

    protected function assignSubAdmin(Request $request){
        $orderId = strip_tags(trim($request->get('order_id')));
        $assignSubAdmin = strip_tags(trim($request->get('assigned_sub_admin')));
        MsmeRegistration::assignSubAdmin($orderId, $assignSubAdmin);
        return Redirect::to('admin/home');
    }

    protected function downloadExcelRecords(Request $request){
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $resultArray[] = ['Sr. No.','Name','Email','City','Mobile','OrderId','Date','Price'];
        $registrations = MsmeRegistration::downloadExcelRecords($request);
        if( false == $registrations->isEmpty()){
            foreach($registrations as $index => $registration){
                $result = [];
                $result['Sr. No.'] = $index +1;
                $result['Name'] = $registration->adhaar_name;
                $result['Email'] = $registration->email;
                $result['City'] = $registration->city;
                $result['Mobile'] = $registration->mob_no;
                $result['OrderId'] = $registration->order_id;
                $result['Date'] = date('Y-m-d',strtotime($registration->created_at));
                $result['Price'] = $registration->service_price;
                $resultArray[] = $result;
            }
        }
        $sheetName = 'Msme Registration';
        return \Excel::create($sheetName, function($excel) use ($sheetName,$resultArray) {
            $excel->sheet($sheetName , function($sheet) use ($resultArray)
            {
                $sheet->fromArray($resultArray);
            });
        })->download('xls');
    }
}
