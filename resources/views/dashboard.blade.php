@inject('vendors','App\Models\Vendor') 
@inject('products','App\Models\Product') 
@inject('purchaseorders','App\Models\Purchaseorder')
@inject('riders','App\Models\Rider')
@inject('clients','App\Models\User')
@inject('orders','App\Models\Order')
@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="color:#000">
      <!-- page content -->
      <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row">
          <div class="col-md-12 col-sm-12 ">
          <h5>Admin Dashboard</h5>
          
          <div class="tile_count" >
          <div class="col-md-4 col-sm-4 tile_stats_count">
          <div class="col-md-12 col-sm-12 btn-primary" style="border-radius: 25px;">
          <br>
          <a href="{{ url('administrator/stocks')}}">
          <span class="count_top" style="color:#000;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
          <i class="fa fa-industry"></i >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Vendors</b></span>
           <hr>
              <div class="count" style="color:white"> 
             <center> 
             {{$vendors->count()}}
              </center></div>
              <span class="count_bottom"></span>
              <!-- /.info-box-content -->
            </div>
            </a>
            </div>
            </div>
            <div class="tile_count" >
          <div class="col-md-4 col-sm-4 tile_stats_count">
          <div class="col-md-12 col-sm-12 btn-warning" style="border-radius: 20px;">
          <br>
          <span class="count_top" style="color:#000;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-product-hunt"></i >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Products</b></span>
           <hr>
           <a href="{{ route('administrator.products.index')}}">
              <div class="count" style="color:white;"> 
              <center>
              {{$products->count()}}
              </center>
             </div>
             </a>
              <span class="count_bottom"></span>
              <!-- /.info-box-content -->
            </div>
            </div>
            </div>
            <div class="tile_count" >
         
            <div class="tile_count" >
          <div class="col-md-4 col-sm-4 tile_stats_count">
          <div class="col-md-12 col-sm-12 btn-info" style="border-radius: 20px;">
          <br>
          <span class="count_top" style="color:#000;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-shopping-cart"></i >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Purchase Orders</b></span>
           <hr>
           <a href="{{ route('administrator.purchaseorders.index')}}">
              <div class="count" style="color:white;">     
              <center>
              {{$purchaseorders->count()}}
              </center>
             </div>
             </a>
              <span class="count_bottom"></span>
              <!-- /.info-box-content -->
            </div>
            </div>
            </div>
            <div class="tile_count" >
          <div class="col-md-4 col-sm-4 tile_stats_count">
          <div class="col-md-12 col-sm-12 btn-secondary" style="border-radius: 20px;">
          <br>
          <span class="count_top" style="color:#000;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-motorcycle"></i >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Riders</b></span>
           <hr>
           <a href="{{ route('administrator.riders.index')}}">
              <div class="count" style="color:white;">     
              <center>
              {{$riders->count()}}
               </center>
             </div>
             </a>
              <span class="count_bottom"></span>
              <!-- /.info-box-content -->
            </div>
            </div>
            </div>
            
            <div class="tile_count" >
          <div class="col-md-4 col-sm-4 tile_stats_count">
          <div class="col-md-12 col-sm-12 btn-danger" style="border-radius: 20px;">
          <br>
          <span class="count_top" style="color:#000;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-users"></i >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Clients</b></span>
           <hr>
           <a href="{{ route('administrator.users.index')}}">
              <div class="count" style="color:white;">    
              <center>
              {{$clients->count()}}
                </center>
             </div>
             </a>
             <span class="count_bottom"></span>
              <!-- /.info-box-content -->
            </div>
            </div>
            </div>
            <div class="tile_count" >
          <div class="col-md-4 col-sm-4 tile_stats_count">
          <div class="col-md-12 col-sm-12 btn-info" style="border-radius: 20px;">
          <br>
          <span class="count_top" style="color:#000;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="fa fa-first-order"></i >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Orders</b></span>
           <hr>
           <a href="{{ route('administrator.order.index')}}">
              <div class="count" style="color:white;">    
              <center>
              {{$orders->count()}}
                </center>
             </div>
             </a>
             <span class="count_bottom"></span>
              <!-- /.info-box-content -->
            </div>
            </div>
            </div>
            </div>

          </div>
        </div>
    </section>
@endsection
