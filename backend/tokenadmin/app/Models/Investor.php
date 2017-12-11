<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Investor extends Model
{
    
    const STATUS_PENDING = "Pending";
    const STATUS_APPROVED = "Approved";
    const STATUS_REJECTED= "Rejected";
    
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
    
    public static function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    
}
