<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Mill;
use App\Models\Variety;
use App\Models\Quality;
use App\Models\Finish;

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
        
        $query = Stock::join('stock_quantity', 'stocks.stock_code', '=', 'stock_quantity.stock_code')->groupBy('stock_quantity.stock_code');
        
        
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

        if(!empty($obj->{'type'})){
            $type = explode(',',$data['type']);
            $query->whereIn('type',$type);
        }
        /*if(!empty($obj->{'size1'})){
            $aSize1 = explode(',',$data['size1']);
            $query->whereIn('size1',$aSize1);
        }
        if(!empty($obj->{'size2'})){
            $aSize2 = explode(',',$data['size2']);
            $query->whereIn('size2',$aSize2);
        }*/
         
        
        //$queryTemp = clone $query;
        
        if(!empty($obj->{'gsm'})){
                
        $recordQuery = clone $query;
        $result = $recordQuery->where('gsm', $data['gsm'])->get();
              
        $min = $data['gsm']-5;
        $max = $data['gsm']+5;

        if($result->isEmpty()){
            //dd($result);
            $query->whereBetween('gsm', [$min, $max]);
        }else{
            //dd(443);
            $query->where('gsm', $data['gsm']);
        }
            /*
            $aGsm = explode(',',$data['gsm']);
            $query->whereIn('gsm',$aGsm);
            */
        }
        
	if(!empty($obj->{'size1'})){
            
            $recordQuery = clone $query;
            $result = $recordQuery->where('size1', $data['size1'])->get();
            
            $min = $data['size1']-5;
            $max = $data['size1']+5;
            //dd($result);
            if($result->isEmpty()){
                //dd($result);
                $query->whereBetween('size1', [$min, $max]);
            }else{
                //dd(343);
                $query->where('size1', $data['size1']);
            }
            
            /*
            $aSize1 = explode(',',$data['size1']);
            $max = max($aSize1);
            $min = min($aSize1);
            $aSizeData = [
              'min' =>  $min,
              'max' =>  $max,  
            ];
            $query->whereBetween('size1',$aSizeData);
            */   
        }
        
        if(!empty($obj->{'size2'})){
            
            $recordQuery = clone $query;
            $result = $recordQuery->where('size2', $data['size2'])->get();
            
            $min = $data['size2']-5;
            $max = $data['size2']+5;
            //dd($result);
            if($result->isEmpty()){
                $query->whereBetween('size2', [$min, $max]);
            }else{
                $query->where('size2', $data['size2']);
            }
            
            /*
            $aSize2 = explode(',',$data['size2']);
            $max = max($aSize2);
            $min = min($aSize2);
            $aSizeData = [
              'min' =>  $min,
              'max' =>  $max,  
            ];
            $query->whereBetween('size2',$aSizeData);
            */
        }

        $stockList = $query->select('stocks.*', DB::raw('SUM(stock_quantity.quantity) as quantity'))->get();
        
        
        if(empty($obj->{'variety'}) && empty(($obj->{'quality'})) && empty($obj->{'finish'}) && empty($obj->{'gsm'}) && empty($obj->{'type'}) && empty($obj->{'size1'}) && empty($obj->{'size2'})){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json([$status]);
            return $json;
        }
        
        if(count($stockList) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json([$status]);
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
            $json = response()->json([$status]);
            return $json;
        }else{
            $json = response()->json([array('variety'=>$oVariety)]);
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
            $json = response()->json([$status]);
            return $json;
        }
        
        if(count($oQuality) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json([$status]);
            return $json;
        }else{
            $json = response()->json([array('quality'=>$oQuality)]);
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
            $json = response()->json([$status]);
            return $json;
        }
        
        if(count($oFinish) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json([$status]);
            return $json;
        }else{
            $json = response()->json([array('finish'=>$oFinish)]);
            return $json;
        }
    }
    
    public function getAll(){
        //
        //oVarities = Variety::with('qualities.finish')->get();
        
        
//        $oVarities = Variety::with([
//            'qualities' => function ($q) {
//                $q->with(['finish' => function ($q) {
//                    $q->groupby(‘finish’); //constraint on grandchild
//                }])->groupby(’quality'); //constraint on child
//             }
//        ]);
        
        $oVarities = Variety::with([
            'qualities' => function ($q) {
                //$q->groupby('quality'); 
            },'qualities.finish' => function ($q) {
                    $q->groupby('quality_id','finish'); 
            }
        ])->get();
        
        $json = response()->json($oVarities);
        return $json;
    }
}
