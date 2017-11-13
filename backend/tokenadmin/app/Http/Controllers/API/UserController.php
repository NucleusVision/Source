<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLog;
use App\Models\Company;
use App\Models\Role;
use Validator;
use Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    
    public function login(Request $request) {
        
        // Now we can get the content from it
        $content = $request->getContent();
        
        $obj = json_decode($content);
        
        $data = [
            'EMAIL' => trim($obj->{'EMAIL'}),
            'PASSWORD' => trim($obj->{'PASSWORD'}),
        ];
            
        $msg = 'failure';
        $userId = '';
        $status = '401';
            
        $validator = Validator::make($data, User::$apiLoginRules, User::$apiLoginMessages, User::$apiLoginCustomAttributeNames);

        if (! $validator->fails())
        {
            $oUser = User::where('email', '=', $data['EMAIL'])->first();
            if($oUser){
                if (Hash::check($data['PASSWORD'], $oUser->password)) {
                    
                    if($oUser->status == User::STATUS_INACTIVE){
                        $msg = 'Your account is not activated.';
                        $status = '401';
                    }else{
                        
                        UserLog::create([
                            'user_id' => $oUser->user_id,
                            'login_time' => \DB::raw('NOW()'),
                            'ip_address' => \Request::ip()
                        ]);
                        
                        $userId = $oUser->user_id;
                        $msg='success';
                        $status = 200;
                    }
                }
            }
        }
        
        return response()->json(['message'=>$msg, 'userId'=>$userId]);
        
    }
    
    public function register(Request $request) {

        // Now we can get the content from it
        $content = $request->getContent();
        
        $obj = json_decode($content);

        $data = [
            'COMPANY_NAME' => $obj->{'COMPANY_NAME'},
            'FIRST_NAME' => $obj->{'FIRST_NAME'},
            'LAST_NAME' => $obj->{'LAST_NAME'},
            'EMAIL' => $obj->{'EMAIL'},
            'PASSWORD' => $obj->{'PASSWORD'},
            'CONFIRM_PASSWORD' => $obj->{'CONFIRM_PASSWORD'},
            'CONTACT_NUMBER' => $obj->{'CONTACT_NUMBER'},
        ];
          
            
        $validator = Validator::make($data, User::$apiRegistrationRules, User::$apiRegistrationMessages, User::$apiRegistrationCustomAttributeNames);

        $isUserExist = User::where('email', $data['EMAIL'])->first();
        
        $msg = '';
        
        if($isUserExist){
             $msg = 'Already Registered through this e-mail';
        }
        else{
            if ($validator->fails())
            {
                $msg = 'Sorry, Invalid Details, Please try again';
            }
            else
            {   
                $companyId = '';
                $roleId = Role::getRole(Role::ROLE_USER)->role_id;

                $oCompany = Company::where('name', $data['COMPANY_NAME'])->first();

                if($oCompany){
                    $companyId = $oCompany->company_id;
                }else{
                    $companyId = Company::where('name', 'MUC')->value('company_id');
                }

                $oUser = User::create([
                    'company_id' => $companyId,
                    'first_name' => $data['FIRST_NAME'],
                    'last_name' => $data['LAST_NAME'],
                    'email' => $data['EMAIL'],
                    'contact_number' => $data['CONTACT_NUMBER'],
                    'password' => \Hash::make($data['PASSWORD']),
                    'company_at_register' => $data['COMPANY_NAME'],
                ]);

                if ($oUser)
                {
                    $oUser->roles()->attach($roleId);
                    $msg = 'Your registration request is submitted. Our team will get in touch with you shortly.';
                }else{
                    $msg = 'Sorry, Invalid Details, Please try again';
                }
            }
        }
        
        return $msg;
        
    }
    
    public function sendResetEmail(Request $request) {
        // Now we can get the content from it
        $content = $request->getContent();
        
        $obj = json_decode($content);

        $data = [
            'EMAIL' => $obj->{'EMAIL'},
        ];
            
        $isUserExist = User::where('email', $data['EMAIL'])->first();
        
        $msg = 'failure';
        
        if(is_null($isUserExist)){
             $msg = "We can't find a user with that e-mail address.";
        }
        else{
            \DB::table('password_resets')->where('email', $data['EMAIL'])->delete();
            
            $token = hash_hmac('sha256', Str::random(40), 'ResetPassword');
            
            \DB::table('password_resets')->insert(['email' => $data['EMAIL'], 'token' => $token]);
            
            $oUser = User::where('email', $data['EMAIL'])->first();
            
            $data = [
              'email' => $data['EMAIL'],
              'token' => $token,
              'user' => $oUser
            ];
            
            \Mail::send('emails.password', $data, function ($m) use ($data) {
                $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
                $m->to($data['email'])->subject('Your Password Reset Link');
            });
            
            $msg = "We have e-mailed your password reset link!";
            
        }
        
        return $msg;
            
    }
  
}
