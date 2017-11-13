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
            'size2' => $obj->{'size2'},
        ];   
          
            
        $aInput = [
            'variety' => $obj->{'variety'},
            'quality' => (! empty($data['quality'])) ? explode(',', $data['quality']) : '',
            'finish' => (! empty($data['finish'])) ? explode(',', $data['finish']) : '',
            'gsm' => $obj->{'gsm'},
            'type' => $obj->{'type'},        
            'size1' => $obj->{'size1'},
            'size2' => $obj->{'size2'}
        ];
		$result = Stock::getStocks($aInput);
		
		if(empty($aInput['variety']) && empty($aInput['quality']) && empty($aInput['finish']) && empty($aInput['gsm']) && empty($aInput['type']) && empty($aInput['size1']) && empty($aInput['size2'])){
			$status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json([$status]);
            return $json;
        }
        
        if(count($result) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json([$status]);
            return $json;
        }else{
			$json = response()->json($result);
            return $json;
        }
		
        /*$query = Stock::join('stock_quantity', 'stocks.stock_code', '=', 'stock_quantity.stock_code')->groupBy('stock_quantity.stock_code');       
        
        if(!empty($obj->{'variety'})){
            $aVariety = explode(',', $data['variety']);
            $query->whereIn('variety',$aVariety);
        }
        if(!empty(($obj->{'quality'}))){
            $aQuality = explode(',',$data['quality']);
            $query->whereIn('quality',$aQuality);
        }
        if(!empty($obj->{'finish'})){
            $aFinish = explode(',',$data['finish']);
            $query->whereIn('finish',$aFinish);
        }
        if(!empty($obj->{'type'}) && $data['type'] == 'Reel'){
            $type = explode(',',$data['type']);
            $query->whereIn('type',$type);
        }
        
        if(!empty($obj->{'type'}) && $data['type'] == 'Sheet'){
            $query->whereIn('type',['Sheet','Reel']);
        }
        
        //Reel is selected in type and width is left blank
        if(!empty($obj->{'type'}) && $data['type'] == 'Reel' && !empty($obj->{'gsm'})){ 
            $GsmT = Variety::WHERE('variety',$data['variety'])->first();
            $gsm = $GsmT->gsm_tolerance;
            $gsmTolerance = ($gsm * $data['gsm'])/100;
            $min = $data['gsm']-$gsmTolerance;
            $max = $data['gsm']+$gsmTolerance;
            $query->whereBetween('gsm', [$min, $max]);
        }
        
        //Reel is selected in type and reel width is also entered
        if(!empty($obj->{'type'}) && $data['type'] == 'Reel' && !empty($obj->{'size1'}) && empty($obj->{'size2'})){ 
            $GsmT = Variety::WHERE('variety',$data['variety'])->first();
            $size = $GsmT->size_tolerance;
            $sizeTolerance = ($size * $data['size1'])/100;
            $min = $data['size1'];
            $max = $data['size1']+$sizeTolerance;
            $query->whereBetween('size1', [$min, $max]);
        }
        
        //Sheet is selected in type and both width and length fields are left blank
        if(!empty($obj->{'type'}) && $data['type'] == 'Sheet' && !empty($obj->{'gsm'})){ 
            $GsmT = Variety::WHERE('variety',$data['variety'])->first();
            $gsm = $GsmT->gsm_tolerance;
            $gsmTolerance = ($gsm * $data['gsm'])/100;
            $min = $data['gsm']-$gsmTolerance;
            $max = $data['gsm']+$gsmTolerance;
            $query->whereBetween('gsm', [$min, $max]);
        }
        
        //Sheet is selected in type and Width is entered but length is left blank
        if(!empty($obj->{'type'}) && $data['type'] == 'Sheet' && !empty($obj->{'size1'}) && empty($obj->{'size2'})){
            $GsmT = Variety::WHERE('variety',$data['variety'])->first();
            $size = $GsmT->size_tolerance;
            $sizeTolerance = ($size * $data['size1'])/100;
            $min = $data['size1'];
            $max = $data['size1']+$sizeTolerance;
            $query->whereBetween('size1', [$min, $max]);
        }
        
        //Sheet is selected in type and Width is left blank but length is entered
        if(!empty($obj->{'type'}) && $data['type'] == 'Sheet' && !empty($obj->{'size2'}) && empty($obj->{'size1'})){
            $GsmT = Variety::WHERE('variety',$data['variety'])->first();
            $size = $GsmT->size_tolerance;
            $sizeTolerance = ($size * $data['size1'])/100;
            $min = $data['size2'];
            $max = $data['size2']+$sizeTolerance;
            $query->whereBetween('size2', [$min, $max]);
        }
        
        //Both width and length fields are entered
        if(!empty($obj->{'size1'}) && !empty($obj->{'size2'})){
            $GsmT = Variety::WHERE('variety',$data['variety'])->first();
            $size = $GsmT->size_tolerance;
            $sizeTolerance = ($size * $data['size1'])/100;
            $size1 = $data['size1'];
            $size1Max = $data['size1']+$sizeTolerance;
            $size2 = $data['size2'];
            $size2Max = $data['size2']+$sizeTolerance;
            $aData = array();
           
            $secondQuery = clone $query;
            $thirdQuery = clone $query;
            $fourthQuery = clone $query;
            
            $aSizes = $query->whereBetween('size1',[$size1,$size1Max]);
            $aSizes = $query->whereBetween('size2',[$size2,$size2Max])->select('stocks.*', DB::raw('SUM(stock_quantity.quantity) as quantity'))->get();
            array_push($aData, $aSizes->toArray());
            
            //Second Condition            
            $s2 = $size2 / 2;
            $s2_per = ($s2)*($size/100);
            $s2Max = $s2 + $s2_per;

            $aSizes = $secondQuery->whereBetween('size1',[$s2,$s2Max]);
            $aSizes = $secondQuery->whereBetween('size2',[$size1,$size1Max])->select('stocks.*', DB::raw('SUM(stock_quantity.quantity) as quantity'))->get();
            array_push($aData, $aSizes->toArray());

            //Third Condition
            $s1 = $size1 * 2;
            $s1_per = ($s1)*($size/100);
            $s1Max = $s1 + $s1_per;
            $aSizes = $thirdQuery->whereBetween('size1',[$size2,$size2Max]);
            $aSizes = $thirdQuery->whereBetween('size2',[$s1,$s1Max])->select('stocks.*', DB::raw('SUM(stock_quantity.quantity) as quantity'))->get();
            array_push($aData, $aSizes->toArray());
            
            //Fourth Condition
            $aSizes = $fourthQuery->whereBetween('size1',[$size2,$size2Max]);
            $aSizes = $fourthQuery->whereBetween('size2',[$size1,$size1Max])->select('stocks.*', DB::raw('SUM(stock_quantity.quantity) as quantity'))->get();
            array_push($aData, $aSizes->toArray());
            
            $json = response()->json($aData);
            return $json;
        }else{
            $stockList = $query->select('stocks.*', DB::raw('SUM(stock_quantity.quantity) as quantity'))->get()->toArray();
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
        }*/        
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
        
        
//      $oVarities = Variety::with([
//            'qualities' => function ($q) {
//                $q->with(['finish' => function ($q) {
//                    $q->groupby(‘finish’); //constraint on grandchild
//                }])->groupby(’quality'); //constraint on child
//             }
//      ]);
        
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
