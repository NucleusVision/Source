<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_user'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role_id'];

    /**
     * get user
     * @return user row
     *
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * get role
     * @return role row
     */
    public function role() {
        return $this->belongsTo('App\Models\Role');
    }
    
    /**
     * Check User Role
     */
    public static function checkUserRole($a_iUserID, $a_iRoleID) {
        return self::where("user_id", $a_iUserID)->where("role_id", $a_iRoleID)->count();
    }

}
