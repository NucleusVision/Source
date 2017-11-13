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
use App\Models\OrderApp;
use App\Models\OrderAppItem;
use App\Models\Stock;

class OrderController extends Controller
{
    
    public function create(Request $request) {  
        // Now we can get the content from it
        $content = $request->getContent();

        $obj = json_decode($content);
        
        $data = [
            'USER_ID' => $obj->{'USER_ID'},
            'STOCK_ID' => $obj->{'STOCK_ID'},
            'QUANTITY' => $obj->{'QUANTITY'}
            //'WEIGHT' => $obj->{'WEIGHT'},
            //'SHEET' => $obj->{'SHEET'}        
        ];

        $msg = 'failure';
          
        $userId = $data['USER_ID'];
        $MaxOrderId = Order::max('id');
        $OrderId = 1000 + $MaxOrderId;
        $aStockId = explode(',', $data['STOCK_ID']);
        $aQuantity = explode(',', $data['QUANTITY']);
        //$aWeight = explode(',', $data['WEIGHT']);
        //$aSheets = explode(',', $data['SHEET']);
        
        $aData = [
            'order_id' => $OrderId,
            'user_id' => $userId,
            //'status' => 'Submitted',
            'order_type_from' => 'Mobile',
            'type' => 'Existing'
        ];       
        $oOrderApp = Order::create($aData);
        $iStockCount = count($aStockId);
        for($i=1; $i<=$iStockCount;$i++){
                $j = $i-1;
                $aData = array(
                    'order_app_id' => $oOrderApp->id,
                    'stock_id' => $aStockId[$j],
                    'quantity' => $aQuantity[$j],
                    //'sheets' => $aSheets[$j],
                    //'weight' => $aWeight[$j],
                    'status' => 'Submitted'
                );
                $oOrder = OrderAppItem::create($aData);
        }
        if($oOrder){
            
            $oQuantity = $aQuantity;
            $stockId = $aStockId;
            $stockCount = count($aStockId);
            $oUser = User::select('first_name','last_name')->where('user_id',$userId)->first();
            $items = array();
            for($i=1; $i<=$stockCount;$i++){
                $j = $i-1;
                $oStock = Stock::find($aStockId[$j]);
                $aData = array(
                    'user_name' => trim($oUser->first_name." ".$oUser->last_name),
                    'variety' => $oStock->variety,
                    'mill' => $oStock->mill,
                    'quality' => $oStock->quality,
                    'finish' => ($oStock->finish) ? $oStock->finish:"",
                    'gsm' => $oStock->gsm,
                    'type' => $oStock->type,
                    'size1'=> $oStock->size1,
                    'size2'=> $oStock->size2,
                    'size_type' => $oStock->size_type,
                    'sheets' => $oStock->sheets,
                    'pkt_wt' => $oStock->pkt_wt,
                    'quantity' => $oQuantity[$j],
                );
                array_push($items, $aData);
            }
            
            $data['stocks'] = $items;
            $isMailSent = \Mail::send('emails.order_stock', $data, function ($m) use ($data) {
                                $m->from(env('CONTACT_US_MAIL_FROM'), env('CONTACT_US_MAIL_NAME'));
                                $m->to(env('CONTACT_US_MAIL_TO'))->subject('Order Details');
                            });

            if($isMailSent)
                $msg = "Thank you for placing your valuable order with us. Your order ID is $OrderId. Our team will get in touch with you shortly.";
        }
        return $msg;            
    }
    
    public function getOrders(Request $request) {
        $content = $request->getContent();
        $obj = json_decode($content);
        
        $data = [
            'USER_ID' => $obj->{'USER_ID'}
        ];
        
        $ordersJson = Order::where('user_id',$data['USER_ID'])
                ->where('type','Existing')->with('stockItems')->get();
        
        $newOrders = Order::where('user_id',$data['USER_ID'])
                ->where('type','New')->with('items')->get();
        
        $json = array('newOrders' => $newOrders, 'stockOrders' => $ordersJson);
        
        if(count($ordersJson) > 0){
            $json = response()->json([$json]);
            return $json;
        } else {
            return "No Orders";
        }   
    }
}
