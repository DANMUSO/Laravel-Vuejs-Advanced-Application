<?php

namespace App\Http\Controllers\Administrator;

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
    public function __construct(){
        $this->middleware('auth:administrator');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request) {
        $product = Product::findOrFail($request->product_id);
        $product -> status = config('app.status'); 
        $product->update();
        $no = Product::where('status', config('app.status_1'))->count();
          $no1 = Product::where('status', config('app.status'))->count();
          $products = Product::where('status', config('app.status_1'))->orderBy('product_type', 'DESC')
          ->orderBy('product_brand', 'ASC')
          ->orderBy('unit_price', 'ASC')
          ->get();
          $products_d = Product::where('status', config('app.status'))->orderBy('product_type', 'DESC')
          ->orderBy('product_brand', 'ASC')
          ->orderBy('unit_price', 'ASC')
          ->get();
        return view('administrator.products.products-table', compact('products','products_d','no','no1'))->render();
    }
    public function activate(Request $request) {
        $product = Product::findOrFail($request->product_id);
        $product -> status = config('app.status_1'); 
        $product->update();
        $no = Product::where('status', config('app.status_1'))->count();
        $no1 = Product::where('status', config('app.status'))->count();
        $products = Product::where('status', config('app.status_1'))->orderBy('product_type', 'DESC')
        ->orderBy('product_brand', 'ASC')
        ->orderBy('unit_price', 'ASC')
        ->get();
        $products_d = Product::where('status', config('app.status'))->orderBy('product_type', 'DESC')
        ->orderBy('product_brand', 'ASC')
        ->orderBy('unit_price', 'ASC')
        ->get();
      return view('administrator.products.products-table', compact('products','products_d','no','no1'))->render();
  
        
        
    }
    public function index()
    {
        try{
          $no = Product::where('status', config('app.status_1'))->count();
          $no1 = Product::where('status', config('app.status'))->count();
          $products = Product::where('status', config('app.status_1'))->orderBy('product_type', 'DESC')
          ->orderBy('product_brand', 'ASC')
          ->orderBy('unit_price', 'ASC')
          ->get();
          $products_d = Product::where('status', config('app.status'))->orderBy('product_type', 'DESC')
          ->orderBy('product_brand', 'ASC')
          ->orderBy('unit_price', 'ASC')
          ->get();
        return view('administrator.products.products', compact('products','products_d','no','no1'));
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
        $files = Storage::files('images');
        $images = [];
        foreach ($files as $file) {
        array_push($images, Storage::url($file));
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
        $vendors = DB::table('vendors')->get();
        $vendor_name = "";
        return view('administrator.products.create-product',['images'=>$images], compact('vendors','vendor_name'))->with('vendors', $vendors);
        
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        try{  

         if(Product::where('vendor_id', $request->vendor_id)
        ->where('refill_new', $request->refill_new)
        ->where('product_size', $request->product_size)
        ->exists())
        {
                    $vn = Vendor::where('vendor_id','=',$request->vendor_id)->get();
                
                    foreach($vn as $v){
                        $vendor_name = $v ->vendor_name;
                    }
                    $image = $request->old('image');
                    if (session('key', 'Product exist')) {
                        Alert::warning('Warning!', session('key', 'Product exist'));
                    }
                    $vendors = DB::table('vendors')->get();
                    return redirect()->back()->with(['data' => $vendor_name])->with('vendors', $vendors)->withInput();
                
                }
                else{
                if ($request->hasFile('image')) {
                $file = $request->file('image');
                $product_brand = $_POST['product_brand'];
                $name = $file->getClientOriginalName();
                $filePath = $product_brand. '/'. $name;
                Storage::disk('s3')->put($filePath, file_get_contents($file),'public');
                    
                }
                
                $image_name = $request->hidden_image;
                $image = $request->file('image');
                if ($image != '')
                {
                $image_name =$image->getClientOriginalName();
                $image->move(public_path('images'), $image_name);
                }
        
                $url = config('app.aws_url');
                $photo= $url.$product_brand.'/'.$image_name;
                $product = new Product;
                $product->product_name = $request->product_name;
                $product->refill_new = $request->refill_new;
                $product->vendor_id = $request->vendor_id;
                $product->product_brand = $request->product_brand;
                $product->product_size = $request->product_size;
                $product->product_type = $request->product_type;
                $product->unit_price = $request->unit_price;
                $product->selling_price = $request->selling_price;
                $product->reorder_level = $request->reorder_level;
                $product->status = config('app.status_1');
                $product->image= $photo;
                $product->save();
                $msg = config('app.product_add');
                 
                if (session('key', $msg)) {
                Alert::success('Success!', session('key', $msg));
               }
               $vn = Vendor::where('vendor_id','=',$request->vendor_id)->get();
              
               foreach($vn as $v){
                   $vendor_name = $v ->vendor_name;
               }
               $vendors = DB::table('vendors')->get();
               return redirect()->back()->with(['data' => $vendor_name])->with('vendors', $vendors)->withInput();
           
            }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {   try{
        $products = Product::findOrFail($product_id);
        $files = Storage::files('images');
        $images = [];
        foreach ($files as $file) {
        array_push($images, Storage::url($file));
        }
   
        $vendors = DB::table('vendors')
        ->get();
     
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

        return view('administrator.products.edit-product',['images'=>$images], compact('products','vendors'));
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
        try{
        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $product_brand = $_POST['product_brand'];
        $name = $file->getClientOriginalName();
        $filePath = $product_brand. '/'. $name;
        Storage::disk('s3')->put($filePath, file_get_contents($file),'public');
        }
      
        $product = Product::find($product_id);
        $product-> product_name = $request -> product_name;
        $product -> refill_new = $request -> refill_new;
        $product -> product_brand = $request -> product_brand;
        $product -> product_size = $request -> product_size;
        $product -> product_type = $request -> product_type;
        $product -> unit_price = $request -> unit_price;
        $product -> selling_price = $request -> selling_price;
        $product -> reorder_level = $request -> reorder_level;
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if ($image != '')
        {
        $image_name =$image->getClientOriginalName();
        $image->move(public_path('images'), $image_name);
        $url = config('app.aws_url');
        $photo= $url.$product_brand.'/'.$image_name;
        $product -> image = $photo;
        $product -> save();
        }else{
        
        $product -> image = $request ->oldfile;
        $product -> save();
        }
       
        $product -> save();
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
        $msg = config('app.product_update');
        if (session('key', $msg)) {
        Alert::success('Success!', session('key', $msg));
    }
     
        return redirect('administrator/products')->with('success', config('app.success_product'));
        
    }
    
}
