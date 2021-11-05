<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\ErrorLog;
use Throwable;
use DB;
class ProductsController extends Controller
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
        $prod = Product::latest()->get();
        $vendor = Vendor::latest()->get();
        return response()->json([
            'data'=> $prod,
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'refill_new' => 'required',
            'vendor_id' => 'required',
            'product_brand' => 'required',
            'product_size' => 'required',
            'product_type' => 'required',
            'unit_price' => 'required',
            'selling_price' => 'required',
            'reorder_level' => 'required',
            'photo' => 'required',

        ]);
        if(Product::where('vendor_id', $request->vendor_id)
        ->where('refill_new', $request->refill_new)
        ->where('product_size', $request->product_size)
        ->exists())
        {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
            ], 402);
        }else{

        $image = $request->photo;  // your base64 encoded
        $data = explode( ',', $image );
        $imageName = rand().'.jpg';
        $products = config('app.products');
        $filenamephoto=$products.'/'. $imageName;
        Storage::disk('s3')->put($filenamephoto, base64_decode($data[1]), 'public');

        $url = config('app.aws_url');
        $photourl= $url.$filenamephoto;
        $product = new Product;
        $product->product_name = $request->product_brand .'  '.$request->product_size;
        $product->refill_new = $request->refill_new;
        $product->vendor_id = $request->vendor_id;
        $product->product_brand = $request->product_brand;
        $product->product_size = $request->product_size;
        $product->product_type = $request->product_type;
        $product->unit_price = $request->unit_price;
        $product->selling_price = $request->selling_price;
        $product->reorder_level = $request->reorder_level;
        $product->image= $photourl;
        $product->save();
        return $product->id;
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
    public function update(Request $request, $product_id)
    {
            $validator = $this->validate($request, [
                'refill_new' => 'required',
                'vendor_id' => 'required',
                'product_brand' => 'required',
                'product_size' => 'required',
                'product_type' => 'required',
                'unit_price' => 'required',
                'selling_price' => 'required',
                'reorder_level' => 'required',
            ]);
            $product = Product::findOrFail($product_id);
            $product->product_name = $request->product_brand .'  '.$request->product_size;
            $product->refill_new = $request->refill_new;
            $product->vendor_id = $request->vendor_id;
            $product->product_brand = $request->product_brand;
            $product->product_size = $request->product_size;
            $product->product_type = $request->product_type;
            $product->unit_price = $request->unit_price;
            $product->selling_price = $request->selling_price;
            $product->reorder_level = $request->reorder_level;
            if(empty($request->photo)){
                $product->save();
            }else{
                $image = $request->photo;  // your base64 encoded
                $data = explode( ',', $image );
                $imageName = rand().'.jpg';
                $products = config('app.products');
                $filenamephoto=$products.'/'. $imageName;
                Storage::disk('s3')->put($filenamephoto, base64_decode($data[1]), 'public');
                $url = config('app.aws_url');
                $imageurl= $url.$filenamephoto;
                $product->image = $imageurl;
                $product->save();
            }
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
