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
                    <h2>List of Purchase Orders</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('administrator.purchaseorders.create')}}" type="button" style="width:100px; color:white" class="btn btn-round btn-success"><i class="fa fa-plus"></i> &nbsp Add</a>
                      </li>
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
                    <th>Product ID</th>
                    <th>Product Brand</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>Date of Purchase</th>
                    <th>Purchase Order Number</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($purchaseorders as $purchaseorder)
                  <tr>
            
                    <td>{{ $purchaseorder -> porder_id}}</td>
                    @foreach($purchaseorder->products as $p)
                    <td>{{ $p ->product_brand}}</td>
                    <td>{{ $p ->product_name}} {{ $p-> refill_new}}</td>
                    @endforeach
                    <td>{{ $purchaseorder -> quantity}}</td>
                    <td>{{ $purchaseorder -> unit_price}}</td>
                    <td>{{ $purchaseorder -> tax}}</td>
                    <td>{{ $purchaseorder -> total}}</td>
                    <td>{{ $purchaseorder -> dop}}</td>
                    <td>{{ $purchaseorder -> ordernumber}}</td>
                    <td>{{ $purchaseorder -> created_at}}</td>
                    <td>
                    <a href="{{ route('administrator.purchaseorders.edit', $purchaseorder ->porder_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                     <hr>
                    <a href="#" class="btn btn-warning btn-xs delete-confirm"><i class="fa fa-ban"></i> </a>       
              
                    </td>
                  </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Brand</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>Date of Purchase</th>
                    <th>Purchase Order Number</th>
                    <th>Created at</th>
                    <th>Action</th>
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