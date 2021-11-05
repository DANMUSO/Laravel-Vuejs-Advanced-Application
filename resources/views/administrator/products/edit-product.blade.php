@extends('layouts.administrator')
@section('content')
<section class="content">
<div class="right_col" role="main">
				<div class="">
         <div class="clearfix"></div>
					<div class="row" style="color:#000">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
							
								<div class="x_content">
                <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('administrator.products.update',$products->product_id)}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ method_field('PATCH')}}
                <div class="row">
                <div class="col-md-12">
                <center><h4>Product Details</h4></center>
                <hr>
                </div>
                <div class="col-md-3">
                  <label>Product Status</label>
                  <select type="text" name="refill_new" value="{{ $products->refill_new }}"  class="form-control c" required placeholder="">
                  <option value="{{ $products->refill_new }}">{{ $products->refill_new }}</option>
                  <option>Refill</option>
                  <option>New (Gas + Cylinder)</option>
                  <option>New Accessory</option>
                  </select>
                  </div>
                  <div class="col-md-3">
                  <label>Vendor's Name</label>
                  <select name="vendor_id" value="{{ $products->vendor_id}}" class="form-control">
                  <option value="{{ $products->product_brand }}">{{ $products->product_brand }}</option>
                  @foreach($vendors as $vendor)
                    <option value="{{$vendor->vendor_name}}">{{ $vendor->vendor_name }}</option>
                  @endforeach                 
                </select>
                  </div>
                  <div class="col-md-3">
                  <label>Product Brand</label>
                    <input type="text" value="{{ $products->product_brand }}" id="vendor" name="product_brand"  class="form-control c" required placeholder="">
                  </div>
                  <div class="col-md-3">
                  <label>Product Size</label>
                  <select name="product_size" id="product_size"  class="form-control c" placeholder="">
                  <option value="{{ $products->product_size}}">{{ $products->product_size}}</option>
                  <option></option>
                  <option>6 KGS</option>
                  <option>13 KGS</option>
                  <option>50 KGS</option>
                  </select>
                  </div>
                  
                  <div class="col-md-3">
                  <label>Product Type</label>
                  <select name="product_type" value="{{ $products->product_type }}" id="vendor" class="form-control">
                    <option value="{{ $products->product_type }}">{{ $products->product_type }}</option>
                    <option>Gas Cylinder</option>
                    <option>Accessory</option>
                  </select>
                  </div>
                  <div class="col-md-3">
                  <label>Unit Price</label>
                  <input type="text" value="{{ $products->unit_price }}" name="unit_price"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-3">
                  <label>Selling Price</label>
                  <input type="number" value="{{ $products->selling_price }}" name="selling_price"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-3">
                  <label>Reorder Level</label>
                  <input type="number" value="{{ $products->reorder_level }}" name="reorder_level"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-6">
                  <label>Attach Photo</label><br />
                  <input id="ImageMedias"  id="txt_6" onkeyup='saveValue(this);' value="{{ $products->image }}" name="image" type="file" class="form-control" value="">
                  <hr>
                  <div id="divImageMediaPreview"></div>
                  <img src="{{ $products->image}}" style="width:20%; height:30%">
                  <input type="text" hidden  name="oldfile" value="{{ $products->image}}">
                  
                  </div>
                  <div class="col-md-3">
                  <label>Product Name</label>
                    <input type="text" readonly id="product_name" onkeyup='saveValue(this);' value="{{ $products->product_name }}" name="product_name" class="form-control c" required placeholder="">
                  </div>
                  </div>
                  <br>
                  <div class="card-footer">
                  <button type="submit"  class="btn btn-info">Update</button>
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