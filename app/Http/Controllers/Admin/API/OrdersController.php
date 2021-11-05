<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
require_once(__DIR__.'/../../../../../vendor/autoload.php');
use AfricasTalking\SDK\AfricasTalking;
use Http\Adapter\BuzzAdapter;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Order;
use App\Models\User;
use App\Models\Orderdetail;
use App\Models\Location;
use App\Models\Product;
use App\Models\ErrorLog;
use App\Models\Rider;
use App\Models\Device;
use App\Models\Currentlocation;
use App\Models\Notification;
use App\Models\AssignedOrder;
use App\Models\CancelledOrder;
use App\Models\Administrator;
use Throwable;
use DB; 
class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order1 = Order::with('users','locations','payments')
        ->where('orderstatus', 1)
        ->latest()
        ->get();
        $order2 = Order::with('users','locations','payments')
        ->where('orderstatus', 2)
        ->latest()
        ->get();
        $order3 = Order::with('users','locations','payments')
        ->where('orderstatus', 3)
        ->latest()
        ->get();
        $order4 = Order::with('users','locations','payments')
        ->where('orderstatus', 4)
        ->latest()
        ->get();
        $order5 = Order::with('users','locations','payments')
        ->where('orderstatus', 5)
        ->latest()
        ->get();
        $no1 = Order::where('orderstatus', 1)->count();
        $no2 = Order::where('orderstatus', 2)->count();
        $no3 = Order::where('orderstatus', 3)->count();
        $no4 = Order::where('orderstatus', 4)->count();
        $no5 = Order::where('orderstatus', 5)->count();
        $response['no1'] = $no1;
        $response['no2'] = $no2;
        $response['no3'] = $no3;
        $response['no4'] = $no4;
        $response['no5'] = $no5;
        $responses['order1'] = $order1;
        $responses['order2'] = $order2;
        $responses['order3'] = $order3;
        $responses['order4'] = $order4;
        $responses['order5'] = $order5;

        return response()->json([
            'data'=> $responses,
            'number' => $response,
           ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function failedorder(Request $request, $order_id){

        $order = Orderdetail::with('orders','products')
        ->where('order_id', $order_id)
        ->get();

        return response()->json([
            'data'=> $order,
           ], 200);

    }
    public function confirmedorder(Request $request, $order_id){

        $order = Orderdetail::with('orders','products')
        ->where('order_id', $order_id)
        ->get();
        $riders = Currentlocation::with('riders:rider_id,phone,firstname,lastname,image')
        ->whereHas('riders', function($q) {
        $q->where('status', 'on');
         })
        ->where('distance','<=', 20)
        ->orderBy('distance','asc')
        ->get();
        return response()->json([
            'data'=> $order,
            'riders'=> $riders,
           ], 200);

    }
    public function RiderNotification($orderId,$riderId){
            
        $notification = new Notification;
        $notification->order_id = $orderId;
        $notification->orderstatus = 2;
        $notification->title = "Xoom Gas";
        $notification->description = "This order have been assigned to you.";            
        $notification->save();
        $notification_id = $notification->order_id;

        $device = DB::table('device_tokens')->where('rider_id','=',$riderId)
        ->orderBy('created_at', 'desc')
        ->first();
        $devicetoken = '';
            if(!$device) {
            }else{
                $devicetoken= $device->token;
            }
            $fcm_api_key = config('app.fcmapiaccesskey');
            define('API_ACCESS_KEY',$fcm_api_key);
            $fcmUrl = config('app.fcm_send_url');
            $token=$devicetoken;

            $notification = [
            'notification_id' =>$notification_id,
            'order_id' => $notification->order_id,
            'orderstatus' => $notification->orderstatus, 
            'title' => $notification->title,
            'description' => $notification->description,
            'date' => $notification->created_at,
             ];
             //echo json_encode($notification, JSON_PRETTY_PRINT);

            $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'data' => $notification
            ];

            $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
            ];


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
            $result = curl_exec($ch);
            curl_close($ch);
            //echo  $result;
    }
    public function transit(Request $request, $ids){
        $id  = $ids;
        $values = explode(" ", $id);
        $orderId = $values[0];
        $riderId = $values[1];
        $Assigedorders = new AssignedOrder;
        $Assigedorders->order_id = $orderId;
        $Assigedorders->rider_id = $riderId;
        $Assigedorders->save();
        $this->RiderNotification($orderId,$riderId);


    }
    public function reprocesspayment($order_id){
        $order = Order::select('user_id','order_id','totalprice')->where('order_id', $order_id)->get();
        
        foreach($order as $payment){
          
        }
        $externalmpesaapikey = config('app.externalmpesaapikey');
        $client = new \GuzzleHttp\Client(); 
        $user_id = $payment->user_id;
        $amount  = $payment->totalprice;
        $order_id = $payment->order_id;
        $response = $client->post(config('app.externla_stkpush_url').'/'.$user_id.'/'.$order_id.'/'.$amount, [
            'headers' => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer '. $externalmpesaapikey,
            ],
        ]
       );
    }
    public function cancelfailedorder($order_id){
        $order = Order::select('user_id')->where('order_id', $order_id)->get();
        foreach($order as $cancel){
          
        }

        $stocks = Order::with('product_details')
        ->where('order_id', $order_id)
        ->get();
        $order_cancel = new CancelledOrder;
        $order_cancel -> order_id = $order_id;
        $order_cancel -> user_id = $cancel -> user_id;
        $order_cancel -> reason = "The order have been cancelled by Admin.";
        $order_cancel -> save();
        $order_update = Order::find($order_id);
        $order_update -> orderstatus =5;
        $order_update -> save();
        foreach($stocks as $stock)
        {
            foreach($stock->product_details as $productdetails)
            {
               $qty = DB::table('stocks')->where('product_id', $productdetails->product_id)->get();
               
               foreach($qty as $q){}
               
                DB::table('stocks')->insert([
                    'order_id'=> $productdetails->order_id,
                    'product_id' => $productdetails->product_id,
                    'quantity' =>$q->quantity,
                    'purchaseorder_id' =>$q->purchaseorder_id,
                    'stock_quantity'=> $q->stock_quantity + $productdetails->units_order
                    ]);
            }
        }
     }
     
    
    public function Rider_client_Notification($rider_id, $orderID, $user_id){
    
       

        $fcm_api_key = config('app.fcmapiaccesskey');
            define('API_ACCESS_KEY',$fcm_api_key);
            $fcmUrl = config('app.fcm_send_url');
            

        $device = DB::table('device_tokens')->where('rider_id','=',$rider_id)
        ->orderBy('created_at', 'desc')
        ->first();
        $devicetoken = '';
            if(!$device) {
            }else{
                                    
                $notification = new Notification;
                $notification->order_id = $orderID;
                $notification->orderstatus = config('app.status_2');
                $notification->title = config('app.title');
                $notification->description = config('app.description');            
                $notification->save();
                $notification_id = $notification->order_id;
                $devicetoken= $device->token;
                $token=$devicetoken;
                $notification = [
                    'notification_id' =>$notification_id,
                    'order_id' => $notification->order_id,
                    'orderstatus' => $notification->orderstatus, 
                    'title' => $notification->title,
                    'description' => $notification->description,
                    'date' => $notification->created_at,
                 ];
                 //echo json_encode($notification, JSON_PRETTY_PRINT);
    
                $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
                'to'        => $token, //single token
                'data' => $notification
                ];
    
                $headers = [
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
                ];
    
    
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                $result = curl_exec($ch);
                curl_close($ch);
                //echo  $result;
            }
        $device = DB::table('device_tokens')->where('user_id','=',$user_id)
       ->orderBy('created_at','desc')
       ->first();
       $devicetoken = '';
       if(empty($device))
       {
          $devicetoken;
       }else{
                   
            $notification = new Notification;
            $notification->order_id = $orderID;
            $notification->orderstatus = config('app.status_2');
            $notification->title = config('app.title');
            $notification->description = config('app.clienDdescription');            
            $notification->save();
            $notification_id = $notification->order_id;
          $devicetoken = $device->token;
          $token=$devicetoken;
          $notification = [
            'notification_id' =>$notification_id,
            'order_id' => $notification->order_id,
            'orderstatus' => $notification->orderstatus, 
            'title' => $notification->title,
            'description' => $notification->description,
            'date' => $notification->created_at,
         ];
         //echo json_encode($notification, JSON_PRETTY_PRINT);

        $fcmNotification = [
        //'registration_ids' => $tokenList, //multple token array
        'to'        => $token, //single token
        'data' => $notification
        ];

        $headers = [
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
        //echo  $result;
       }
       
    }

     public function CompleteOrder($order_id){
        $orderID = $order_id;
        $riderID = AssignedOrder::where('order_id', $orderID)->first();
        $userID = Order::where('order_id', $orderID)->first();
        $user_id = $userID->user_id;
        $rider_id = $riderID->rider_id;
        
        $this->Rider_client_Notification($rider_id, $orderID, $user_id);
        
        $order_update = Order::find($orderID);
        $order_update -> orderstatus = 4;
        $order_update -> save();
       
     }
    public function transitorder(Request $request, $order_id){

        $order = Orderdetail::with('orders','products')
        ->where('order_id', $order_id)
        ->get();
        return response()->json([
            'data'=> $order,
           ], 200);

    }
    public function completedorder(Request $request, $order_id){

        $order = Orderdetail::with('orders','products')
        ->where('order_id', $order_id)
        ->get();
        return response()->json([
            'data'=> $order,
           ], 200);

    }
    public function cancelledorder(Request $request, $order_id){

        $order = Orderdetail::with('orders','products')
        ->where('order_id', $order_id)
        ->get();
        return response()->json([
            'data'=> $order,
           ], 200);

    }
    
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
