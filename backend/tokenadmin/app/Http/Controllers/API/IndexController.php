<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Stock;

class IndexController extends Controller
{
    
    public function sendContactUsEmail(Request $request) {
        // Now we can get the content from it
        $content = $request->getContent();

        $obj = json_decode($content);

        $data = [
            'NAME' => $obj->{'NAME'},
            'PHONE_NUMBER' => $obj->{'PHONE_NUMBER'},
            'EMAIL' => $obj->{'EMAIL'},
            'MESSAGE' => $obj->{'MESSAGE'},
        ];

        $msg = 'Error while submitting.Please try again.';
        
        //$data['EMAIL'] = env('CONTACT_US_MAIL_TO');
        //$data['EMAIL'] = 'naveenm.lst01@gmail.com';
        
        try{
            $isMailSent = \Mail::send('emails.contact_us', $data, function ($m) use ($data) {
                                $m->from(env('CONTACT_US_MAIL_FROM'), env('CONTACT_US_MAIL_NAME'));
                                $m->to('naveenm.lst01@gmail.com')->subject('Contact Us Details');
                            });

            if($isMailSent)
                $msg = "Your Enquiry is submitted. Our team will get in touch with you shortly.";
        } catch (\Exception $ex) {
            
        }
        
        return $msg;
            
    }
    
}
