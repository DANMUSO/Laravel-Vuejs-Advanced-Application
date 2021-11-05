<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\ErrorLog;
use Throwable;
use DB;
use Mapper;
class UsermapController extends Controller
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
            $users = User::all();
            $map = DB::table('locations')->get();
            $location = Location::with('user')
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
            return view('administrator.users.map', compact('users','location','map'));
    }

}
