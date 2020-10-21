<?php

namespace MediaSci\CmsBackendAuth\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of CmsBackendUser
 *
 * @author Ahmed Sadany
 */
class CmsBackendUser extends Model {

    protected $table = 'cms_backend_users';
    public $timestamps = true;
    public $ignored_unique = [
      
    ];
    public $rules = [
        'name' => 'required|unique:backend_users,name',
        'email' => "required|Between:3,64|unique:cms_backend_users,email",
        'role_id' => "required|numeric",
        'password' => 'min:5|required',
        'confirm_password' => 'same:password',
        'image_id'=>'required'
    ];
    function role(){
        return $this->belongsTo('MediaSci\CmsBackendAuth\Models\CmsBackendRole','role_id');
    }

}
