<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Vendor;
use App\Models\ErrorLog;
use Throwable;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class VendorsController extends Controller
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
    public function getdata(){
        try{
        return view('administrator');
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
    public function index()
    {
 
        try{
        return Vendor::latest()->paginate(100);
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
            'vendor_name' => 'required|string|unique:vendors|max:191',
            'vendor_address' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:vendors',
            'phone' => 'required|unique:vendors|numeric|regex:/^(\+2547)[0-9]{8}$/',
            'person' => 'required|string|max:191',
            'photo' => 'required',
            'doc' => 'required',

        ]);
        $image = $request->photo;  // your base64 encoded
        $data = explode( ',', $image );
        $imageName = rand().'.jpg';
        $filenamephoto=$request ->vendor_name.'/'. $imageName;
        Storage::disk('s3')->put($filenamephoto, base64_decode($data[1]), 'public');

        $doc = $request->doc;  // your base64 encoded
        $datadoc = explode( ',', $doc );
        $docName = rand().'.pdf';
        $filenamedoc=$request ->vendor_name.'/'. $docName;
        Storage::disk('s3')->put($filenamedoc, base64_decode($datadoc[1]), 'public'); 
        $url = config('app.aws_url');
        $photourl= $url.$filenamephoto;
        $docurl= $url.$filenamedoc;
        $code = config('app.country_code');
        $vendor = New Vendor;
        $vendor->vendor_name = $request ->vendor_name; 
        $vendor->vendor_address = $request ->vendor_address; 
        $vendor->person = $request ->person; 
        $vendor->phone =  $request ->phone;
        $vendor->email = $request ->email;
        $vendor->status = config('app.status_1');
        $vendor->image = $photourl; 
        $vendor->doc = $docurl;
        $vendor->save(); 
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
    public function update(Request $request, $vendor_id)
    {
      
        try{
        $validator = $this->validate($request, [
            'vendor_name' => 'required|string|max:191',
            'vendor_address' => 'required|string|max:191',
            'email' => 'required|string|email|max:191',
            'phone' => 'required|numeric|regex:/^(\+2547)[0-9]{8}$/',
            'person' => 'required|string|max:191',
        ]);
        $vendor = Vendor::findOrFail($vendor_id);
        $vendor-> vendor_name = $request-> vendor_name;
        $vendor-> vendor_address = $request-> vendor_address;
        $vendor-> person = $request-> person;
        $vendor-> phone = $request-> phone;
        $vendor-> email = $request-> email;
        $vendor->status = config('app.status_1');

        if(empty($request->photo)){
            $vendor->save();
        }else{
            $image = $request->photo;  // your base64 encoded
            $data = explode( ',', $image );
            $imageName = rand().'.jpg';
            $filenamephoto=$request ->vendor_name.'/'. $imageName;
            Storage::disk('s3')->put($filenamephoto, base64_decode($data[1]), 'public');
            $url = config('app.aws_url');
            $imageurl= $url.$filenamephoto;
            $vendor->image = $imageurl;
            $vendor->save();
        }
        if(empty($request->doc)){
            $vendor->save();
         }else{
            $doc = $request->doc;  // your base64 encoded
            $datadoc = explode( ',', $doc );
            $docName = rand().'.pdf';
            $filenamedoc=$request ->vendor_name.'/'. $docName;
            Storage::disk('s3')->put($filenamedoc, base64_decode($datadoc[1]), 'public'); 
            $url = config('app.aws_url');
          
            $docurl= $url.$filenamedoc;
            $vendor->doc = $docurl;
            $vendor->save();
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
