<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Mill;
use App\Models\Quality;
use App\Models\Finish;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderControllerWeb extends Controller
{
    
    public function create(Request $request) { 
        $msg = "";
        $items = array();
        
        try {
        
        DB::beginTransaction();
        
        // Now we can get the content from it
        $content = $request->getContent();

        $obj = json_decode($content);
        
        $data = [
            'USER_ID' => $obj->{'USER_ID'},
            'BILLING_ON' => $obj->{'BILLING_ON'},
            'DELIVERY_AT' => $obj->{'DELIVERY_AT'},
            'MODVAT_REQUIRED' => $obj->{'MODVAT_REQUIRED'},
            'items' => $obj->{'items'}
        ];

        $msg = 'failure';
        
        $userId = $data['USER_ID'];
        $MaxOrderId = Order::max('id');
        $OrderId = 1000 + $MaxOrderId;
        $aData = array(
            'order_id' => $OrderId,
            'billing_on' => $data['BILLING_ON'],
            'delivery_at' => $data['DELIVERY_AT'],
            'mod_vat_consignee' => $data['MODVAT_REQUIRED'],
            'user_id' => $userId,
            'order_type_from' => 'Mobile',
            'type' => 'New'
        );
        
        $oOrder = Order::create($aData);
        $oOrderId = $oOrder->id;
        
        $itemsCount = count($data['items']);
        
        
        foreach($data['items'] as $item){

            $aOrderItems = array(
                'order_id' => $oOrderId,  
                'mill_id' => $item->MILL_ID,
                'quality_id' => $item->QUALITY_ID,
                'finish_id' => $item->FINISH_ID,
                'gsm' => $item->GSM,
                'item_type' => $item->TYPE,
                'width' => $item->WIDTH,
                'length' => $item->DIAMETER_LENGTH,
                'grain_direction' => $item->GRAIN_DIRECTION,
                'no_of_sheets' => $item->NUMBER_OF_SHEETS,
                'quantity' => $item->QUANTITY,
                'expected_delivery_date' => Carbon::createFromFormat('m-d-Y', trim($item->DATE))->format('Y-m-d'), 
                'prize' => $item->PRICE,
                'payment_terms' => $item->PAYMENTS,
                'tax' => $item->TAX,
                'remarks' => $item->REMARKS,
            );
            
            array_push($items, $aOrderItems);
            $oOrderItem = OrderItem::create($aOrderItems);
                     
        }


       if($oOrder){
           DB::commit();
           $msg = 'Thank you for placing your valuable order with us. Your order ID is '.$OrderId.'.Our team will get in touch with you shortly.';
       }

    } catch (\Exception $e) {
        //dd($e->getMessage());
        DB::rollBack();
    }
    

    try{
        
        $newItems = array_map(function($value){
        $oMill = Mill::find($value['mill_id']);
        $oQuality = Quality::find($value['quality_id']);
        $oFinish = Finish::find($value['finish_id']);

        $value['manufacturer'] = ($oMill) ? $oMill->unit_name : "";
        $value['quality'] = ($oQuality) ? $oQuality->quality : "";
        $value['finish'] = ($oFinish) ? $oFinish->finish : "";
        
        return $value;
        
        }, $items);
        

        $data['items'] = $newItems;
        $data['EMAIL'] = "naveenm.lst01@gmail.com";
        $oUser = User::find($data['USER_ID']);
        $data['CREATED_BY'] = ($oUser) ? trim($oUser->first_name." ".$oUser->last_name) : "";
        $data['CREATED_AT'] = date('m-d-Y');
        
           /*
            $oMill = Mill::find($data['MILL_ID']);
            $oQuality = Quality::find($data['QUALITY_ID']);
            $oFinish = Finish::find($data['FINISH_ID']);
            
            
            
            $data['MANUFACTURER'] = ($oMill) ? $oMill->unit_name : "";
            $data['QUALITY'] = ($oQuality) ? $oQuality->quality : "";
            $data['FINISH'] = ($oFinish) ? $oFinish->finish : "";
            */
            
            $isMailSent = \Mail::send('emails.order_details', $data, function ($m) use ($data) {
                                $m->from(env('CONTACT_US_MAIL_FROM'), env('CONTACT_US_MAIL_NAME'));
                                $m->to($data['EMAIL'])->subject('Order Details');
                            });    
             
        } catch (\Exception $ex) {
            //dd($ex->getMessage());
        }
        
        return $msg;
            
    }
    
    public function getOrders(Request $request) {
        // Now we can get the content from it
        $content = $request->getContent();
        $obj = json_decode($content);
        $data = [
            'USER_ID' => $obj->{'USER_ID'}
        ];
        
        $ordersJson = Order::with('items')->get()->toJson();
        return $ordersJson;   
    }
    
    public function getMills(Request $request) {
        $oMills = Mill::select('mill_id', 'unit_name')->orderBy('unit_name', 'ASC')->get();
        return response()->json(['mills'=>$oMills]);
    }
    
    public function getQualityByMill(Request $request) {
        $content = $request->getContent(); 
        $obj = json_decode($content);
        
        $data = [
            'mill_id' => $obj->{'mill_id'}
        ];   
        
        //$aMills = explode(',', $data['mill_id']);
        $oQualities = Quality::select('quality_id', 'quality_code', 'quality')->where('mill_id', $data['mill_id'])->orderBy('quality', 'ASC')->get();
        if(empty($obj->{'mill_id'})){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }
        
        if(count($oQualities) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }else{
            $json = response()->json(array('quality'=>$oQualities));
            return $json;
        }
    }
    
    public function getFinishByQuality(Request $request) {
        $content = $request->getContent(); 
        $obj = json_decode($content);
        
        $data = [
            'quality_id' => $obj->{'quality_id'}
        ];   
        
        //$aQualities = explode(',', $data['quality_id']);
        $oFinishes = Finish::select('finish_id', 'finish')->where('quality_id', $data['quality_id'])->orderBy('finish', 'ASC')->get();
        if(empty($obj->{'quality_id'})){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }
        
        if(count($oFinishes) == 0){
            $status = [
                'status' => '200',
                'message' => 'Not Found'
            ];
            $json = response()->json($status);
            return $json;
        }else{
            $json = response()->json(array('finish'=>$oFinishes));
            return $json;
        }
    }
    
    public function getList(){
        
        $oVarities = Mill::with([
            'qualities' => function ($q) {
                $q->groupby('quality'); 
            },'qualities.finish' => function ($q) {
                    $q->groupby('quality_id','finish'); 
            }
        ])->get();
        
        $json = response()->json($oVarities);
        return $json;
    }
  
}
