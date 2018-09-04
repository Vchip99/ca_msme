<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Redirect, DB,File,Auth;
use App\Libraries\InputSanitise;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Payment;

class MsmeRegistration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','adhaar_number','adhaar_name','application_category','gender','disability','enterprise_name','organisation_type','pan_no','building_no','floor_no','building_name','street','city','state','district','is_same_address','office_building_no','office_floor_no','office_building_name','office_street','office_city','office_state','office_district','mob_no','email','business_start_date','account_no','ifsc','business_activity','nic2_digit_code','actvity_description','employees','investment_amount','adhar_card','application_status','payment_status','user_id', 'assigned_sub_admin','sub_admin'];

     public static  $applicationStatus = [
        '1' => 'Application Filled',
        '2' => 'Payment Done',
        '3' => 'Documents Verified',
        '4' => 'ID Generated',
        '5' => 'Completed',
    ];

    public static  $msmePrice = 1500;

    protected static function addOrUpdateMsmeRegistration(Request $request, $isUpdate=false){
    	$adhaarNumber = InputSanitise::inputString($request->get('adhaar_number'));
    	$adhaarName = InputSanitise::inputString($request->get('adhaar_name'));
    	$applicationCategory = InputSanitise::inputString($request->get('application_category'));
    	$gender = InputSanitise::inputString($request->get('gender'));
    	$disability = InputSanitise::inputString($request->get('disability'));
        $enterpriseName = InputSanitise::inputString($request->get('enterprise_name'));
        $organisationType = InputSanitise::inputString($request->get('organisation_type'));
    	$panNo = InputSanitise::inputString($request->get('pan_no'));
    	$buildingNo = InputSanitise::inputString($request->get('building_no'));
    	$floorNo = InputSanitise::inputString($request->get('floor_no'));
    	$buildingName = InputSanitise::inputString($request->get('building_name'));
    	$street = InputSanitise::inputString($request->get('street'));
    	$city = InputSanitise::inputString($request->get('city'));
        $pin = InputSanitise::inputString($request->get('pin'));
    	$state = InputSanitise::inputString($request->get('state'));
    	$district = InputSanitise::inputString($request->get('district'));
    	$isSameAddress = InputSanitise::inputString($request->get('is_same_address'));
    	$officeBuildingNo = InputSanitise::inputString($request->get('office_building_no'));
    	$officeFloorNo = InputSanitise::inputString($request->get('office_floor_no'));
    	$officeBuildingName = InputSanitise::inputString($request->get('office_building_name'));
    	$officeStreet = InputSanitise::inputString($request->get('office_street'));
    	$officeCity = InputSanitise::inputString($request->get('office_city'));
        $officePin = InputSanitise::inputString($request->get('office_pin'));
    	$officeState = InputSanitise::inputString($request->get('office_state'));
    	$officeDistrict = InputSanitise::inputString($request->get('office_district'));
    	$mobNo = InputSanitise::inputString($request->get('mob_no'));
    	$email = InputSanitise::inputString($request->get('email'));
    	$businessStartDate = InputSanitise::inputString($request->get('business_start_date'));
    	$accountNo = InputSanitise::inputString($request->get('account_no'));
    	$ifsc = InputSanitise::inputString($request->get('ifsc'));
        $businessActivity = InputSanitise::inputString($request->get('business_activity'));
        $nic2DigitCode = InputSanitise::inputString($request->get('nic2_digit_code'));
        $actvityDescription = InputSanitise::inputString($request->get('actvity_description'));
    	$employees = InputSanitise::inputString($request->get('employees'));
    	$investmentAmount = InputSanitise::inputString($request->get('investment_amount'));
        $applicationStatus = InputSanitise::inputString($request->get('application_status'));
        $orderId = InputSanitise::inputInt($request->get('order_id'));

        if(empty($orderId) && false == $isUpdate){
            $allCount = static::count();
            if( 0 == $allCount){
                $orderId = '20180401';
            } else {
                $lastRecord = static::orderBy('id', 'desc')->first();
                if(is_object($lastRecord)){
                    $orderId = (int) $lastRecord->order_id + 1;
                }
            }
        }

    	if(true == $isUpdate){
    		$newMsmeRegistration = static::where('order_id', $orderId)->first();
    		if(!is_object($newMsmeRegistration)){
    			return Redirect::to('admin/home');
    		}
    	} else {
        	$newMsmeRegistration = new static;

            $subadmins = Admin::all();
            $allSubadmins = [];
            if(is_object($subadmins) && false == $subadmins->isEmpty()){
                foreach($subadmins as $subadmin){
                    $allSubadmins[] = $subadmin->id;
                }
            }

            $lastRegistration = MsmeRegistration::orderBy('id', 'desc')->first();
            if(is_object($lastRegistration)){
                $lastKey = array_search($lastRegistration->sub_admin, $allSubadmins);
                if(isset($allSubadmins[$lastKey+1])){
                    $subadminId = $allSubadmins[$lastKey+1];
                } else {
                    $subadminId = $allSubadmins[0];
                }
            } else {
                $subadminId = $allSubadmins[0];
            }
            $newMsmeRegistration->assigned_sub_admin = $subadminId;
            $newMsmeRegistration->sub_admin = $subadminId;
        }

        $newMsmeRegistration->order_id = $orderId;
        $newMsmeRegistration->adhaar_number = $adhaarNumber;
        $newMsmeRegistration->adhaar_name = $adhaarName;
        $newMsmeRegistration->application_category = $applicationCategory;
        $newMsmeRegistration->gender = $gender;
        $newMsmeRegistration->disability = $disability;
        $newMsmeRegistration->enterprise_name = $enterpriseName;
        $newMsmeRegistration->organisation_type = $organisationType;
        $newMsmeRegistration->pan_no = $panNo;
        $newMsmeRegistration->building_no = $buildingNo;
        $newMsmeRegistration->floor_no = $floorNo;
        $newMsmeRegistration->building_name = $buildingName;
        $newMsmeRegistration->street = $street;
        $newMsmeRegistration->city = $city;
        $newMsmeRegistration->pin = $pin;
        $newMsmeRegistration->state = $state;
        $newMsmeRegistration->district = $district;
        $newMsmeRegistration->is_same_address = $isSameAddress;
        $newMsmeRegistration->office_building_no = $officeBuildingNo;
        $newMsmeRegistration->office_floor_no = $officeFloorNo;
        $newMsmeRegistration->office_building_name = $officeBuildingName;
        $newMsmeRegistration->office_street = $officeStreet;
        $newMsmeRegistration->office_city = $officeCity;
        $newMsmeRegistration->office_pin = $officePin;
        $newMsmeRegistration->office_state = $officeState;
        $newMsmeRegistration->office_district = $officeDistrict;
        $newMsmeRegistration->mob_no = $mobNo;
        $newMsmeRegistration->email = $email;
        $newMsmeRegistration->business_start_date = $businessStartDate;
        $newMsmeRegistration->account_no = $accountNo;
        $newMsmeRegistration->ifsc = $ifsc;
        $newMsmeRegistration->business_activity = $businessActivity;
        $newMsmeRegistration->nic2_digit_code = $nic2DigitCode;
        $newMsmeRegistration->actvity_description = $actvityDescription;
        $newMsmeRegistration->employees = $employees;
        $newMsmeRegistration->investment_amount = $investmentAmount;
        $newMsmeRegistration->application_status = $applicationStatus;
        if(is_object(Auth::user())){
            $newMsmeRegistration->user_id = Auth::user()->id;
        }

        $path = 'documents/'.$orderId;
        if(!is_dir($path)){
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if($request->exists('adhar_card')){
            $adharCard = str_replace(' ', '_', $request->file('adhar_card')->getClientOriginalName());
            $request->file('adhar_card')->move($path, $adharCard);
            $newMsmeRegistration->adhar_card = $path."/".$adharCard;
            // open image
            $img = Image::make($newMsmeRegistration->adhar_card);
            // enable interlacing
            $img->interlace(true);
            // save image interlaced
            $img->save();
        }

        $newMsmeRegistration->save();
        return $newMsmeRegistration;
    }

    protected static function changeOrderStatusByOrderIdByStatusId($orderId, $statusId){
        $registeredRecord = static::where('order_id', $orderId)->first();
        if(is_object($registeredRecord)){
            $registeredRecord->application_status = $statusId;
            if(is_object(Auth::user())){
                $registeredRecord->user_id = Auth::user()->id;
            }
            $registeredRecord->save();
            return $registeredRecord;
        }
        return;
    }

    protected static function changePaymentStatusByOrderIdByPaymentStatus($orderId, $paymentStatus){
        $registeredRecord = static::where('order_id', $orderId)->first();
        if(is_object($registeredRecord)){
            $registeredRecord->payment_status = $paymentStatus;
            if(is_object(Auth::user())){
                $registeredRecord->user_id = Auth::user()->id;
            }
            $registeredRecord->save();
            return $registeredRecord;
        }
        return;
    }

    protected static function assignSubAdmin($orderId, $assignSubAdmin){
        $registeredRecord = static::where('order_id', $orderId)->first();
        if(is_object($registeredRecord)){
            $registeredRecord->assigned_sub_admin = $assignSubAdmin;
            $registeredRecord->save();
            return $registeredRecord;
        }
        return;
    }

    public function applicationStatus(){
        return self::$applicationStatus[$this->application_status];
    }

    public function payment(){
        $payment = Payment::where('order_id',$this->order_id)->first();
        if(is_object($payment)){
            return $payment->service_price;
        } else {
            return 0;
        }
    }

    protected static function downloadExcelRecords(Request $request){
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        return static::join('payments','payments.order_id','=','msme_registrations.order_id')->where('msme_registrations.created_at','>=', $startDate." 00:00:00")->where('msme_registrations.created_at','<=', $endDate." 23:59:59")->select('msme_registrations.*','payments.service_price')->get();
    }
}
