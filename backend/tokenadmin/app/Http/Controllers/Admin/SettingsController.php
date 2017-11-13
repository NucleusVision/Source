<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingsController extends Controller
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
            'dt_sales_users' => \Carbon\Carbon::createFromFormat('m/d/Y h:i a', $request->dt_sales_users)->format('Y-m-d H:i:s'),
            'dt_sales_public' => \Carbon\Carbon::createFromFormat('m/d/Y h:i a', $request->dt_sales_public)->format('Y-m-d H:i:s'),
            'bonus_percentage' => $request->input('bonus_percentage'),
            'no_first_buyers' => $request->input('no_first_buyers'),
            'token_price' => $request->input('token_price'),
            'min_amount' => $request->input('min_amount'),
            'audit_period_days' => $request->input('audit_period_days'),
            'max_limit' => $request->input('max_limit'),
        ];
    }

    public function index() {
        $oSetting = Settings::first();
        return \View::make('admin.settings.index')->with('oSetting', $oSetting);

    }

    /**
     * get list of teams
     * @return json array
     */
    public function getInvestorsList() {
        return Investor::get()->toArray();
    }

    public function create() {
        return view('admin.settings.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        try{

            $this->validate($request, Settings::$rules, Settings::$messages,  Settings::$customAttributeNames);
            $aData = $this->formatData($request);
            
            $oSettings = Settings::first();
            
            if($oSettings){
                $oSettings->update($aData);
            }else{
                Settings::create($aData);
            }

            \Session::flash('status', trans('notifications.success'));
            \Session::flash('message', trans('notifications.settings.update_message'));

        }catch(\Exception $e){
            dd($e->getMessage());
            \Session::flash('status', trans('notifications.error'));
            \Session::flash('message', trans('notifications.settings.error_message'));
            return redirect()->back();
        }
        return redirect()->back();
    }
    
    /*
     * Edit Team 
     */
    public function edit($iInvestorId) {
        return view('admin.settings.edit');
                //->with('oInvestor', Investor::find($iInvestorId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request) {
       
    
    }
    
    /*
     * View Team
     */
    public function view($iInvestorId) {
        
    }
    
    /*
     * Delete Team 
     */
    public function delete(Request $request) {
        
    }
}
