@extends('layouts.administrator')
@section('content')
<section class="content">
<div class="right_col" role="main">
          <div class="">
          <div class="clearfix"></div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Clients
                    
                    </h2>
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
                    <th>Client Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Registered Date</th>
               
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($users as $client)
                  <tr>
                    <td>{{ $client -> user_id}}</td>
                    <td>{{ $client -> firstname}} {{ $client -> lastname}}</td>
                    <td>{{ $client -> phone}}</td>
                    <td>{{ $client -> email}}</td>
                    <td>{{ $client -> created_at}}</td>
                   
                  </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#ID</th>
                    <th>Client Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Registered Date</th>
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