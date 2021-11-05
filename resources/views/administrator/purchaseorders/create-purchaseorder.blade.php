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
                <center><h4>Purchase Order Details</h4></center>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form role="form" class="c" enctype="multipart/form-data" method="POST" action="{{ route('administrator.purchaseorders.store')}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                <div class="col-md-12">
                @if ($errors->any())
                       <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <ul>
                               @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                               @endforeach
                           </ul>
                       </div>
                   @endif
                   @if (Session::has('success'))
                       <div class="alert alert-info">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <p>{{ Session::get('success') }}</p>
                       </div>
                   @endif
                   </div>
                  <div class="col-md-3">
                  <label>Vendor name</label>
                  <select  name="product_brand" id="product_brand" class="form-control" required placeholder="">
                    <option>Select vendor name</option>
                    @foreach($vendors as $vendor)
                    <option value="{{$vendor->vendor_id}}">{{$vendor ->vendor_name}}
                    </option>
                   @endforeach
                   </select>
                  </div>
                  <div class="col-md-3">
                  <label>Product name</label>
                  <select  name="product_name" id="product_name" class="form-control"  required placeholder="">
                   
                    <option value="product_name">Select product</option>
                    </select>
                  </div>

                  
                  <div class="col-md-3">
                  <label>Quantity</label>
                  <input type="number" name="quantity" id="value1" class="form-control" min="0" placeholder="Enter first value" required />
                  </div>
                  <div class="col-md-3">
                  <label>Unit Price</label>
                  <input type="number" name="unit_price" id="value2" class="form-control" min="0" placeholder="Enter second value" required />
  
                 </div>
                  <div class="col-md-3">
                  <label>Tax</label>
                  <input type="number" name="tax" id="value3" class="form-control" min="0" placeholder="Enter second value" required />
                  </div>
                  <div class="col-md-3">
                  <label>Total</label>


                  <input type="number" name="total" id="sum" class="form-control" readonly />
                     </div>


                  <div class="col-md-3">
                  <label>Date of Purchase</label>
                  <input type="date" name="dop" class="form-control"  required placeholder="">
                  </div>
                  <div class="col-md-3">
                  <label>Purchase order Number</label>
                    <input type="text" name="ordernumber" class="form-control"  required placeholder="">
                  </div>
                 
                  </div>
                  <br>
                  <div class="card-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                  <a href="{{ route('administrator.purchaseorders.index')}}" style="font-weight: bold; font-size:15px;" class="btn btn-warning">Back</a>
                  
                  </div>
                  </form>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						


						</div>
					</div>
					
				</div>
			</div>

    </section>

@endsection