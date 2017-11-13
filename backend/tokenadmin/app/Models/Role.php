<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_USER = 'User';
    const ROLE_ADMIN = 'Admin';
    const ROLE_SUPER = 'Super';
    
    //
    protected $table = 'roles';
    public $primaryKey = 'role_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    
    public static function getRole($a_sRole) {
        return self::where('role', '=', $a_sRole)->first();
    }
    
    
    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'role_user', 'user_id', 'role_id')->withTimestamps();
    }
}
