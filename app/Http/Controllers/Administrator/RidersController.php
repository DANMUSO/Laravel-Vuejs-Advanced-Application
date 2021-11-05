<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Rider;
use App\Models\ErrorLog;
use Throwable;
use Illuminate\Support\Facades\Validator;
class RidersController extends Controller
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
        $riders = Rider::oldest()->paginate(50);
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
        return view('administrator.riders.riders', compact('riders'));
    
    }
    public function orders()
    {   try{
        $riders = Rider::oldest()->paginate(50);
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
        return view('administrator.riders.riders', compact('riders'));
    
    }


    public function create() {
        return view('administrator.riders.create_rider');
    }


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
        'phone' => 'required|numeric|regex:/^(7)[0-9]{8}$/',
        'email' => 'unique:riders'
        ]);
    
        if ($validator->fails()) {
        $messages = $validator->messages();
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $phone = config('app.country_code').$request->phone;
        if(Rider::where('phone', $phone)
        ->exists())
        {
        $numberplate = $request->old('numberplate');
        if (session('key', config('app.phone_no_exist'))) {
                Alert::warning('Warning!', session('key', 'Phone number Exist'));
        }
                          
        return redirect()->back()->withInput();
                      
        }
       if ($request->hasFile('image')) {
       $file = $request->file('image');
       $rider = "rider";
       $name = $file->getClientOriginalName();
       $filePath = $rider. '/'. $name;
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
       $photo= $url.$rider.'/'.$image_name;
       $rider = new Rider;
       $rider->firstname=$request->firstname;
       $rider->lastname=$request->lastname;
       $rider->phone=config('app.country_code').$request->phone;
       $rider->email=$request->email;
       $rider->image=$photo;
       $rider->status="On";
       $rider->depot=$request->depot;
       $rider->numberplate=$request->numberplate;
       $rider->save();
       $riders = Rider::oldest()->paginate(50);
       $msg = config('app.rider_add');
          if (session('key', $msg)) {
          Alert::success('Success!', session('key', $msg));
          }
          return redirect()->back()->withInput();
      

    }
    public function edit($rider_id)
    {   
        $riders = Rider::findOrFail($rider_id);
        $files = Storage::files('images');
        $images = [];
        foreach ($files as $file) {
        array_push($images, Storage::url($file));
        }
        return view('administrator.riders.edit_rider',['images'=>$images], compact('riders'));
    }
    public function update(Request $request, $rider_id){
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
            $riderImage = 'rider';
            $name = $file->getClientOriginalName();
            $filePath = $riderImage. '/'. $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file),'public');
            }
            
            $rider = Rider::find($rider_id);
            $rider->firstname=$request->firstname;
            $rider->lastname=$request->lastname;
            $rider->phone= config('app.country_code').$request->phone;
            $rider->email=$request->email;
            $rider->numberplate=$request->numberplate;
            
            $image_name = $request->hidden_image;
            $image = $request->file('image');
            if ($image != '')
            {
            $image_name =$image->getClientOriginalName();
            $image->move(public_path('images'), $image_name);
            $url = config('app.aws_url');
            $photo= $url.$riderImage.'/'.$image_name;
            $rider -> image = $photo;
            $rider -> save();
            }else{
            
            $rider -> image = $request ->oldfile;
            $rider -> save();
            }
           
            $rider -> save();
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
            $msg = config('app.rider_update');
            if (session('key', $msg)) {
            Alert::success('Success!', session('key', $msg));
            }
       

        $riders = Rider::oldest()->paginate(50);

    return view('administrator.riders.riders', compact('riders'));
    }
}
