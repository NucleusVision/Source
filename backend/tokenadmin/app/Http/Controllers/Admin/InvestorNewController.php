<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Investor;
use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;
use Validator;

class InvestorNewController extends Controller
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
        return \View::make('admin.investorsnew.index');
    }
    
    public function indexWp() {
        return \View::make('admin.investorswp.index');
    }

    
    public function getInvestorsList(Request $request) {
		
        $oSelect = Investor::select(['investor_id', 'doc1', 'doc2', 'prflag', 'bitcoin_id', 'nationality', 'status', 'first_name', 'last_name'])->where(function ($query) {
                $query->where('prflag', '<>', 1)
                      ->orWhereNull('prflag');
        });
        if($request->type){
            if($request->type == "whitelisted"){
                $oSelect->where('created_at', '>=', Carbon::now()->subDay());
            }elseif($request->type == "public"){
               $oSelect->where('created_at', '<=', Carbon::now()->subDay());
            }
        }
        	
		$investors = $oSelect->orderBy('id', 'DESC');
		
		return Datatables::of($investors)
			->editColumn('doc1', function ($row) {
				return '<img src="' .config('constants.NUCLEUS_UPLOAD_URL'). $row->doc1 . '" alt="' . $row->first_name . '" class="imageId" style="cursor:pointer;"/>';
            })
			->editColumn('doc2', function ($row) {
				return '<img src="' .config('constants.NUCLEUS_UPLOAD_URL'). $row->doc2 . '" alt="' . $row->first_name . '" class="imageId" style="cursor:pointer;"/>';
            })
			->editColumn('prflag', function ($row) {
				if($row->prflag == 1)
					return 'Yes';
				else if($row->prflag == 0)
					return 'No';
				else
					return 'No';
            })
			->editColumn('bitcoin_id', function ($row) {
				if($row->bitcoin_id)
					return 'Yes';
				else
					return 'No';
            })
			->addColumn('name', function ($row) {
                return $row->first_name.' '.$row->last_name;
            })
            ->addColumn('action', function ($row) {
				return '<a href="/admin/investors-all/' . $row->investor_id . '/edit" class="btn btn-primary btn-sm" style="margin-bottom:10px;width:70px;">Edit</a>&nbsp'; 
            })
            ->make(true);
    }
    
    
    public function getInvestorsWpList(Request $request) {
		
        $oSelect = Investor::select(['investor_id', 'doc1', 'doc2', 'prflag', 'bitcoin_id', 'nationality', 'status', 'first_name', 'last_name'])->where(function ($query) {
                        $query->where('prflag', '<>', 1)
                              ->orWhereNull('prflag');
                    });
        if($request->type){
            if($request->type == "whitelisted"){
                $oSelect->where('created_at', '>=', Carbon::now()->subDay());
            }elseif($request->type == "public"){
               $oSelect->where('created_at', '<=', Carbon::now()->subDay());
            }
        }
		
		$investors = $oSelect->orderBy('id', 'DESC');
		
		return Datatables::of($investors)
			->editColumn('doc1', function ($row) {
				return '<img src="' .config('constants.NUCLEUS_UPLOAD_URL'). $row->doc1 . '" alt="' . $row->first_name . '" class="imageId" style="cursor:pointer;"/>';
            })
			->editColumn('doc2', function ($row) {
				return '<img src="' .config('constants.NUCLEUS_UPLOAD_URL'). $row->doc2 . '" alt="' . $row->first_name . '" class="imageId" style="cursor:pointer;"/>';
            })
			->editColumn('prflag', function ($row) {
				if($row->prflag == 1)
					return 'Yes';
				else if($row->prflag == 0)
					return 'No';
				else
					return 'No';
            })->addColumn('name', function ($row) {
                return $row->first_name.' '.$row->last_name;
            })
            ->addColumn('action', function ($row) {
                $isdisabled = "";
                $statusClass = "investor-status";
                if($row->status != Investor::STATUS_PENDING){
                    $isdisabled="disabled";
                    $statusClass = "";
                }
                    
				return '<button id="' . $row->investor_id . '" data-status="Approve"  class="btn btn-success btn-sm '.$statusClass." ".$isdisabled.'" style="margin-bottom:10px;width:70px;">Approve</button>&nbsp<a id="' . $row->investor_id . '" data-status="Reject"  class="btn btn-danger btn-sm investor-status" style="margin-bottom:10px;width:70px;">Reject</a>&nbsp<a href="/admin/wp-investors/' . $row->investor_id . '/edit" class="btn btn-primary btn-sm '.$isdisabled.'" style="margin-bottom:10px;width:70px;">Edit</a>&nbsp'; 
            })
            ->make(true);
    }

    public function create() {
        return view('admin.investors.add');
    }

    

    public function edit($iInvestorId) {
		//dd(Investor::find($iInvestorId));
        return view('admin.investorsnew.edit')
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
        
        //\Session::flash('status', trans('notifications.success'));
        //\Session::flash('message', trans('notifications.investors.update_message')); 

        return $response;
    }
    
    
    public function prInvestors() {
        return \View::make('admin.prinvestors.index');
    }
    
    public function getprInvestorsList() {
		
		$investors = Investor::select(['investor_id', 'doc1', 'doc2', 'prflag', 'bitcoin_id', 'nationality', 'status', 'first_name', 'last_name', 'bonus_per', 'lock_in_period'])->where('prflag', '1')->orderBy('id', 'DESC');
		
		return Datatables::of($investors)
			->editColumn('doc1', function ($row) {
				return '<img src="' .config('constants.NUCLEUS_UPLOAD_URL'). $row->doc1 . '" alt="' . $row->first_name . '" class="imageId" style="cursor:pointer;"/>';
            })
			->editColumn('doc2', function ($row) {
				return '<img src="' .config('constants.NUCLEUS_UPLOAD_URL'). $row->doc2 . '" alt="' . $row->first_name . '" class="imageId" style="cursor:pointer;"/>';
            })
			->editColumn('prflag', function ($row) {
				if($row->prflag == 1)
					return 'Yes';
				else if($row->prflag == 0)
					return 'No';
				else
					return 'No';
            })->addColumn('name', function ($row) {
                return $row->first_name.' '.$row->last_name;
            })
            ->addColumn('action', function ($row) {
                $isdisabled = "";
                $statusClass = "investor-status";
                if($row->status != Investor::STATUS_PENDING){
                    $isdisabled="disabled";
                    $statusClass = "";
                }
                    
				return '<button id="' . $row->investor_id . '" data-status="Approve"  class="btn btn-success btn-sm '.$statusClass." ".$isdisabled.'" style="margin-bottom:10px;width:70px;">Approve</button>&nbsp<a id="' . $row->investor_id . '" data-status="Reject"  class="btn btn-danger btn-sm investor-status" style="margin-bottom:10px;width:70px;">Reject</a>&nbsp<a href="/admin/pr-investors/' . $row->investor_id . '/edit" class="btn btn-primary btn-sm '.$isdisabled.'" style="margin-bottom:10px;width:70px;">Edit</a>&nbsp'; 
                
            })
            ->make(true);
		
    }
    
    public function prInvestorEdit($iInvestorId) {
        return view('admin.prinvestors.edit')
                ->with('oInvestor', Investor::find($iInvestorId));
    }
    
    
    public function prInvestorUpdate(Request $request) {
        try{
        
        $validator = Validator::make($request->all(), Investor::$pr_rules, Investor::$messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }    

        $oInvestor = Investor::find($request->input("investor_id"));
         
        if($oInvestor->status != Investor::STATUS_APPROVED)
        {
            if($request->prflag == 1){
                $oInvestor->update([
                    'bonus_per'  =>  $request->bonus_per,
                    'lock_in_period'  =>  $request->lock_in_period,
                    'prflag'  =>  1
                ]);
            }else{
                $oInvestor->update([
                    'bonus_per'  =>  NULL,
                    'lock_in_period'  =>  NULL,
                    'prflag'  =>  $request->prflag
                ]);
            }
        }else{
            \Session::flash('error', 'Investor status can be updated only in pending state.');
        }
        
        \Session::flash('status', 'Updated Successfully.');
        //\Session::flash('error', 'Error while updating. Please try again.');
        
        }catch(\Exception $e){
            \Session::flash('error', 'Error while updating. Please try again.');
        }
        return redirect()->back();
    }
	
    public function InvestorFlagUpdate(Request $request) {
        
        try{
        
        $validator = Validator::make($request->all(), Investor::$pr_rules, Investor::$messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }    

        $oInvestor = Investor::find($request->input("investor_id"));
         
        if($oInvestor->status != Investor::STATUS_APPROVED)
        {
            if($request->prflag == 1){
                $oInvestor->update([
                    'bonus_per'  =>  $request->bonus_per,
                    'lock_in_period'  =>  $request->lock_in_period,
                    'prflag'  =>  1
                ]);
            }else{
                $oInvestor->update([
                    'bonus_per'  =>  NULL,
                    'lock_in_period'  =>  NULL,
                    'prflag'  =>  $request->prflag
                ]);
            }
        }else{
            \Session::flash('error', 'Investor status can be updated only in pending state.');
        }
        
        \Session::flash('status', 'Updated Successfully.');
        //\Session::flash('error', 'Error while updating. Please try again.');
        
        }catch(\Exception $e){
            \Session::flash('error', 'Error while updating. Please try again.');
        }
        return redirect()->back();
    }
    
    public function editWpInvestor($iInvestorId) {
		//dd(Investor::find($iInvestorId));
        return view('admin.investorswp.edit')
                ->with('oInvestor', Investor::find($iInvestorId));
				
    }
    
    public function investorWpUpdate(Request $request) {
        
        try{
        
        $validator = Validator::make($request->all(), Investor::$pr_rules, Investor::$messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }    

        $oInvestor = Investor::find($request->input("investor_id"));
         
        if($oInvestor->status != Investor::STATUS_APPROVED)
        {
            if($request->prflag == 1){
                $oInvestor->update([
                    'bonus_per'  =>  $request->bonus_per,
                    'lock_in_period'  =>  $request->lock_in_period,
                    'prflag'  =>  1
                ]);
            }else{
                $oInvestor->update([
                    'bonus_per'  =>  NULL,
                    'lock_in_period'  =>  NULL,
                    'prflag'  =>  $request->prflag
                ]);
            }
        }else{
            \Session::flash('error', 'Investor status can be updated only in pending state.');
        }
        
        \Session::flash('status', 'Updated Successfully.');
        //\Session::flash('error', 'Error while updating. Please try again.');
        
        }catch(\Exception $e){
            \Session::flash('error', 'Error while updating. Please try again.');
        }
        return redirect()->back();
    }
    
    	
}
