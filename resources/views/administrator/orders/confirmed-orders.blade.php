@extends('layouts.detail')
@section('content')
<section class="content">

          <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                <div class="x_content">
                <div class="row">
                <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title" style="background-color:#C71585; color:#fff">
                  <h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAssign this order to the available rider</h2>
                 
                  <div class="clearfix">
                  </div>
                </div>
                <div class="x_content">
                @foreach($riders as $rider)
                  <ul class="list-unstyled msg_list">
                    <li>
                      <a>
                        <span class="image">
                          <img src="{{ $rider->riders->image}}" alt="img" />
                        </span>
                        <span>
                          <span style="color:#000">#ID {{ $rider->riders->rider_id}}<br>{{ $rider->riders->firstname}} {{ $rider->riders->lastname}}</span>
                         
                          
                          <span class="time">Time: {{ $rider->time}}</span><br>
                          <span class="time">Distance: {{ $rider->distance}} Km</span><br>
                          <span class="time" style="color:green">Online</span>
                          
                        </span>
                        <span class="message" style="color:#000">
                        {{ $rider->riders->phone}}
                        </span>
                      </a><br>
                    </li>
                    @foreach($order as $orders)
                  <form role="form"  enctype="multipart/form-data" method="POST" action="{{ route('administrator.order.store')}}">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden" name="rider_id" value="{{ $rider->riders->rider_id}}">
                   <input type="hidden" name="order_id" value="{{$orders->order_id}}">
                   <input type="hidden" name="user_id" value="{{$orders->user_id}}">
                   <input type="hidden" name="orderstatus" value="2">
                   <input type="hidden" name="title" value="Xoom Gas">
                   <input type="hidden" name="description" value="This order have been assigned to you.">
                  <button type="submit"  class="btn btn-success">Assign Order</button>
                   </form>
                   @endforeach
                  </ul>
                  @endforeach
                </div>
              </div>
            </div>
                <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                 <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
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
	             	 </div>
                </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
         
    </section>

@endsection