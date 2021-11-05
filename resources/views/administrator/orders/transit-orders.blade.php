@extends('layouts.detail')
@section('content')
<section class="content">

          <div class="row">
              <div class="col-md-12 col-sm-12 ">
              
              <div class="clearfix" style="background-color:#C71585; color:#fff">
                    <center>
                    <br>
                    <h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
                    Order is out for delivery</h2>
                    </center>
                    
                  </div>
                  <br>
                    <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>Order ID<th>Product Photo</th><th>Product ID</th><th>Product Name</th><th>Vendor Name</th><th>Quantity Ordered</th><th>Total</th><th>Product Ordered Date</th>
                    </tr>
                    </thead>
                    @foreach($order as $orders)
                    <tr>
                    <td width="10%">
                      
                      {{$orders->order_id}}<br><br><br><br>
                      </td>
                      <td width="14%">
                      @foreach($orders->orderdetails as $orderdetail)
                       <img  src="{{ $orderdetail->image}}" width="100%"><hr>
                      @endforeach
                      </td>
                       <td width="11%">
                      @foreach($orders->orderdetails as $orderdetail)
                         {{ $orderdetail->product_id}}<br><br><br><br><hr>
                      @endforeach
                      </td>
                      <td width="14%">
                      @foreach($orders->orderdetails as $orderdetail)
                         {{ $orderdetail->product_name}} {{ $orderdetail->refill_new}}<br><hr>
                      @endforeach
                      </td>
                      <td width="14%">
                      @foreach($orders->orderdetails as $orderdetail)
                         {{ $orderdetail->product_brand}}<br><br><br><br><hr>
                      @endforeach
                      </td>
                      
                      <td width="14%">
                      @foreach($orders->product_details as $orderDetails)
                         {{ $orderDetails->units_order}}<br><br><br><br><hr>
                      @endforeach
                      
                      </td>
                      <td width="10%">
                      @foreach($orders->product_details as $orderDetails)
                         {{ $orderDetails->total_price}}<br><br><br><br><hr>
                      @endforeach
                      </td>
                      <td width="13%">
                      @foreach($orders->product_details as $orderDetails)
                         {{ $orderDetails->created_at}}<br><br><hr>
                      @endforeach
                      </td>
                      </tr>
                    @endforeach
                   
                    </table>
                    <div class="clearfix" style="background-color:#C71585; color:#fff">
                    <center>
                    <br>
                    <h6>You can complete this order if rider encounter any issue in scanning QR Code.</h6>
                   
                  <form role="form"  enctype="multipart/form-data" method="POST" action="{{ route('completeOrder')}}">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden" name="order_id" value="{{$orders->order_id}}">
                  <button type="submit"  class="btn btn-round btn-success" style="color:#000">Complete Order Id #{{$orders->order_id}}</button>
                   </form>
                    </center>
                  </div>
	             	 </div>
                </div>
    </section>

@endsection