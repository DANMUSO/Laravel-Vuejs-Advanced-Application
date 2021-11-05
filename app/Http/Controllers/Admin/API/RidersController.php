<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Models\Rider;
use App\Models\ErrorLog;
use Throwable;
use DB;
class RidersController extends Controller
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
            return Rider::latest()->paginate(100);
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
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:riders',
            'phone' => 'required|unique:riders|numeric|regex:/^(\+2547)[0-9]{8}$/',
            'depot' => 'required',
            'numberplate' => 'required',
            'photo' => 'required',
            

        ]);
        $image = $request->photo;  // your base64 encoded
        $data = explode( ',', $image );
        $imageName = rand().'.jpg';
        $riders = config('app.riders');
        $filenamephoto=$riders.'/'. $imageName;
        Storage::disk('s3')->put($filenamephoto, base64_decode($data[1]), 'public');
        $url = config('app.aws_url');
        $photourl= $url.$filenamephoto;
        $rider = new Rider;
        $rider->firstname=$request->firstname;
        $rider->lastname=$request->lastname;
        $rider->phone=$request->phone;
        $rider->email=$request->email;
        $rider->image=$photourl;
        $rider->status="On";
        $rider->depot=$request->depot;
        $rider->numberplate=$request->numberplate;
        $rider->save();
        return $request->all();
       

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
    public function update(Request $request, $rider_id)
    {
        $rider = Rider::find($rider_id);
        $rider->firstname=$request->firstname;
        $rider->lastname=$request->lastname;
        $rider->phone=$request->phone;
        $rider->email=$request->email;
        $rider->depot=$request->depot;
        $rider->numberplate=$request->numberplate;
        if(empty($request->photo)){
            $rider->save();
        }else{
            $image = $request->photo;  // your base64 encoded
            $data = explode( ',', $image );
            $imageName = rand().'.jpg';
            $riders = config('app.riders');
            $filenamephoto=$riders.'/'. $imageName;
            Storage::disk('s3')->put($filenamephoto, base64_decode($data[1]), 'public');
            $url = config('app.aws_url');
            $imageurl= $url.$filenamephoto;
            $rider->image = $imageurl;
            $rider->save();
        }
        return $request->all();
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
