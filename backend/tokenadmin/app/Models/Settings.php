<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    
    //
    protected $table = 'settings';
    public $primaryKey = 'id';
    protected $guarded = [];
    
    public static $rules = [
        'dt_sales_users' => 'required',
        'dt_sales_public' => 'required',
        'bonus_percentage' => 'required',
        'no_first_buyers' => 'required',
        'token_price' => 'required',
        'min_amount' => 'required',
        'audit_period_days' => 'required',
        'max_limit' => 'required',
    ];
    
    public static $messages = [
    ];
    
    public static $customAttributeNames = [

    ];
    
}
