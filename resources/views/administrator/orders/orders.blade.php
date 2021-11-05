@extends('layouts.administrator')
@section('content')
<section class="content">

<div class="right_col" role="main">
<div class="">


              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> List of Orders</h2>
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      @include('notify::messages')
                      <x:notify-messages />
                      @notifyJs
                  
                    <div class="clearfix">

                    </div>
                  </div>
                  <div class="x_content">
                  <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#submit" role="tab" aria-controls="submit" aria-selected="true"><b>  Failed Payment Orders  <b style="color:green">{{ $no1 }}</b></b></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#confirm" role="tab" aria-controls="confirm" aria-selected="false"><b>  Confirmed Orders  <b style="color:green">{{ $no2 }}</b></b></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#transit" role="tab" aria-controls="transit" aria-selected="false"><b>  In transit Orders  <b style="color:green">{{ $no3 }}</b></b></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="false"><b>  Delivered Orders  <b style="color:green">{{ $no4 }}</b></b></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false"><b>  Cancelled Orders  <b style="color:green">{{ $no5 }}</b></b></a>
                      </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="submit" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>Order ID</th><th>Customer Name</th><th>Customer phone</th><th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th>
                    <th>Description</th>
                    <th>Customer Address</th>
                    
                    <th>Order Status</th><th>Total Price</th>
                    <th>Delivery Date</th><th>Delivery Time</th>
                    </tr>
                    </thead>
                    @foreach($order1 as $orders)
                    <tr>
                    <td>
                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#myModal" onclick="showDtails({{$orders->order_id}})">
                    <i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i></button>
                    {{$orders->order_id}}
                    </td>
                    <td>
                    {{$orders->users['firstname']}} {{$orders->users['lastname']}}
                    </td>
                    <td>
                    {{$orders->users['phone']}}
                    </td>
                    <td>
                    {{$orders->users['email']}}
                    </td>
                     <td>
                    {{$orders->paymentmethod}}
                    </td>
                    <td>
                    {{ $orders->transactionstatus }}
                    </td>
                    <td>
                    {{ $orders->payments['description']  ?? null }}
                    </td>
                    <td>
                    {{$orders->locations['title']}}<br>
                    {{$orders->users['details']}} <br>
                    </td>
                    <td>
                    {{$orders->orderstatus}}
                    </td>
                    <td>
                    {{$orders->totalprice}}
                    </td>
                    <td>
                    {{$orders->deliveryDate}}
                    </td>
                    <td>
                    {{$orders->deliveryTime}}
                    </td>
                    <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:750px">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                             
                          </div>
                          <div class="modal-body">
                          <center>
                          <button class="btn btn-success">
                          <i class="fa fa-spinner fa-spin"></i>  Loading
                          </button>
                          </center>
                          <div id="container"></div>
                          </div>
                        </div>
                    </div>
                    </tr>
                    @endforeach
                    </table>
           
                    </div>
                    </div>
                    
                    <div class="tab-pane fade" id="confirm" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                    
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action" style="width:100%">
                    <thead>
                    <tr>
                    <th></th><th>Order ID</th><th>Customer Name</th><th>Customer phone</th><th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th><th>Customer Address</th>
                    <th>Order Status</th><th>Total Price</th>
                    <th>Delivery Date</th><th>Delivery Time</th>
                    </tr>
                    </thead>
                    @foreach($order2 as $orders)
                    <tr>
                    <td>
                    </td>
                    <td>
                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#confirm1" onclick="showConfirm({{$orders->order_id}})"><i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i></button>
                    
                    
                    {{$orders->order_id}}
                    
                    </td>
                    <td>
                    {{$orders->users['firstname']}} {{$orders->users['lastname']}}
                    </td>
                    <td>
                    {{$orders->users['phone']}}
                    </td>
                    <td>
                    {{$orders->users['email']}}
                    </td>
                     <td>
                    {{$orders->paymentmethod}}
                    </td>
                    <td>
                    {{$orders->transactionstatus}}
                    </td>
                    <td>
                    {{$orders->locations['title']}}<br>
                    {{$orders->users['details']}} <br>
                    </td>
                    <td>
                    {{$orders->orderstatus}}
                    </td>
                    <td>
                    {{$orders->totalprice}}
                    </td>
                    <td>
                    {{$orders->deliveryDate}}
                    </td>
                    <td>
                    {{$orders->deliveryTime}}
                    </td>
                    <div id="confirm1" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:750px">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                             
                          </div>
                          <div class="modal-body">
                          <center>
                          <button class="btn btn-success">
                          <i class="fa fa-circle-o-notch fa-spin"></i>  Loading
                          </button>
                          </center>
                          <div id="container"></div>
                          </div>
                        </div>
                    </div>
                    </tr>
                    @endforeach
                    </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="transit" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="table-responsive">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th> Order ID</th><th>Customer Name</th><th>Customer phone</th><th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th>
                    <th>Customer Address</th>
                    <th>Order Status</th><th>Total Price</th>
                    <th>Delivery Date</th><th>Delivery Time</th>
                    </tr>
                    </thead>
                    @foreach($order3 as $orders)
                    <tr>
                    <td>
                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#transit1" onclick="showTransit({{$orders->order_id}})"><i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i></button>
                    {{$orders->order_id}}
                    </td>
                    <td>
                    {{$orders->users['firstname']}} {{$orders->users['lastname']}}
                    </td>
                    <td>
                    {{$orders->users['phone']}}
                    </td>
                    <td>
                    {{$orders->users['email']}}
                    </td>
                     <td>
                    {{$orders->paymentmethod}}
                    </td>
                    <td>
                    {{$orders->transactionstatus}}
                    </td>
                    <td>
                    {{$orders->locations['title']}}<br>
                    {{$orders->users['details']}} <br>
                    </td>
                    <td>
                    {{$orders->orderstatus}}
                    </td>
                    <td>
                    {{$orders->totalprice}}
                    </td>
                    <td>
                    {{$orders->deliveryDate}}
                    </td>
                    <td>
                    {{$orders->deliveryTime}}
                    </td>
                    <div id="transit1" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:750px">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                             
                          </div>
                          <div class="modal-body">
                          <center>
                          <button class="btn btn-success">
                          <i class="fa fa-refresh fa-spin"></i>  Loading
                          </button>
                          </center>
                          <div id="container"></div>
                          </div>
                        </div>
                    </div>
                    </tr>
                    @endforeach
                    </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                    <table  id="datatable-keytable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                    <th>Order ID</th><th>Customer Name</th><th>Customer phone</th><th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th>
                    <th>Customer Address</th>
                    <th>Order Status</th><th>Total Price</th>
                    <th>Delivery Date</th><th>Delivery Time</th>
                    </tr>
                    </thead>
                    @foreach($order4 as $orders)
                    <tr>
                    <td>
                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#delivery1" onclick="showDelivered({{$orders->order_id}})"><i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i></button>
                    
                    
                    {{$orders->order_id}}
                    </td>
                    <td>
                    {{$orders->users['firstname']}} {{$orders->users['lastname']}}
                    </td>
                    <td>
                    {{$orders->users['phone']}}
                    </td>
                    <td>
                    {{$orders->users['email']}}
                    </td>
                     <td>
                    {{$orders->paymentmethod}}
                    </td>
                    <td>
                    {{$orders->transactionstatus}}
                    </td>
                    <td>
                    {{$orders->locations['title']}}<br>
                    {{$orders->users['details']}} <br>
                    </td>
                    <td>
                    {{$orders->orderstatus}}
                    </td>
                    <td>
                    {{$orders->totalprice}}
                    </td>
                    <td>
                    {{$orders->deliveryDate}}
                    </td>
                    <td>
                    {{$orders->deliveryTime}}
                    </td>
                    <div id="delivery1" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:750px">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                             
                          </div>
                          <div class="modal-body">
                          <center>
                          <button class="btn btn-success">
                          <i class="fa fa-refresh fa-spin"></i>  Loading
                          </button>
                          </center>
                          <div id="container"></div>
                          </div>
                        </div>
                    </div>
                    </tr>
                    @endforeach
                    </table>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                    <tr>
                    <th> Order ID</th>
                    <th>Cancellation Reason</th>
                    <th>Customer Name</th>
                    <th>Customer phone</th>
                    <th>Customer Email</th>
                    <th>Payment method</th>
                    <th>Payment Status</th>
                    <th>Customer Address</th>
                    <th>Order Status</th>
                    <th>Total Price</th>
                    <th>Delivery Date</th>
                    <th>Delivery Time</th>
                    </tr>
                    </thead>
                    @foreach($order5 as $orders)
                    <tr>
                    <td>
                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#cancel1" onclick="showCancelled({{$orders->order_id}})"><i class="fa fa-plus" aria-hidden="true" style="font-size:12px"></i></button>
                    
                    
                    {{$orders->order_id}}
                    </td>
                    <td>
                    {{$orders->cancelledorders['reason'] ?? null}}
                    </td>
                    <td>
                    {{$orders->users['firstname']}} {{$orders->users['lastname']}}
                    </td>
                    <td>
                    {{$orders->users['phone']}}
                    </td>
                    <td>
                    {{$orders->users['email']}}
                    </td>
                     <td>
                    {{$orders->paymentmethod}}
                    </td>
                    <td>
                    {{$orders->transactionstatus}}
                    </td>
                    <td>
                    {{$orders->locations['title']}}<br>
                    {{$orders->users['details']}} <br>
                    </td>
                    <td>
                    {{$orders->orderstatus}}
                    </td>
                    <td>
                    {{$orders->totalprice}}
                    </td>
                    <td>
                    {{$orders->deliveryDate}}
                    </td>
                    <td>
                    {{$orders->deliveryTime}}
                    </td>
                    <div id="cancel1" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:750px">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                             
                          </div>
                          <div class="modal-body">
                          <center>
                          <button class="btn btn-success">
                          <i class="fa fa-refresh fa-spin"></i>  Loading
                          </button>
                          </center>
                          <div id="container"></div>
                          </div>
                        </div>
                    </div>
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
    </section>

@endsection