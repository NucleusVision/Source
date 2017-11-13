<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserRoles;
use App\Models\Role;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable
{
    //implements CanResetPasswordContract
    //use CanResetPassword;
    
    
    const STATUS_ACTIVE = "Active";
    const STATUS_INACTIVE = "Inactive";
    
    protected $table = 'users';
    public $primaryKey = 'user_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static $rules = [
        'first_name.*' => 'required|max:255',
        'last_name.*' => 'required|max:255',
        'email.*' => 'required|distinct|email|unique:users,email',
        'password.*' => 'required|max:20|min:6',
        'role_id.*' => 'required',
    ];
    
    public static $messages = [
        
    ];
    

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }
    
    /**
     * Check super role
     *
     * @return bool
     */
    public function isSuper() {
        return UserRoles::checkUserRole($this->user_id, Role::getRole(Role::ROLE_SUPER)->role_id) ? true : false;
    }

    /**
     * Check admin role
     *
     * @return bool
     */
    public function isAdmin() {
        return UserRoles::checkUserRole($this->user_id, Role::getRole(Role::ROLE_ADMIN)->role_id) ? true : false;
    }
    
    /**
     * get current log
     */
    public function logs() {
        return $this->hasMany('App\Models\UserLog', 'user_id');
    }
   
}
