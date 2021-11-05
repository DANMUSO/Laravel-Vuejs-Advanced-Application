<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Vendor;
use App\Models\ErrorLog;
use Throwable;
use DB;
use Illuminate\Support\Facades\Validator;
class VendorsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request){
      try{
      $vendor = Vendor::findOrFail($request->vendor_id);
      $vendor -> status = config('app.status');
      $vendor->update();  
      $no = Vendor::where('status', 0)->count();
      $no1 = Vendor::where('status', 1)->count();
      $vendors = Vendor::where('status',config('app.status_1'))->get();
      $vendors_d = Vendor::where('status',config('app.status'))->get();
      return view('administrator.vendors.vendors-table', compact('vendors','vendors_d','no','no1'));
      } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        $vendor_url = config('app.vendor_url');
        return view('errors.error', compact('error','vendor_url'));
        }
    }
    public function activate(Request $request){
      try{
      $vendor = Vendor::findOrFail($request->vendor_id);
      $vendor -> status = config('app.status_1');
      $vendor->update();  
      $no = Vendor::where('status', 0)->count();
      $no1 = Vendor::where('status', 1)->count();
      $vendors = Vendor::where('status',config('app.status_1'))->get();
      $vendors_d = Vendor::where('status',config('app.status'))->get();
    return view('administrator.vendors.vendors-table', compact('vendors','vendors_d','no','no1')); 
      } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        $vendor_url = config('app.vendor_url');
        return view('errors.error', compact('error','vendor_url'));
        }
    }
    public function index()
    {  
        try{
          $no = Vendor::where('status', 0)->count();
          $no1 = Vendor::where('status', 1)->count();
        $vendors = Vendor::where('status',config('app.status_1'))->get();
        $vendors_d = Vendor::where('status',config('app.status'))->get();
        } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        $vendor_url = config('app.vendor_url');
        return view('errors.error', compact('error','vendor_url'));
        }
        return view('administrator.vendors.vendors', compact('vendors','vendors_d','no','no1')); 
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       
       return view('administrator.vendors.create-vendor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Vendor $vendor)

    { 

      try{
        
       $validator = Validator::make($request->all(), [
          'vendor_name' => 'unique:vendors',
          'phone' => 'required|numeric|regex:/^(7)[0-9]{8}$/',
          'email' => 'unique:vendors'
        ]);

       if ($validator->fails()) {
        $messages = $validator->messages();
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();

          }
       $phone = config('app.country_code').$request->phone;
       if(Vendor::where('phone', $phone)
       ->exists())
       {
              if (session('key', config('app.phone_no_exist'))) {
                Alert::warning('Warning!', session('key', 'Phone number Exist'));
              }
          $vendors = DB::table('vendors')->get();
          return redirect()->back()->withInput();
              
        }
         
        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $vendor_name = $_POST['vendor_name'];
        $name = $file->getClientOriginalName();
        $filePath = $vendor_name. '/'. $name;
        Storage::disk('s3')->put($filePath, file_get_contents($file),'public');
          }
        if ($request->hasFile('doc')) {
        $file = $request->file('doc');
        $vendor_name = $_POST['vendor_name'];
        $name = $file->getClientOriginalName();
        $filePath = $vendor_name. '/'. $name;
        Storage::disk('s3')->put($filePath, file_get_contents($file),'public');
          }
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if ($image != '')
        {
        $image_name =$image->getClientOriginalName();
        $image->move(public_path('images'), $image_name);
        }
        $doc_name = $request->hidden_image;
        $doc = $request->file('doc');
        if ($doc != '')
        {
        $doc_name =$doc->getClientOriginalName();
        $doc->move(public_path('images'), $doc_name);
        }
        $code = config('app.country_code');
        $url = config('app.aws_url');
        $photo= $url.$vendor_name.'/'.$image_name;
        $contract= $url.$vendor_name.'/'.$doc_name;
        $vendor = New Vendor;
        $vendor->vendor_name = $request ->vendor_name; 
        $vendor->vendor_address = $request ->vendor_address; 
        $vendor->person = $request ->person; 
        $vendor->phone = $code . $request ->phone;
        $vendor->email = $request ->email;
        $vendor->status = config('app.status_1');
        $vendor->image = $photo; 
        $vendor->doc = $contract;
        $vendor->save();
        $msg = config('app.vendor_add');
        if (session('key', $msg)) {
        Alert::success('Success!', session('key', $msg));
        }
        return redirect()->back()->withInput();
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
    public function edit($vendor_id)
    {   try{
        $vendor = Vendor::findOrFail($vendor_id);
        $files = Storage::files('vendors');
        $vendors = [];
        foreach ($files as $file) {
        array_push($vendors, Storage::url($file));
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
        return view('administrator.vendors.edit-vendor',compact('vendor','vendors'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vendor_id)
    {
        $response['Photo'] = $request->photo;
        $response['Doc'] = $request->doc;
    
      try{
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|regex:/^(7)[0-9]{8}$/',
          ]);
  
         if ($validator->fails()) { 
          $messages = $validator->messages();
          return redirect()->back()
              ->withErrors($validator)
              ->withInput();
  
            }
        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $vendor_name = $_POST['vendor_name'];
        $name = $file->getClientOriginalName();
        $filePath = $vendor_name. '/'. $name;
        Storage::disk('s3')->put($filePath, file_get_contents($file),'public');
        }
        if ($request->hasFile('doc')) {
        $file = $request->file('doc');
        $vendor_name = $_POST['vendor_name'];
        $name = $file->getClientOriginalName();
        $filePath = $vendor_name. '/'. $name;
        Storage::disk('s3')->put($filePath, file_get_contents($file),'public');
        } 
        $vendor = vendor::find($vendor_id);
        $vendor-> vendor_name = $request-> vendor_name;
        $vendor-> vendor_address = $request-> vendor_address;
        $vendor-> person = $request-> person;
        $vendor-> phone = config('app.country_code').$request-> phone;
        $vendor-> email = $request-> email;
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if ($image != '')
        {
        $image_name =$image->getClientOriginalName();
        $image->move(public_path('images'), $image_name);
        $url = config('app.aws_url');
        $photo= $url.$vendor_name.'/'.$image_name;
        $vendor-> image = $photo;
        $vendor->save();
        } else {
        $vendor-> image = $request->oldfile;
        $vendor->save();
        }
        $doc_name = $request->hidden_image;
        $doc = $request->file('doc');
        if ($doc != '')
        {
        $doc_name =$doc->getClientOriginalName();
        $doc->move(public_path('images'), $doc_name);
        $url = config('app.aws_url');
        $contract= $url.$vendor_name.'/'.$doc_name;
        $vendor-> doc = $contract;
        $vendor->save();
        }else {
        $vendor-> doc = $request -> olddoc;
        $vendor->save();
        }
        
        /* 
        $contract= 'https://xoom-prod.s3.eu-west-2.amazonaws.com/'.$vendor_name.'/'.$doc_name;
          */ 
        $vendor->save();
        $msg = config('app.vendor_update');
        if (session('key', $msg)) {
        Alert::success('Success!', session('key', $msg));
        }
        } catch (Throwable $e) {
        $log = new ErrorLog();
        $log-> error_file   = ($e->getFile());
        $log-> error_message    = ($e->getMessage());
        $log-> error_line   = ($e->getLine());
        $log-> error_trace  = $e->getTraceAsString();
        $log->save();
        $error = config('app.error_exception');
        $url = "administrator.vendors.index";
       return view('errors.error', compact('error','url'));
      }
          
    return redirect('administrator/vendors')->with('success', config('app.success_vendor'));
         
    }
}
