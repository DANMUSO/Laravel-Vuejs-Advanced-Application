@extends('layouts.administrator')
@section('content')
<section class="content">
<div class="right_col" role="main" id="app">
          <div class="">
          
            <div class="clearfix"></div>

            <div class="row" style="color:#000">
            <div class="col-md-12 col-sm-12  ">
<div class="x_panel">
<div class="x_title">
<h2><i class="fa fa-bars"></i> List of vendors</small></h2>
<ul class="nav navbar-right panel_toolbox">
<li><a href="{{ route('administrator.vendors.create')}}" type="button" style="width:100px; color:#000" class="btn btn-round btn-success"><i class="fa fa-plus"></i> &nbsp Add</a></li>

</ul>
<div class="clearfix"></div>
</div>
<div id="table_data">
@include('administrator/vendors/vendors-table')
</div>
            </div>
            </div>
              <div class="col-md-12 col-sm-12 ">
               
         </div>
        </div>
       </div>
       </div>
       </div>
       </div>
       </div>
   
    </section>

@endsection