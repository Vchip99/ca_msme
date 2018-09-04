<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use App\Models\MsmeRegistration;
use Auth,Hash,Session,Redirect,Validator,DB;


class SubAdminController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validateCreateSubAdmin = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required',
        'confirm_password' => 'required|same:password'
    ];

    protected $validateUpdateSubAdmin = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255'
    ];

    /**
     * show all sub admins
     */
    protected function show(){
        if(1 == Auth::guard('admin')->user()->is_subadmin){
            return Redirect::to('admin/home');
        }
        $subadmins = Admin::all();
        return view('subadmin.list', compact('subadmins'));
    }

    /**
     * show create sub admin
     */
    protected function create(){
        $subadmin = new Admin;
        return view('subadmin.create', compact('subadmin'));
    }

    /**
     * store admin
     */
    protected function store(Request $request){
        $v = Validator::make($request->all(), $this->validateCreateSubAdmin);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }

        DB::beginTransaction();
        try
        {
            $subadmin = Admin::createOrUpdateSubAdmin($request);
            if(is_object($subadmin)){
                DB::commit();
                return Redirect::to('admin/sub-admin')->with('message', 'Sub Admin create successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return redirect()->back()->withErrors('something went wrong.');
        }
        return Redirect::to('admin/sub-admin');
    }

    /**
     * edit admin
     */
    protected function edit($id){
        $id = json_decode($id);
        if(isset($id)){
            $subadmin = Admin::find($id);
            if(is_object($subadmin)){
                return view('subadmin.create', compact('subadmin'));
            }
        }
        return Redirect::to('admin/sub-admin');
    }

    /**
     * update sub admin
     */
    protected function update(Request $request){
        $v = Validator::make($request->all(), $this->validateUpdateSubAdmin);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        $subadminId = strip_tags(trim($request->get('subadmin_id')));
        if(isset($subadminId)){
            DB::beginTransaction();
            try
            {
                $subadmin = Admin::createOrUpdateSubAdmin($request, true);
                if(is_object($subadmin)){
                    DB::commit();
                    return Redirect::to('admin/sub-admin')->with('message', 'Sub Admin updated successfully!');
                }
            }
            catch(\Exception $e)
            {
                DB::rollback();
                return redirect()->back()->withErrors('something went wrong.');
            }
        }
        return Redirect::to('admin/sub-admin');
    }

    /**
     * delete sub admin
     */
    protected function delete(Request $request){
        $subadminId = strip_tags(trim($request->get('subadmin_id')));
        if(isset($subadminId)){
            $subadmin = Admin::find($subadminId);
            if(is_object($subadmin)){
                $admin = Admin::where('is_subadmin', 0)->first();
                if(is_object($admin)){
                    $registrations = MsmeRegistration::where('assigned_sub_admin', $subadmin->id)->get();
                    if(is_object($registrations) && false == $registrations->isEmpty()){
                        foreach($registrations as $registration){
                            $registration->assigned_sub_admin = $admin->id;
                            $registration->sub_admin = $admin->id;
                            $registration->save();
                        }
                    }
                }
                $subadmin->delete();
                DB::commit();
                return Redirect::to('admin/sub-admin')->with('message', 'Sub Admin deleted successfully!');
            }
        }
        return Redirect::to('admin/sub-admin');
    }


}