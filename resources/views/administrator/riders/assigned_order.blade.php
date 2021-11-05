@extends('layouts.administrator')
@section('content')
<section class="content">
<div class="right_col" role="main">
          <div class="">
          

            <div class="clearfix"></div>

            <div class="row" style="color:#000">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of assigned orders to various Riders</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="row">
                  <div class="col-sm-12">
                  <div class="card-box table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>#ID</th>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Delivery Date & Time</th>
                    <th>Order Status</th>
                    <th>Location</th>
                    <th>Client Name</th>
                    <th>Client Phone</th>
                    <th>Rider Name</th>
                    <th>Rider phone</th>
                    <th>Assined Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assignedorder as $assignedorders )
                    <tr>
                    <td>{{$assignedorders->assignedOrder_id}}</td>
                    <td>{{$assignedorders->order_id}}</td>
                    @foreach($assignedorders->orders as $order)
                    <td>{{ $order->totalprice}}</td>
                    <td>{{ $order->paymentmethod}}</td>
                    <td>{{ $order->deliveryDate}}  {{ $order->deliveryTime}}</td>
                    <td>{{ $order->orderstatus}}</td>
                    <td>{{ $order->locations->details}} {{ $order->locations->instructions}} </td>
                    <td>{{ $order->users->firstname}} {{ $order->users->lastname}}</td>
                    <td>{{ $order->users->phone}}</td>
                    @endforeach
                    @foreach($assignedorders->riders as $rider)
                    <td>{{ $rider->firstname}} {{ $rider->lastname}}</td>
                    <td>{{ $rider->phone}}</td>
                    @endforeach
                    
                    <td>{{$assignedorders->created_at}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>#ID</th>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Delivery Date & Time</th>
                    <th>Order Status</th>
                    <th>Location</th>
                    <th>Client Name</th>
                    <th>Client Phone</th>
                    <th>Rider Name</th>
                    <th>Rider phone</th>
                    <th>Assined Date</th>
                    </tr>
                    </tfoot>
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
        </div>
   
      <!-- /.container-fluid -->
    </section>

@endsection