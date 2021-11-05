<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mvendor;
use App\Models\Mproduct;
use App\Models\Purchaseorder;
use DB;
class StocksController extends Controller
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
        $stock = DB::select('
        SELECT S.product_id,S.stock_quantity, P.refill_new, P.image, P.product_name, V.vendor_name 
        FROM stocks S LEFT JOIN stocks S1
        
        ON (S.product_id = S1.product_id AND S.stock_id < S1.stock_id)

        INNER JOIN products AS P on S.product_id = P.product_id 
        INNER JOIN vendors AS V on P.vendor_id = V.vendor_id
        WHERE S1.stock_id IS NULL Order By V.vendor_name, P.product_id ASC
    ');
    
     $stocks = collect($stock);
     return response()->json([
        'data'=> $stocks,
       ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
