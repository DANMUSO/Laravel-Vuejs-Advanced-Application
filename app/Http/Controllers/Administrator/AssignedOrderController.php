<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignedOrder;
use App\Models\ErrorLog;
use Throwable;
class AssignedOrderController extends Controller
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
        $assignedorder = AssignedOrder::with('orders','orders.users','orders.locations','riders','orders.loyalpoints')
           ->get();
       return view('administrator.riders.assigned_order', compact('assignedorder'));
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
