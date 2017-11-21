<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Investor;

class InvestorNewController extends Controller
{
    public $apiDomain = '54.215.211.34:1337';//13.56.240.73:1337
    //
    /**
     * @return void
     */
    public function __construct() {
        //$this->middleware('admin');  
    }

    /**
     * Data filtering.
     *
     * @return array
     */
    private function formatData(Request $request) { 
        return [
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
        ];
    }

    public function index() {
        return \View::make('admin.investorsnew.index');
    }

    
    public function getInvestorsList(Request $request) {
        $oSelect = Investor::where(function ($query) {
                        $query->where('prflag', '<>', 1)
                              ->orWhereNull('prflag');
                    });
        if($request->type){
            if($request->type == "whitelisted"){
                $oSelect->where('status', 'Approved');
            }elseif($request->type == "btc"){
                $oSelect->whereNotNull('bitcoin_id');
            }
        }
        
        return $oSelect->get()->toArray();
    }

    public function create() {
        return view('admin.investors.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, Warehouse::$rules, Warehouse::$messages,  Warehouse::$customAttributeNames);
        $aData = $this->formatData($request);

        Warehouse::create($aData);
        
        \Session::flash('status', trans('notifications.success'));
        \Session::flash('message', trans('notifications.investors.insert_message'));

        return redirect()->route('admin::investors');
    }
    
    /*
     * Edit Team 
     */
    public function edit($iInvestorId) {
        return view('admin.investors.edit')
                ->with('oInvestor', Investor::find($iInvestorId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request) {
        $aRules = Investor::$rules;

        if($request->status == 'Send Mail'){
            $aRules['message'] = 'required';
        }
        
        
        $this->validate($request, $aRules, Investor::$messages,  Investor::$customAttributeNames);
        //$aData = $this->formatData($request);
        
        $oInvestor = Investor::find($request->input("investor_id"));
        
        $status = $request->status;
        
        //dd($status);
        
        if($status == 'Approve'){
            $status = Investor::STATUS_APPROVED;
			
			try{

				$fields_string = "";
				
				//$url = 'http://tokenadmin.enterstargate.com/investors/kyc/email';
				$url = 'http://redemptiondata.bellboi.com/ajaxMail3.php';
				
				$fields = array(
					'email' => urlencode($request->email)
				);

				//url-ify the data for the POST
				foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
				rtrim($fields_string, '&');

				//open connection
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_POST, count($fields));
				curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

				//execute post
				$curlResp = curl_exec($ch);

				//close connection
				curl_close($ch);

				//echo $curlResp;
				
				if ($curlResp === FALSE) {
					throw new \Exception(); 
				}else{
					if(!($curlResp == "success")){
						throw new \Exception(); 
					}
				}
				
				/*
                \Mail::send('emails.approve_mail', ['name' => $request->first_name." ".$request->last_name, 'email' => $request->email], function ($m) use ($request) {
                            $m->from('tokensale@nucleus.vision', 'Nucleus Vision');
                            $m->to($request->email, $request->first_name." ".$request->last_name)->subject('Nucleus Token KYC Registration Results');
                });
                
                if(count(\Mail::failures()) > 0){
                    throw new \Exception();
                }
                */
                //\Session::flash('status', trans('notifications.success'));
                //\Session::flash('message', trans('notifications.investors.mail_message_success')); 
                
                //return redirect()->route('admin::investors');
            }catch(\Exception $e){
                //dd($e->getMessage());
                \Session::flash('status', trans('notifications.error'));
                \Session::flash('message', trans('notifications.investors.mail_message_failure')); 
                return redirect()->route('admin::investors');
            }
			
        }else if($status == 'Reject'){
            $status = Investor::STATUS_REJECTED;
        }else if($status == 'Send Mail'){
            try{
				/*
                \Mail::send('emails.comments_mail', ['name' => $request->first_name." ".$request->last_name, 'email' => $request->email, 'bodyMessage' => $request->message], function ($m) use ($request) {
                            $m->from('tokensale@nucleus.vision', 'Nucleus Vision');
                            $m->to($request->email, $request->first_name." ".$request->last_name)->subject('Nucleus Token Sale');
                });
                
                if(count(\Mail::failures()) > 0){
                    throw new \Exception();
                }
				
				*/
				
				$fields_string = "";
				
				//$url = 'http://tokenadmin.enterstargate.com/investors/kyc/email';
				$url = 'http://redemptiondata.bellboi.com/ajaxMail4.php';
				
				$fields = array(
					'email' => urlencode($request->email),
					'bodyMessage' => urlencode($request->message)
				);

				//url-ify the data for the POST
				foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
				rtrim($fields_string, '&');

				//open connection
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_POST, count($fields));
				curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

				//execute post
				$curlResp = curl_exec($ch);

				//close connection
				curl_close($ch);

				//echo $curlResp;
				
				if ($curlResp === FALSE) {
					throw new \Exception(); 
				}else{
					if(!($curlResp == "success")){
						throw new \Exception(); 
					}
				}
                
                \Session::flash('status', trans('notifications.success'));
                \Session::flash('message', trans('notifications.investors.mail_message_success')); 
                
                return redirect()->route('admin::investors');
            }catch(\Exception $e){
                //dd($e->getMessage());
                \Session::flash('status', trans('notifications.error'));
                \Session::flash('message', trans('notifications.investors.mail_message_failure')); 
                return redirect()->route('admin::investors');
            }
        }
        
        $oInvestor->update([
            'status'  =>  $status,
        ]);
        
        \Session::flash('status', trans('notifications.success'));
        \Session::flash('message', trans('notifications.investors.update_message')); 

        return redirect()->route('admin::investors');
    }
    
    /*
     * View Team
     */
    public function view($iInvestorId) {
        return view('admin.investors.view')->with('oInvestor', Investor::find($iInvestorId));
    }
    
    /*
     * Delete Team 
     */
    public function delete($iInvestorId) {
        $id = $iInvestorId;
        if(!empty($id)){
            $isDeleted = Investor::find($id)->delete();
            if($isDeleted){
                echo 'Success';
            } else {
                echo 'failure';
            }
        }
    }
	
	
	public function verifyEmail(Request $request) {
			$msg = "failure";
			try{
                \Mail::send('emails.verify_mail', ['code' => $request->code, 'email' => $request->email], function ($m) use ($request) {
                            $m->from('tokensale@nucleus.vision', 'Nucleus Vision');
                            $m->to($request->email)->subject('Verification Code');
                });
                
                if(count(\Mail::failures()) > 0){
                    throw new \Exception();
                }
				$msg = "success";
            }catch(\Exception $e){
                //$msg = $e->getMessage();   
            }
			return json_encode(['message' => $msg]);
    }
	
	public function kycEmail(Request $request) {
			$msg = "failure";
			try{
                \Mail::send('emails.kyc_mail', ['email' => $request->email], function ($m) use ($request) {
                            $m->from('tokensale@nucleus.vision', 'Nucleus Vision');
                            $m->to($request->email)->subject('KYC Submission Confirmation');
                });
                
                if(count(\Mail::failures()) > 0){
                    throw new \Exception();
                }
				$msg = "success";
            }catch(\Exception $e){
                $msg = $e->getMessage();   
            }
			return json_encode(['message' => $msg]);
    }
    
    
    
    
    public function changeStatus(Request $request) {
        
        $response = "success";

        if($request->status == 'Send Mail'){
            $aRules['message'] = 'required';
        }
        
        
        //$this->validate($request, $aRules, Investor::$messages,  Investor::$customAttributeNames);
        //$aData = $this->formatData($request);
        
        $oInvestor = Investor::find($request->input("investor_id"));
        
        $status = $request->status;
        
        //dd($status);
        
        if($status == 'Approve'){
            $status = Investor::STATUS_APPROVED;
			
			try{

				$fields_string = "";
				
				//$url = 'http://tokenadmin.enterstargate.com/investors/kyc/email';
				$url = 'http://redemptiondata.bellboi.com/ajaxMail3.php';
				
				$fields = array(
					'email' => urlencode($oInvestor->email)
				);

				//url-ify the data for the POST
				foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
				rtrim($fields_string, '&');

				//open connection
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_POST, count($fields));
				curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

				//execute post
				$curlResp = curl_exec($ch);

				//close connection
				curl_close($ch);

				//echo $curlResp;
				
				if ($curlResp === FALSE) {
					throw new \Exception(); 
				}else{
					if(!($curlResp == "success")){
						throw new \Exception(); 
					}
				}
				
				/*
                \Mail::send('emails.approve_mail', ['name' => $request->first_name." ".$request->last_name, 'email' => $request->email], function ($m) use ($request) {
                            $m->from('tokensale@nucleus.vision', 'Nucleus Vision');
                            $m->to($request->email, $request->first_name." ".$request->last_name)->subject('Nucleus Token KYC Registration Results');
                });
                
                if(count(\Mail::failures()) > 0){
                    throw new \Exception();
                }
                */
                //\Session::flash('status', trans('notifications.success'));
                //\Session::flash('message', trans('notifications.investors.mail_message_success')); 
                
                //return redirect()->route('admin::investors');
            }catch(\Exception $e){
                //dd($e->getMessage());
                //\Session::flash('status', trans('notifications.error'));
                //\Session::flash('message', trans('notifications.investors.mail_message_failure')); 
                //return redirect()->route('admin::investors');
                $response = "failure";
            }
			
        }else if($status == 'Reject'){
            $status = Investor::STATUS_REJECTED;
        }else if($status == 'Send Mail'){
            try{
				/*
                \Mail::send('emails.comments_mail', ['name' => $request->first_name." ".$request->last_name, 'email' => $request->email, 'bodyMessage' => $request->message], function ($m) use ($request) {
                            $m->from('tokensale@nucleus.vision', 'Nucleus Vision');
                            $m->to($request->email, $request->first_name." ".$request->last_name)->subject('Nucleus Token Sale');
                });
                
                if(count(\Mail::failures()) > 0){
                    throw new \Exception();
                }
				
				*/
				
				$fields_string = "";
				
				//$url = 'http://tokenadmin.enterstargate.com/investors/kyc/email';
				$url = 'http://redemptiondata.bellboi.com/ajaxMail4.php';
				
				$fields = array(
					'email' => urlencode($request->email),
					'bodyMessage' => urlencode($request->message)
				);

				//url-ify the data for the POST
				foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
				rtrim($fields_string, '&');

				//open connection
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_POST, count($fields));
				curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

				//execute post
				$curlResp = curl_exec($ch);

				//close connection
				curl_close($ch);

				//echo $curlResp;
				
				if ($curlResp === FALSE) {
					throw new \Exception(); 
				}else{
					if(!($curlResp == "success")){
						throw new \Exception(); 
					}
				}
                
                //\Session::flash('status', trans('notifications.success'));
                //\Session::flash('message', trans('notifications.investors.mail_message_success')); 
                
                //return redirect()->route('admin::investors');
            }catch(\Exception $e){
                //dd($e->getMessage());
                //\Session::flash('status', trans('notifications.error'));
                //\Session::flash('message', trans('notifications.investors.mail_message_failure')); 
                //return redirect()->route('admin::investors');
                $response = "failure";
            }
        }
        
        $oInvestor->update([
            'status'  =>  $status,
        ]);
        
        if($status == Investor::STATUS_APPROVED || $status == Investor::STATUS_REJECTED){
            $flag = ($status == Investor::STATUS_APPROVED)?'1':'0';
            $post = "addr=".$oInvestor->id."&flag=".$flag;
            $functionToCall = (!empty($request->prflag))?"whitelist":"approve";
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"http://".$this->apiDomain."/user/".$functionToCall."Account");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec ($ch);
            curl_close ($ch);

            $aObj = json_decode($server_output, true);
            $aResp = ['message' => $aObj['data'], 'success' => '1'];
        }
        
        //\Session::flash('status', trans('notifications.success'));
        //\Session::flash('message', trans('notifications.investors.update_message')); 

        return $response;
    }
    
    
    public function prInvestors() {
        return \View::make('admin.prinvestors.index');
    }
    
    public function getprInvestorsList() {
        return Investor::where('prflag', '1')->orderBy('investor_id','DESC')->get()->toArray();
    }
    
    public function prInvestorEdit($iInvestorId) {
        return view('admin.prinvestors.edit')
                ->with('oInvestor', Investor::find($iInvestorId));
    }
    
    
    public function prInvestorUpdate(Request $request) {
        $aRules = Investor::$pr_rules;

        $this->validate($request, $aRules);
        
        $oInvestor = Investor::find($request->input("investor_id"));
               
        $oInvestor->update([
            'bonus_per'  =>  $request->bonus_per,
            'lock_in_period'  =>  $request->lock_in_period
        ]);
        
        \Session::flash('status', 'Updated Successfully.');

        return redirect()->back();
    }
    
	
}
