<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currentlocation;
use DB;
class RidermapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $map = Currentlocation::with('riders')->get();
          
        return view('administrator.riders.map', compact('map'));
    
    }

}
