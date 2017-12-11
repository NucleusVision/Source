<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Investor;
use DB;
use Carbon\Carbon;
use Validator;
use etherscan\api\Etherscan;

class TransactionController extends Controller
{
    private $esApiKey = "CJJ7CIJGC6E1HGEB6XVQ1AQ6DZ781CMZG4";
    //
    /**
     * @return void
     */
    public function __construct() {
        //$this->middleware('admin');  
    }

    public function index(Request $request) {
        $options = Investor::select(DB::raw('CONCAT(first_name, " ", last_name) as name, investor_id'))->orderBy('name', 'ASC')->get();
        //dd($options);
        return view('admin.transactions.index')->with('investors', $options)->with('txnlists', []);
    }
    
    public function ajaxGetInvestors(Request $request)
    {
    	if($request->ajax()){
                
                $oSelect = Investor::select(DB::raw('CONCAT(first_name, " ", last_name) as name, investor_id'));

                if($request->investor_type){
                    if($request->investor_type == "whitelisted"){
                        $oSelect->where('created_at', '>=', Carbon::now()->subDay());
                    }elseif($request->investor_type == "public"){
                       $oSelect->where('created_at', '<=', Carbon::now()->subDay());
                    }elseif($request->investor_type == "private"){
                       $oSelect->where('prflag', '=', 1);
                    }
                }
        	
		$investors = $oSelect->orderBy('name', 'ASC')->pluck('name', 'investor_id');
    		return $investors;
    	}
    }
    
    public function trSearchForm1(Request $request) {
        \Session::flash('requestData', $request->all());
        return redirect()->route('admin::trSearchResults1');
    }

    public function trSearchForm2(Request $request) {
        
    }
    
    public function trSearchResults1(Request $request) {
        $error = "";
        $errFlag = 0;
        $addr = "";
        $options = Investor::select(DB::raw('CONCAT(first_name, " ", last_name) as name, investor_id'))->orderBy('name', 'ASC')->get();
        
        if(session('requestData')){
            $requestData = session('requestData');
            //dd(session('requestData'));

            if (empty($requestData['investor_name']) && empty($requestData['eth_addr'])) {
                $errFlag = 1;
                $error = "please choose Investor or enter ETH Wallet Address";
                
            }else{
                if(!empty($requestData['investor_name'])){
                    $oInvestor = Investor::find($requestData['investor_name']);
                    if($oInvestor){
                        $addr = $oInvestor->id;   
                    }else{
                        $errFlag = 1;
                        $error = "invalid Investor";
                    }
                }else{
                    $addr = trim($requestData['eth_addr']);
                }
                
            }
            if($errFlag){
                return redirect()->route('admin::showTransactions')->with('error', $error);
            }else{
                $oEtherScan = new Etherscan($this->esApiKey);
                $arrBal = $oEtherScan->balance($addr);
                if($arrBal['status'] && $arrBal['message'] == "OK"){
                    //\Session::flash('eth_balance', (float)($arrBal['result']/pow(10, 18)));
                    \Session::flash('eth_balance', (float)$arrBal['result'] / pow(10, 18));
                }
                $txnResult = $oEtherScan->transactionList($addr,0,99999999,"desc",1,14);
                if($txnResult['status'] && $txnResult['message'] == "OK"){
                    $txnlist = $txnResult['result'];
                    //dd($txnlist);
                    \Session::flash('txnlists', $txnlist);
                    \Session::flash('no_of_txns', count($txnlist));
                    \Session::flash('sel_eth_addr', $requestData['eth_addr']);
                    \Session::flash('sel_investor_type', $requestData['investor_type']);
                    \Session::flash('sel_investor_name', $requestData['investor_name']);
                    return view('admin.transactions.index')->with('investors', $options)->with('txnlists', $txnlist);
                }else{
                    \Session::flash('info_message', $txnResult['message']);
                }
                //return view('admin.transactions.index')->with('investors', $options);
            }
            
        }
    }
    
}
