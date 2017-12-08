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
        $oEtherScan = new Etherscan($this->esApiKey);
        $txnResult = $oEtherScan->transactionList("0x676e1c5be0dae5523813afd09f0ff1eed75d48b4",0,99999999,"desc",1,10);
        if($txnResult['status'] && $txnResult['message'] == "OK"){
            $options = Investor::select(DB::raw('CONCAT(first_name, " ", last_name) as name, investor_id'))->orderBy('name', 'ASC')->get();
            $txnlist = $txnResult['result'];
            return view('admin.transactions.index')->with('txnlists', $txnlist)->with('investors', $options);
        }else{
            return view('admin.transactions.index')->with('error', "No Data Found")->with('investors', $options);
        }
    }

    public function trSearchForm2(Request $request) {
        
    }
    
}
