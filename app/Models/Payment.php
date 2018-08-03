<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MsmeRegistration;
use App\Libraries\InputSanitise;
use Auth,Hash,Session,Redirect,Validator,DB;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'service_price', 'payment_id', 'payment_request_id', 'status', 'done_by'
    ];

    protected static function addPayment($paymentArray){
    	$payment = new static;
    	$payment->order_id = $paymentArray['order_id'];
    	$payment->service_price = $paymentArray['service_price'];
    	$payment->payment_id = $paymentArray['payment_id'];
    	$payment->payment_request_id = $paymentArray['payment_request_id'];
    	$payment->status = $paymentArray['status'];
        $payment->done_by = $paymentArray['done_by'];
    	$payment->save();
    	return $payment;
    }

    protected static function changeOrderPaymentStatus($orderId){
        $payment = static::where('order_id', $orderId)->first();
        if(!is_object($payment)){
            $newPayment = new static;
            $newPayment->order_id = $orderId;
            $newPayment->service_price = MsmeRegistration::$msmePrice;
            $newPayment->payment_id = '';
            $newPayment->payment_request_id = '';
            $newPayment->status = 'Paid';
            $newPayment->done_by = Auth::guard('admin')->user()->name;
            $newPayment->save();
            return $newPayment;
        }
        return false;
    }

    protected static function deleteRecordByOrderId($orderId){
        $payment = static::where('order_id', $orderId)->first();
        if(is_object($payment)){
            $payment->delete();
        }
        return;
    }
}
