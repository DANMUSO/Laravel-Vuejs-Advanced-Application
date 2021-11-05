<?php

namespace App\Http\Controllers\Admin\API;

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
        try{
            $purchaseorder = Purchaseorder::with('products')
            ->whereRaw('porder_id IN(select MAX(porder_id) FROM purchaseorders GROUP BY product_id)')
            ->latest()
            ->get();
            $vendor = Vendor::latest()->get();
            return response()->json([
                'data'=> $purchaseorder,
                'vendor' =>$vendor
               ], 200);
            } catch (\Throwable $e) {
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
  
    public function getVendors(){
        $data = Vendor::get();
   
        return response()->json($data);

    }
    public function getProducts(Request $request){
        $data = Product::where('vendor_id', $request->vendor_id)->get();
   
        return response()->json($data);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Purchaseorder $purchaseorder)
    {
        $validator = $this->validate($request, [
            'product_name' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'tax' => 'required',
            'dop' => 'required',
            'ordernumber' => 'required',

        ]);
      $data = Product::where('product_id', $request->product_name)->select('vendor_id')->get();
      foreach($data as $v){
          $vendor_id = $v->vendor_id;
      }
      $stock = Stocks::where('product_id','=', $request -> product_name)
        ->orderBy('created_at', 'desc')
        ->first();
        if(empty($stock)){
            $purchaseorder -> product_brand = $vendor_id;
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
            $purchaseorder-> product_brand = $vendor_id;
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
    public function update(Request $request, $porder_id)
    {
        $data = Product::where('product_id', $request->product_name)->select('vendor_id')->get();
        foreach($data as $v){
            $vendor_id = $v->vendor_id;
        }
        $purchaseorder = Purchaseorder::find($porder_id);
        $purchaseorder-> product_brand = $v->vendor_id;
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
