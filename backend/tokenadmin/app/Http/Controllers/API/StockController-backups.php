<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Variety;
use App\Models\Quality;
use App\Models\Finish;
use App\Models\Mill;

class StockController extends Controller
{
    public function index(){
        dd("API Stock Controller");
    }

    public function stock(){
        $json = Stock::stockJsonResponse();
        return $json;
    }
    
    private function formatData(Request $request) {

        return [
            'variety' => $request->variety,
            'mill' => $request->mill,
            'quality' => $request->quality,
            'finish' => $request->finish,
            'gsm' => $request->gsm,
            'type' => $request->type,
            'size1' => $request->size1,
            'size2' => $request->size2,
        ];
    }
    
    public function stockList(Request $request){
        $content = $request->getContent(); 
        $obj = json_decode($content);
        $data = [
            'variety' => $obj->{'variety'},
            'quality' => $obj->{'quality'},
            'finish' => $obj->{'finish'},
            'gsm' => $obj->{'gsm'},
            'type' => $obj->{'type'},        
            'size1' => $obj->{'size1'},
            'size2' => $obj->{'size2'}
        ];   
        
        $query = Stock::whereNotNull('stock_id');
        if(!empty($obj->{'variety'})){
            $aVariety = explode(',', $data['variety']);
            $query->whereIn('variety',$aVariety);
        }
        /*if(!empty($obj->{'mill'})){
            $aMill = explode(',',$data['mill']);
            $query->whereIn('mill',$aMill);
        }*/
        if(!empty(($obj->{'quality'}))){
            $aQuality = explode(',',$data['quality']);
            $query->whereIn('quality',$aQuality);
        }
        if(!empty($obj->{'finish'})){
            $aFinish = explode(',',$data['finish']);
            $query->whereIn('finish',$aFinish);
        }
        if(!empty($obj->{'gsm'})){
            $aGsm = explode(',',$data['gsm']);
            $query->whereIn('gsm',$aGsm);
        }
        if(!empty($obj->{'type'})){
            $type = explode(',',$data['type']);
            $query->whereIn('type',$type);
        }
        /*if(!empty($obj->{'size1'})){
            $aSize1 = explode(',',$data['size1']);
            $query->whereIn('size1',$aSize1);
        }*/
		if(!empty($obj->{'size1'})){
            $aSize1 = explode(',',$data['size1']);
            $max = max($aSize1);
            $min = min($aSize1);
            $aSizeData = [
              'min' =>  $min,
              'max' =>  $max,  
            ];
            $query->whereBetween('size1',$aSizeData);
        }
        /*if(!empty($obj->{'size2'})){
            $aSize2 = explode(',',$data['size2']);
            $query->whereIn('size2',$aSize2);
        }*/
		if(!empty($obj->{'size2'})){
            $aSize2 = explode(',',$data['size2']);
            $max = max($aSize2);
            $min = min($aSize2);
            $aSizeData = [
              'min' =>  $min,
              'max' =>  $max,  
            ];
            $query->whereBetween('size2',$aSizeData);
        }
        $stockList = $query->get();
        
        if(empty($obj->{'variety'}) && empty($obj->{'mill'}) && empty(($obj->{'quality'})) && empty($obj->{'finish'}) && empty($obj->{'gsm'}) && empty($obj->{'type'}) && empty($obj->{'size1'}) && empty($obj->{'size2'})){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }
        
        if(count($stockList) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }else{
            $json = response()->json($stockList);
            return $json;
        }        
    }
	
	public function getVarieties(){
        $oVariety = Variety::get()->pluck('variety_id', 'variety');
        if(count($oVariety) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }else{
            $json = response()->json(array('variety'=>$oVariety));
            //dd($json);
            return $json;
        }    
    }
    
    public function getQualities(Request $request){
        $content = $request->getContent(); 
        $obj = json_decode($content);
        
        $data = [
            'variety_id' => $obj->{'variety_id'}
        ];   
        
        $aVarietyId = explode(',', $data['variety_id']);
        $oQuality = Quality::whereIn('variety_id',$aVarietyId)->with('variety')->distinct()->pluck('quality_id','quality');
        
        if(empty($obj->{'variety_id'})){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }
        
        if(count($oQuality) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }else{
            $json = response()->json(array('quality'=>$oQuality));
            return $json;
        }    
    }
    
    public function getFinish(Request $request){
        $content = $request->getContent(); 
        $obj = json_decode($content);
        
        $data = [
            'quality_id' => $obj->{'quality_id'}
        ];   
        
        $aQualityId = explode(',', $data['quality_id']);
        
        
        $oFinish = Finish::whereIn('quality_id',$aQualityId)->distinct()->pluck('finish_id','finish');
        
        if(empty($obj->{'quality_id'})){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }
        
        if(count($oFinish) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }else{
            $json = response()->json(array('finish'=>$oFinish));
            return $json;
        }
    }
	
	public function getAll(){
        $oMill = Mill::distinct()->pluck('mill_id','unit_name','unit_code');
        $oVariety = Variety::distinct()->pluck('variety_id','variety','variety_code');
        $oQuality = Quality::distinct()->pluck('quality_id','mill_id','variety_id','quality','quality_code');
        $oFinish = Finish::distinct()->pluck('finish_id','quality_id','finish');
        $json = response()->json(array('mill'=>$oMill,'variety'=>$oVariety,'quality'=>$oQuality,'finish'=>$oFinish));
        return $json;
    }
	
}
