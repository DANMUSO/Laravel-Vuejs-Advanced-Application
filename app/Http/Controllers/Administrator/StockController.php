<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mvendor;
use App\Models\Mproduct;
use App\Models\Purchaseorder;
use DB;
class StockController extends Controller
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
        $stock = DB::select('
            SELECT S.product_id,S.stock_quantity, P.refill_new, P.image, P.product_name, V.vendor_name 
            FROM stocks S LEFT JOIN stocks S1
            ON (S.product_id = S1.product_id AND S.stock_id < S1.stock_id)

            INNER JOIN products AS P on S.product_id = P.product_id
            INNER JOIN vendors AS V on P.vendor_id = V.vendor_id
            WHERE S1.stock_id IS NULL Order By V.vendor_name, P.product_id ASC
        ');
         $stocks = collect($stock);

         return view('administrator.orders.stock', compact('stocks'));
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
