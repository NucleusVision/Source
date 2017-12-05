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

    
    public static $pr_rules = [
        'prflag' => 'required',
        'bonus_per' => 'required_if:prflag,1|numeric|min:0.1',
        'lock_in_period' => 'required_if:prflag,1|numeric|min:0.1'
    ];
    
    public static $messages = [
        'bonus_per.required_if' => 'The Bonus % field is required.',
        'lock_in_period.required_if' => 'The Lock-in period field is required.',
    ];
    
    public static $customAttributeNames = [

    ];
    
}
