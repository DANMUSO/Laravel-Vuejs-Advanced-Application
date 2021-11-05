@extends('layouts.detail')
@section('content')
<section class="content">

          <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                  
                    <div class="clearfix" style="background-color:#C71585; color:#fff">
                    <center>
                    <h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp List of Products ordered by this client <b> 
                    @foreach($order as $orders)
                    {{$orders->users['firstname']}} {{$orders->users['lastname']}}
                    </b></h2>
                    @endforeach
                    </center>
                    </div>
                    <hr>
                    <div class="clearfix">
                    <h2>
                    <form role="form" enctype="multipart/form-data" method="POST" action="{{ url('/administrator/reprocess')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     {{ method_field('POST')}}
                     
                     @foreach($order as $orders)
                     <input type="hidden" name="amount" value="{{$orders->totalprice}}">
                     <input type="hidden" name="phone" value="{{$orders->users['phone']}}">
                     <input type="hidden" name="user_id" value="{{$orders->user_id}}">
                     <input type="hidden" name="order_id" value="{{$orders->order_id}}">
                     <input type="hidden" name="notify" value="reprocess">
                     @endforeach
                     <button type="submit"  style="width:100%; color:white" class="btn btn-round btn-primary">Reprocess Payment</button>
                     </form>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                     <form role="form" enctype="multipart/form-data" method="POST" action="{{ url('/administrator/cancel')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     {{ method_field('POST')}}

                     <input type="hidden" name="orderstatus" value="5">
                     <input type="hidden" name="title" value="Xoom Gas">
                     <input type="hidden" name="description" value="The order have been cancelled by Admin.">
                     <input type="hidden" name="order_id" value="{{$orders->order_id}}">
                     <input type="hidden" name="notify" value="cancel">
                     
                     @foreach($order as $orders)
                     <input type="hidden" name="user_id" value="{{$orders->user_id}}">
                     @endforeach
                     <button type="submit"  style="width:100%; color:white" class="btn btn-round btn-danger">Cancel Order</button>
                     </form>
                    </ul>
                    </div>
              
                <div class="row">
                <div class="col-md-12 col-sm-12 ">
                
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
                         {{ $orderdetail->product_id}}<br><br><br><br><hr><br><br>
                      @endforeach
                      </td>
                      <td width="14%">
                      @foreach($orders->orderdetails as $orderdetail)
                         {{ $orderdetail->product_name}} {{ $orderdetail->refill_new}}<br><br><br><hr><br><br>
                      @endforeach
                      </td>
                      <td width="14%">
                      @foreach($orders->orderdetails as $orderdetail)
                         {{ $orderdetail->product_brand}}<br><br><br><br><hr><br><br>
                      @endforeach
                      </td>
                      
                      <td width="14%">
                      @foreach($orders->product_details as $orderDetails)
                         {{ $orderDetails->units_order}}<br><br><br><br><hr><br><br>
                      @endforeach
                      
                      </td>
                      <td width="10%">
                      @foreach($orders->product_details as $orderDetails)
                         {{ $orderDetails->total_price}}<br><br><br><br><hr><br><br>
                      @endforeach
                      </td>
                      <td width="13%">
                      @foreach($orders->product_details as $orderDetails)
                         {{ $orderDetails->created_at}}<br><br><br><br><hr><br>
                      @endforeach
                      </td>
                      </tr>
                    @endforeach
                   
                    </table>
                     </div>
              </div>
              </div>
              </div>
              </div>
              </div>
         
    </section>

@endsection