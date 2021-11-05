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
                    <h2>List of Payments</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                   
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                  <tr>
                  <th>Payment ID</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Destination</th>
                    <th>Destination Type</th>
                    <th>Product Name</th>
                    <th>Provider</th>
                    <th>Provider Channel</th>
                    <th>Provider Ref Id</th>
                    <th>Source</th>
                    <th>Source Type</th>
                    <th>Transaction Status</th>
                    <th>Value</th>
                    <th>Transaction Date</th>
                    <th>TTransaction Fee</th>
                    <th>Transaction Id</th>
                    <th>Request Meta Data</th>
                    <th>Transaction Provider Fee</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($payments as $payment)
                  <tr>
            
                    <td>{{ $payment -> payment_id}}</td>
                    <td>{{ $payment -> category}}</td>
                    <td>{{ $payment -> description}}</td>
                    <td>{{ $payment -> destination}}</td>
                    <td>{{ $payment -> destinationType}}</td>
                    <td>{{ $payment -> productName}}</td>
                    <td>{{ $payment -> provider}}</td>
                    <td>{{ $payment -> providerChannel}}</td>
                    <td>{{ $payment -> providerRefId}}</td>
                    <td>{{ $payment -> source}}</td>
                    <td>{{ $payment -> sourceType}}</td>
                    <td>{{ $payment -> status}}</td>
                    <td>{{ $payment -> value}}</td>
                    <td>{{ $payment -> transactionDate}}</td>
                    <td>{{ $payment -> transactionFee}}</td>
                    <td>{{ $payment -> transactionId}}</td>
                    <td>{{ $payment -> requestMetadata}}</td>
                    <td>{{ $payment -> providerFee}}</td>
                    
                  </tr>
                    @endforeach
                  </tbody>
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