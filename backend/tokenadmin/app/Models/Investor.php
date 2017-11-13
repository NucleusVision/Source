<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    
    const STATUS_PENDING = "Pending";
    const STATUS_APPROVED = "Approved";
    const STATUS_REJECTED= "REJECTED";
    
    //
    protected $table = 'investors';
    public $primaryKey = 'investor_id';
    protected $guarded = [];
    
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required'
    ];
    
    public static $messages = [
    ];
    
    public static $customAttributeNames = [

    ];
    
}
