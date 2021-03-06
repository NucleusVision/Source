<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Entries;

class EntriesController extends Controller
{
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
        return \View::make('admin.entries.index');
    }

    /**
     * get list of teams
     * @return json array
     */
    public function getEntriesList() {
        return Entries::orderBy('id','DESC')->get()->toArray();
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
	
	
}
