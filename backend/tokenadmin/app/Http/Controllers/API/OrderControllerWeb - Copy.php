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
        
        try {
        
        DB::beginTransaction();
        
        // Now we can get the content from it
        $content = $request->getContent();

        $obj = json_decode($content);

        $data = [
            'USER_ID' => $obj->{'USER_ID'},
            'MILL_ID' => $obj->{'USER_ID'},
            'QUALITY_ID' => $obj->{'QUALITY_ID'},
            'FINISH_ID' => $obj->{'FINISH_ID'},
            'BILLING_ON' => $obj->{'BILLING_ON'},
            'DELIVERY_AT' => $obj->{'DELIVERY_AT'},
            'MODVAT_REQUIRED' => $obj->{'MODVAT_REQUIRED'},
            'MANUFACTURER' => $obj->{'MANUFACTURER'},
            'QUALITY' => $obj->{'QUALITY'},
            'FINISH' => $obj->{'FINISH'},
            'GSM' => $obj->{'GSM'},
            'TYPE' => $obj->{'TYPE'},
            'WIDTH' => $obj->{'WIDTH'},
            'DIAMETER_LENGTH' => $obj->{'DIAMETER_LENGTH'},
            'GRAIN_DIRECTION' => $obj->{'GRAIN_DIRECTION'},
            'NUMBER_OF_SHEETS' => $obj->{'NUMBER_OF_SHEETS'},
            'QUANTITY' => $obj->{'QUANTITY'},
            'DATE' => $obj->{'DATE'},
            'PRICE' => $obj->{'PRICE'},
            'PAYMENTS' => $obj->{'PAYMENTS'},
            'TAX' => $obj->{'TAX'},
            'REMARKS' => $obj->{'REMARKS'},
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
        
            $aMillId = '';
            $aQualityId = '';
            $aFinishId = '';
        
//            if(!empty($data['MANUFACTURER'])){
//                $aMillId = Mill::where('unit_name', $data['MANUFACTURER'])->value('mill_id');
//            }
//            if(!empty($data['QUALITY'])){
//                $aQualityId = Quality::where('quality', $data['QUALITY'])->value('quality_id');
//            }
//            if(!empty($data['FINISH'])){
//                $aFinishId = Finish::where('finish', $data['FINISH'])->value('finish_id');
//            }
            
            $aMillId = $data['MILL_ID'];
            $aQualityId = $data['QUALITY_ID'];
            $aFinishId = $data['FINISH_ID'];
            $aGsm = $data['GSM'];
            $aItemType = $data['TYPE'];
            $aWidth = $data['WIDTH'];
            $aLength = $data['DIAMETER_LENGTH'];
            $aGrainDir = $data['GRAIN_DIRECTION'];
            $aSheets = $data['NUMBER_OF_SHEETS'];
            $aQuantity = $data['QUANTITY'];
            $aDelivaryDate = $data['DATE'];
            $aPrize = $data['PRICE'];
            $aPaymentTerms = $data['PAYMENTS'];
            $aTax = $data['TAX'];
            $aRemarks = $data['REMARKS'];

            $aOrderItems = array(
                'order_id' => $oOrderId,  
                'mill_id' => $aMillId,
                'quality_id' => $aQualityId,
                'finish_id' => $aFinishId,
                'gsm' => $aGsm,
                'item_type' => $aItemType,
                'width' => $aWidth,
                'length' => $aLength,
                'grain_direction' => $aGrainDir,
                'no_of_sheets' => $aSheets,
                'quantity' => $aQuantity,
                'expected_delivery_date' => Carbon::createFromFormat('m-d-Y', trim($aDelivaryDate))->format('Y-m-d'),
                'prize' => $aPrize,
                'payment_terms' => $aPaymentTerms,
                'tax' => $aTax,
                'remarks' => $aRemarks,
            );
            
            $oOrderItem = OrderItem::create($aOrderItems);
           
           $data['EMAIL'] = "naveenm.lst01@gmail.com";
           
           if($oOrder && $oOrderItem){
               DB::commit();
               $msg = 'Thank you for placing your valuable order with us. Your order ID is '.$OrderId.'.Our team will get in touch with you shortly.';
           }
               
        } catch (\Exception $e) {
            DB::rollBack();
        }
        
        try{    
           
            $oMill = Mill::find($data['MILL_ID']);
            $oQuality = Quality::find($data['QUALITY_ID']);
            $oFinish = Finish::find($data['FINISH_ID']);
            $oUser = User::find($data['USER_ID']);
            
            
            $data['MANUFACTURER'] = ($oMill) ? $oMill->unit_name : "";
            $data['QUALITY'] = ($oQuality) ? $oQuality->quality : "";
            $data['FINISH'] = ($oFinish) ? $oFinish->finish : "";
            $data['CREATED_BY'] = ($oUser) ? trim($oUser->first_name." ".$oUser->last_name) : "";
            $data['CREATED_AT'] = date('Y-m-d');
            
            $isMailSent = \Mail::send('emails.order_details', $data, function ($m) use ($data) {
                                $m->from(env('CONTACT_US_MAIL_FROM'), env('CONTACT_US_MAIL_NAME'));
                                $m->to($data['EMAIL'])->subject('Order Details');
                            });

            //if($isMailSent)
                
        } catch (\Exception $ex) {
            
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
