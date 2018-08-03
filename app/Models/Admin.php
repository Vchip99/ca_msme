<?php

namespace App\Models;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_subadmin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }

    /**
     *  create/update sub admin and assingn permissions
     */
    protected static function createOrUpdateSubAdmin(Request $request, $isUpdate = false){
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        $subadminId = $request->get('subadmin_id');
        $isAdmin = $request->get('is_admin');
        if($isUpdate && !empty($subadminId)){
            $subadmin = static::find($subadminId);
            if(!is_object($subadmin)){
                return Redirect::to('admin/sub-admin');
            }
            if(!empty($password)){
                $subadmin->password = bcrypt($password);
            }
        } else {
            $subadmin = new static;
            $subadmin->password = bcrypt($password);
        }
        $subadmin->name = $name;
        $subadmin->email = $email;
        $subadmin->is_subadmin = $isAdmin;
        $subadmin->save();
        return $subadmin;
    }
}
