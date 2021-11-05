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
                    <h2>List of Trips</h2>
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
                    <th>#Order Id</th>
                    <th>Trip Status</th>
                    <th>Client's Name</th>
                    <th>Rider's Name</th>
                    <th>Destination</th>
                    <th>Delivered Date & Time</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($trips as $trip)
                    <tr>
                    <td>{{ $trip -> trip_id}}</td>
                    <td>{{ $trip -> order_id}}</td>
                    <td>{{ $trip -> tripstatus}}</td>
                    <td>{{ $trip -> orders->users['firstname']}} {{ $trip -> orders->users['lastname']}}</td>
                    <td>{{ $trip -> riders['firstname']}} {{ $trip -> riders['lastname']}}</td>
                    <td>{{ $trip -> orders->locations['details']}} {{ $trip -> orders->locations['address_url']}}</td>
                    <td>{{$trip ->orders['deliveryDate']}}  {{$trip ->orders['deliveryTime']}}</td>
                    </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <tr>
                    <th>#ID</th>
                    <th>#Order Id</th>
                    <th>Trip Status</th>
                    <th>Client's Name</th>
                    <th>Rider's Name</th>
                    <th>Destination</th>
                    <th>Delivered Date & Time</th>
                    </tr>
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