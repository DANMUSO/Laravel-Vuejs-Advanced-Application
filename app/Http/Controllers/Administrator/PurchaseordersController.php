<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Models\Purchaseorder;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Stocks;
use App\Models\ErrorLog;
use Throwable;
use DB;
class PurchaseordersController extends Controller
{
    public function __construct(){
        $this->middleware('auth:administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        try{
            $purchaseorders = Purchaseorder::with('products')
            ->whereRaw('porder_id IN(select MAX(porder_id) FROM purchaseorders GROUP BY product_id)')
            ->get();
        return view('administrator.purchaseorders.purchaseorders', compact('purchaseorders'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   try{
        $vendors = Vendor::all();
        $products = Product::all();
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
        return view('administrator.purchaseorders.create-purchaseorder',  compact('vendors','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Purchaseorder $purchaseorder)
    {
        try{
        $stock = Stocks::where('product_id','=', $request -> product_name)
        ->orderBy('created_at', 'desc')
        ->first();
        if(empty($stock)){
            $purchaseorder -> product_brand = $request -> product_brand;
            $purchaseorder -> product_id = $request -> product_name;
            $purchaseorder -> quantity = $request -> quantity;
            $purchaseorder -> unit_price = $request -> unit_price;
            $purchaseorder -> tax = $request -> tax;
            $purchaseorder -> total = $request -> total;
            $purchaseorder -> dop = $request -> dop;
            $purchaseorder -> ordernumber = $request -> ordernumber;
            $purchaseorder ->save();
    
            DB::table('stocks')->insert([
                'purchaseorder_id'=>$purchaseorder->porder_id,
                'product_id'=>$request->product_name,
                'quantity' => $request -> quantity,
                'stock_quantity' => $request -> quantity,
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }else{
            $q = $request -> quantity + $stock->stock_quantity;
            $purchaseorder-> product_brand = $request -> product_brand;
            $purchaseorder -> product_id = $request -> product_name;
            $purchaseorder -> quantity = $q;
            $purchaseorder -> unit_price = $request -> unit_price;
            $purchaseorder -> tax = $request -> tax;
            $purchaseorder -> total = $request -> total;
            $purchaseorder -> dop = $request -> dop;
            $purchaseorder -> ordernumber = $request -> ordernumber;
            $purchaseorder ->save();
    
            DB::table('stocks')->insert([
                'purchaseorder_id'=>$purchaseorder->porder_id,
                'product_id'=>$request->product_name,
                'quantity' => $q,
                'stock_quantity' => $q,
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }
        
        $msg = config('app.purchase_add');
     
        if (session('key', $msg)) {
        Alert::success('Success!', session('key', $msg));
        }
        return redirect('administrator/purchaseorders/create');
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
    public function select(Request $request){
        try{
        if($request->ajax()) {
        return response()->json([
            
        'products' => Product::where("vendor_id",$request->vendor_id)
        ->get()
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
      
   
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($porder_id)
    {   try{
        $purchaseorders = Purchaseorder::findOrFail($porder_id);
        $vendors =Vendor::all();
        $products = Product::all();
        $stocks = DB::table('stocks')->where('purchaseorder_id','=',$porder_id)
        ->select('stock_quantity')
        ->orderBy('created_at','desc')
        ->first();
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
      
        return view('administrator.purchaseorders.edit-purchaseorder',  compact('vendors','products','purchaseorders','stocks'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $porder_id)
    {   try{
        $purchaseorder = Purchaseorder::find($porder_id);
        $purchaseorder-> product_brand = $request -> product_brand;
        $purchaseorder -> product_id = $request -> product_name;
        $purchaseorder -> quantity = $request -> quantity;
        $purchaseorder -> unit_price = $request -> unit_price;
        $purchaseorder -> tax = $request -> tax;
        $purchaseorder -> total = $request -> total;
        $purchaseorder -> dop = $request -> dop;
        $purchaseorder -> ordernumber = $request -> ordernumber;
        $purchaseorder -> save();
        DB::table('stocks')->insert([
            'purchaseorder_id'=>$purchaseorder->porder_id,
            'product_id'=>$request->product_name,
            'quantity' => $request -> quantity,
            'stock_quantity' => $request -> quantity,
            'created_at' => date("Y-m-d H:i:s")
        ]);
       $msg = config('app.purchase_update');
       } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        return view('administrator.purchaseorders.purchase');
        }
       if (session('key', $msg)) {
       Alert::success('Success!', session('key', $msg));
       }
         return redirect('administrator/purchaseorders')->with('success', config('app.success_purchaseorder'));
         
    }

}
