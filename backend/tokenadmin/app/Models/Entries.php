<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entries extends Model
{
    
    const STATUS_PENDING = "Pending";
    const STATUS_APPROVED = "Approved";
    const STATUS_REJECTED= "REJECTED";
    
    //
    protected $table = 'user_verify';
    public $primaryKey = 'id';
    protected $guarded = [];
    
    public static $rules = [

    ];
    
    public static $messages = [
    ];
    
    public static $customAttributeNames = [

    ];
    
}
