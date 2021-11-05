<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
require_once(__DIR__.'/../../../../vendor/autoload.php');
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
class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth:administrator');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        try{
        $order1 = Order::with('users','locations','payments')
        ->where('orderstatus', 1)
        ->latest()
        ->get();
        $no1 = Order::where('orderstatus', 1)->count();
        $order2 = Order::with('users','locations','payments')
        ->where('orderstatus', 2)
        ->latest()
        ->get();
        $no2 = Order::where('orderstatus', 2)->count();
        $order3 = Order::with('users','locations','payments')
        ->where('orderstatus', 3)
        ->latest()
        ->get();
        $no3 = Order::where('orderstatus', 3)->count();
        $order4 = Order::with('users','locations','payments')
        ->where('orderstatus', 4)
        ->latest()
        ->get();
        $no4 = Order::where('orderstatus', 4)->count();
        $order5 = Order::with('users','cancelledorders','locations','payments')
        ->where('orderstatus', 5)
        ->latest()
        ->get();
        $no5 = Order::where('orderstatus', 5)->count();
        } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        return view('errors.error', compact('error'));
        }
        return view('administrator.orders.orders', compact('order1','order2','order3','order4','order5','no1','no2','no3','no4','no5'));
    }
    public function show(Request $request)
    {   try{
        $order_id = $request->order_id;
        $order = Order::with('orderdetails','product_details')
        ->where('order_id', $order_id)
        ->get();
        } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        return view('errors.error', compact('error'));
        }

        return view('administrator.orders.product-details', compact('order'));
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
    public function CompleteOrder(Request $request){
        try{
        $orderID = $request->order_id;
        $riderID = AssignedOrder::where('order_id', $orderID)->first();
        $userID = Order::where('order_id', $orderID)->first();
        $user_id = $userID->user_id;
        $rider_id = $riderID->rider_id;
        
        $this->Rider_client_Notification($rider_id, $orderID, $user_id);
        
        $order_update = Order::find($orderID);
        $order_update -> orderstatus = 4;
        $order_update -> save();

        $order1 = Order::with('users','locations','payments')
        ->where('orderstatus', 1)
        ->latest()
        ->get();
        $no1 = Order::where('orderstatus', 1)->count();
        $order2 = Order::with('users','locations','payments')
        ->where('orderstatus', 2)
        ->latest()
        ->get();
        $no2 = Order::where('orderstatus', 2)->count();
        $order3 = Order::with('users','locations','payments')
        ->where('orderstatus', 3)
        ->latest()
        ->get();
        $no3 = Order::where('orderstatus', 3)->count();
        $order4 = Order::with('users','locations','payments')
        ->where('orderstatus', 4)
        ->latest()
        ->get();
        $no4 = Order::where('orderstatus', 4)->count();
        $order5 = Order::with('users','cancelledorders','locations','payments')
        ->where('orderstatus', 5)
        ->latest()
        ->get();
        $no5 = Order::where('orderstatus', 5)->count();
        notify()->success('The order is successfully completed!', 'Order completed successfully');
        return view('administrator.orders.orders', compact('order1','order2','order3','order4','order5','no1','no2','no3','no4','no5'));
        } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        return view('errors.error', compact('error'));
        }
    }
    public function confirm(Request $request)
    {   try{
        $order_id = $request->order_id;
        $order = Order::with('orderdetails:image,product_id,product_brand,product_name,refill_new','product_details:order_id,units_order,total_price,created_at')
        ->where('order_id', $order_id)
        ->select('orders.order_id')
        ->get();
        $riders = Currentlocation::with('riders:rider_id,phone,firstname,lastname,image')
        ->whereHas('riders', function($q) {
        $q->where('status', 'on');
         })
        ->where('distance','<=', 20)
        ->orderBy('distance','asc')
        ->get();
        return view('administrator.orders.confirmed-orders', compact('order','riders'));
        } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        return view('errors.error', compact('error'));
        }
 
    }
    public function transit(Request $request)
    {   try{
        $order_id = $request->order_id;
        $order = Order::with('orderdetails:image,product_id,product_brand,product_name,refill_new','product_details:order_id,units_order,total_price,created_at')
        ->where('order_id', $order_id)
        ->select('orders.order_id')
        ->get();
        } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        return view('errors.error', compact('error'));
        }
        return view('administrator.orders.transit-orders', compact('order'));
    }
    public function delivered(Request $request)
    {   try{
        $order_id = $request->order_id;
        $order = Order::with('orderdetails:image,product_id,product_brand,product_name,refill_new','product_details:order_id,units_order,total_price,created_at')
        ->where('order_id', $order_id)
        ->select('orders.order_id')
        ->get();
        } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        return view('errors.error', compact('error'));
        }
        return view('administrator.orders.delivered-orders', compact('order'));
    }
    public function cancelled(Request $request)
    {   try{
        $order_id = $request->order_id;
        $order = Order::with('orderdetails:image,product_id,product_brand,product_name,refill_new','product_details:order_id,units_order,total_price,created_at')
        ->where('order_id', $order_id)
        ->select('orders.order_id')
        ->get();
        } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        return view('errors.error', compact('error'));
        }
        return view('administrator.orders.cancelled-orders', compact('order'));
    }
    public function MpesaReprocess($request)
    {
        $externalmpesaapikey = config('app.externalmpesaapikey');
        $client = new \GuzzleHttp\Client(); 
        $user_id = $request->user_id;
        $amount  = $request->amount;
        $order_id = $request->order_id;
        $response = $client->post(config('app.externla_stkpush_url').'/'.$user_id.'/'.$order_id.'/'.$amount, [
            'headers' => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer '. $externalmpesaapikey,
            ],
        ]
       );
    }
    public function reprocess(Request $request)
    {
        try{
        $order1 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 1)
        ->latest()
        ->get();
        $no1 = Order::where('orderstatus', 1)->count();
        $order2 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 2)
        ->latest()
        ->get();
        $no2 = Order::where('orderstatus', 2)->count();
        $order3 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 3)
        ->latest()
        ->get();
        $no3 = Order::where('orderstatus', 3)->count();
        $order4 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 4)
        ->latest()
        ->get();
        $no4 = Order::where('orderstatus', 4)->count();
        $order5 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 5)
        ->latest()
        ->get();
        $no5 = Order::where('orderstatus', 5)->count();
        $notify = $request->notify;
        switch($notify){
          case 'reprocess':
            $this->MpesaReprocess($request);
            notify()->success(config('app.success'), config('app.success_one'));
          break;
          case '':
          break;
          default:
     }
    return view('administrator.orders.orders', compact('order1','order2','order3','order4','order5','no1','no2','no3','no4','no5'));
    } catch (Throwable $e) {
    $log = new ErrorLog();
    $log-> error_file   = ($e->getFile());
    $log-> error_message    = ($e->getMessage());
    $log-> error_line   = ($e->getLine());
    $log-> error_trace  = $e->getTraceAsString();
    $log->save();
    $error = config('app.error_exception');
    return view('errors.error', compact('error'));
    }
    }
    public function cancelorder($request) {
            $order_id = $request->order_id;
            $stocks = Order::with('product_details')
            ->where('order_id', $order_id)
            ->get();
            $order_cancel = new CancelledOrder;
            $order_cancel -> order_id = $order_id;
            $order_cancel -> user_id = $request -> user_id;
            $order_cancel -> reason = $request -> description;
            $order_cancel -> save();
            $order_update = Order::find($order_id);
            $order_update -> orderstatus = $request -> orderstatus;
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
    public function cancel(Request $request)
    {
        try{
        $order1 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 1)
        ->latest()
        ->get();
        $no1 = Order::where('orderstatus', 1)->count();
        $order2 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 2)
        ->latest()
        ->get();
        $no2 = Order::where('orderstatus', 2)->count();
        $order3 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 3)
        ->latest()
        ->get();
        $no3 = Order::where('orderstatus', 3)->count();
        $order4 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 4)
        ->latest()
        ->get();
        $no4 = Order::where('orderstatus', 4)->count();
        $order5 = Order::with('users','orderdetails','locations','product_details')
        ->where('orderstatus', 5)
        ->latest()
        ->get();
        
        $no5 = Order::where('orderstatus', 5)->count();
        $notify = $request->notify;
        switch($notify){
          case 'cancel':
            $this->cancelorder($request);
           notify()->success(config('app.success_two'), config('app.success_three'));
          
            break;
          case '':
         break;
            default:
        }
        return view('administrator.orders.orders', compact('order1','order2','order3','order4','order5','no1','no2','no3','no4','no5'));
    } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        return view('errors.error', compact('error'));
        }
         
       }

        public function RiderNotification($request){
            
            $notification = new Notification;
            $notification->order_id = $request->order_id;
            $notification->orderstatus = $request->orderstatus;
            $notification->title = $request->title;
            $notification->description = $request->description;            
            $notification->save();
            $notification_id = $notification->order_id;
            $device = DB::table('device_tokens')->where('rider_id','=',$request->rider_id)
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
                'order_id' => $request->order_id,
                'orderstatus' => $request->orderstatus, 
                'title' => $request->title,
                'description' => $request->description,
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
        public function store(Request $request)
        {  
            try{
            $Assigedorders = new AssignedOrder;
            $Assigedorders->order_id = $request->order_id;
            $Assigedorders->rider_id = $request->rider_id;
            $Assigedorders->save();
            $this->RiderNotification($request);
            
            $order1 = Order::with('users','orderdetails','locations','product_details')
            ->where('orderstatus', 1)
            ->latest()
            ->get();
            $no1 = Order::where('orderstatus', 1)->count();
            $order2 = Order::with('users','orderdetails','locations','product_details')
            ->where('orderstatus', 2)
            ->latest()
            ->get();
            $no2 = Order::where('orderstatus', 2)->count();
            $order3 = Order::with('users','orderdetails','locations','product_details')
            ->where('orderstatus', 3)
            ->latest()
            ->get();
            $no3 = Order::where('orderstatus', 3)->count();
            $order4 = Order::with('users','orderdetails','locations','product_details')
            ->where('orderstatus', 4)
            ->latest()
            ->get();
            $no4 = Order::where('orderstatus', 4)->count();
            $order5 = Order::with('users','orderdetails','locations','product_details')
            ->where('orderstatus', 5)
            ->latest()
            ->get();
            $no5 = Order::where('orderstatus', 5)->count();
            notify()->success('The order is successfully assigned to the Rider!', 'Order Assigned Successfully');
            return view('administrator.orders.orders', compact('order1','order2','order3','order4','order5','no1','no2','no3','no4','no5'));
            } catch (Throwable $e) {
            $log = new ErrorLog();
            $log-> error_file   = ($e->getFile());
            $log-> error_message    = ($e->getMessage());
            $log-> error_line   = ($e->getLine());
            $log-> error_trace  = $e->getTraceAsString();
            $log->save();
            $error = config('app.error_exception');
            return view('errors.error', compact('error'));
            } 
        }
        public  function saveToken(Request $request){
            return view('firebase');
        }

        public  function Token(Request $request){
            try{
            if(DB::table('web_tokens')->where('token', $request->token )->exists()){
                
            } else {
                //$value = \Session::get('key');
                //$userId = Administrator::where('email',$value)->first();
                $token = $request->token; 
                DB::table('web_tokens')->insert([
                    'token' => $request->token,
                    'adminId' => config('app.status'),
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            }
            } catch (Throwable $e) {
            $log = new ErrorLog();
            $log-> error_file   = ($e->getFile());
            $log-> error_message    = ($e->getMessage());
            $log-> error_line   = ($e->getLine());
            $log-> error_trace  = $e->getTraceAsString();
            $log->save();
            $error = config('app.error_exception');
            return view('errors.error', compact('error'));
            } 
            
        }
       
}
