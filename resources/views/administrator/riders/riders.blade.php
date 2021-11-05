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
                    <h2>List of Riders</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('administrator.riders.create')}}" type="button" style="width:100px; color:white" class="btn btn-round btn-success"><i class="fa fa-plus"></i> &nbsp Add</a>
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
                    <th>Photo</th>
                    <th>#ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Nummber</th>
                    <th>Email</th>
                    <th>Number Plate</th>
                    <th>Depot</th>
                    <th>Registered at</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($riders as $rider)
                    <tr>
                    <td><img src="{{ $rider -> image}}" width="100%"/></td>
                    <td>{{ $rider -> rider_id}}</td>
                    <td>{{ $rider -> firstname}}</td>
                    <td>{{ $rider -> lastname}}</td>
                    <td>{{ $rider -> phone}}</td>
                    <td>{{ $rider -> email}}</td>
                    <td>{{ $rider -> numberplate}}</td>
                    <td>{{ $rider -> depot}}</td>
                    <td>{{ $rider -> created_at}}</td>
                    <td>
                    <a href="{{ route('administrator.riders.edit', $rider ->rider_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
            
                    </td>
                    </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th>Photo</th>
                    <th>#ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Mobile Nummber</th>
                    <th>Email</th>
                    <th>Number Plate</th>
                    <th>Depot</th>
                    <th>Registered at</th>
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