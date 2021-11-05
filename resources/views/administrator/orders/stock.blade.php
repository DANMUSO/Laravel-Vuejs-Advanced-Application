@extends('layouts.administrator')
@section('content')
<section class="content">

<div class="right_col" role="main">
<div class="">
             <div class="row">
                      <div class="col-md-12">
                        <div >
                          <div class="x_title" style="color:#000">
                            <center><h2>Current Stock</h2></center>
                            <div class="clearfix"></div>
                          </div>
                          </div>
                      </div>
                      @foreach($stocks->groupBy('vendor_name') as $stock)
                      <div class="col-md-4   widget widget_tally_box">
                        <div class="x_panel fixed_height_420">
                        <div class="x_title" style="color:#000">
                          @foreach($stock as $key => $v)
                          @if($key === 0)
                            <h2>{{$v->vendor_name}}</h2>
                            @endif
                            @endforeach
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">

                            <div style="text-align: center; overflow: hidden; margin: 10px 5px 0;">
                            @foreach($stock as $key=> $v)
                            @if($key === 0)
                            <img src="{{$v->image}}" style="width:100%; height:200px"/>
                            @endif
                              @endforeach
                            </div>
                          
                            <div>
                                <table class="table">
                                <thead>
                                  <tr>
                                  <th scope="col">Capacity</th>
                                  <th scope="col">Quantity</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($stocks as $detail)
                                @if($v->vendor_name == $detail->vendor_name )
                                  <tr>
                                  <td>{{$detail->product_name}} <br>  {{$detail->refill_new}}</td>
                                  <td>{{$detail->stock_quantity}}</td>
                                  </tr>
                                @endif
                                @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                        </div>
                      </div>
                   

            
</div>
</div>
</section>

@endsection