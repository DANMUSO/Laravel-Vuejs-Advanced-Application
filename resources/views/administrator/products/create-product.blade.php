@extends('layouts.administrator')
@section('content')
<section class="content">
<div class="right_col" role="main">
				<div class="">
				
					<div class="clearfix"></div>
					<div class="row" style="color:#000">
						<div class="col-md-12 col-sm-12 ">
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
							<div class="x_panel">
								
								<div class="x_content">
                <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('administrator.products.store')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                <div class="col-md-12">
                <center><h4>Product Details</h4></center>
                <hr>
                </div>
                <div class="col-md-3">
                  <label>Product Status</label>
                  <select type="text" name="refill_new"  class="form-control c" required placeholder="">
                  <option value="{{ old('refill_new')}}">{{ old('refill_new')}}</option>
                  <option>Refill</option>
                  <option>New (Gas + Cylinder)</option>
                  <option>New Accessory</option>
                  </select>
                  </div>
                  <div class="col-md-3">
                 
                  <label>Vendor's Name</label>
                  <select name="vendor_id"  class="form-control">
                  <option value="{{ old('vendor_id')}}"> {{ Session::has('data') ? Session::get('data') : '' }}</option>
                  @foreach($vendors as $vendor)
                    <option value="{{$vendor->vendor_id}}">{{ $vendor->vendor_name }}</option>
                  @endforeach                 
                </select>
                  </div>
                  <div class="col-md-3">
                  <label>Product Brand</label>
                    <input type="text" id="vendor" value="{{ old('product_brand')}}" name="product_brand"  class="form-control c" required placeholder="">
                  </div>
                  <div class="col-md-3">
                  <label>Product Size</label>
                  <select name="product_size" id="product_size"  class="form-control c" placeholder="">
                  <option value="{{ old('product_size')}}">{{ old('product_size')}} </option>
                  <option>6 KGS</option>
                  <option>13 KGS</option>
                  <option>50 KGS</option>
                  </select>
                  </div>
                  
                  <div class="col-md-3">
                  <label>Product Type</label>
                  <select name="product_type" id="vendor" class="form-control">
                    <option value="{{ old('product_type')}}">{{ old('product_type')}}</option>
                    <option>Gas Cylinder</option>
                    <option>Accessory</option>
                  </select>
                  </div>
                  <div class="col-md-3">
                  <label>Unit Price</label>
                  <input type="number" value="{{ old('unit_price')}}" name="unit_price"  class="form-control c" required placeholder="">
                  </div>
                  <div class="col-md-3">
                  <label>Selling Price</label>
                  <input type="number"  value="{{ old('selling_price')}}" name="selling_price"  class="form-control c" required placeholder="">
                  </div>
                  <div class="col-md-3">
                  <label>Reorder Level</label>
                  <input type="number" value="{{ old('reorder_level')}}" name="reorder_level"  class="form-control c" required placeholder="">
                  </div>
                  <div class="col-md-6">
                  <label>Attach Photo</label><br />
                  <input id="ImageMedias"  required="required" id="txt_6" onkeyup='saveValue(this);' name="image" value="{{ old('image')}}" type="file" class="form-control" value="">
                  <hr>
                  <div id="divImageMediaPreview"></div>
                  </div>
                  <div class="col-md-3">
                  <label>Product Name</label>
                    <input type="text" readonly id="product_name" onkeyup='saveValue(this);' value="{{ old('product_name')}}" name="product_name" class="form-control c" required placeholder="">
                  </div>
                  </div>
                  <br>
                  <div class="card-footer">
                  <button type="submit"  class="btn btn-info">Submit</button>
                  <a href="{{ route('administrator.products.index')}}" style="font-weight: bold; font-size:15px;" class="btn btn-warning">Cancel</a>
                  <input type="reset" class="btn btn-danger" value="Reset">
                   </div>
                </form>
								</div>
							</div>
						</div>
					</div>
          <div class="row">
					</div>
					</div></div>
			</div>
    </section>

@endsection