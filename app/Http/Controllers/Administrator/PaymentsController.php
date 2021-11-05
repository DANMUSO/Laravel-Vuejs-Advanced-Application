<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\ErrorLog;
use Throwable;
class PaymentsController extends Controller
{

    
    public function __construct(){
        $this->middleware('auth:administrator');
    }
    public function index()
    {
        try{
        $payments = Payments::all();

        return view('administrator.payments.payments', compact('payments'));
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
