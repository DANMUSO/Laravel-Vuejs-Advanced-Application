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
								<br />
                <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('administrator.vendors.store')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
               
                  <div class="col-md-12">
                  <center><h4>Vendor Details</h4></center>
                  <hr>
        
                  <br>
                  </div> <div class="col-md-4">
                  <label>Vendor's Name</label>
                  <input type="text" name="vendor_name" value="{{ old('vendor_name')}}"  class="form-control" required placeholder="">
                  @if ($errors->has('vendor_name')) 
                  <p class="help-block" style="color:red;">{{ $errors->first('vendor_name') }}</p> @endif
                  </div>
                  <div class="col-md-4">
                  <label> Physical Address</label>
                  <input type="text" value="{{ old('vendor_address')}}" name="vendor_address"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label>Contact Person</label>
                  <input type="text" value="{{ old('person')}}" name="person"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4"> 
                  
                  <label>Contact Person Phone</label>
                  
                  <input type="tel" placeholder="Phone*" id="telephone" value="{{ '+254'.old('phone')}}" name="phone" class="form-control" required placeholder="+254700000000" class="form-control">
                  @if ($errors->has('phone')) 
                  <p class="help-block" style="color:red;">{{ $errors->first('phone') }}</p> @endif
                  
                  </div>
                  <div class="col-md-4">
                  <label>Contact Person Email</label>
                  <input type="text" name="email" value="{{ old('email')}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" required placeholder="info@chuify.com">
                  @if ($errors->has('email')) 
                  <p class="help-block" style="color:red;">{{ $errors->first('email') }}</p> @endif
                  
                  </div>
                  <div class="col-md-4">
                  <label>Attach Contract Document</label><br />
                  <input name="doc" value="{{ request()->input('doc') }}"  required="required" type="file" class="form-control">
                  </div>
                  <div class="col-md-4">
                  <label>Attach Photo</label><br />
                  <input id="ImageMedias" value="{{ request()->input('image') }}" name="image" required="required" type="file" class="form-control">
                  <hr />
                  <div id="divImageMediaPreview"></div>
                  </div>
                  <div class="col-md-12">
                  <br>
                  <div class="card-footer">
                  <button type="submit" style="font-weight: bold; font-size:15px;" class="btn btn-info">Submit</button>
                   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="{{ route('administrator.vendors.index')}}" style="font-weight: bold; font-size:15px;" class="btn btn-warning">Back</a>
                  
                  </div>
                  </form>
				  </div>
				   </div>
				   </div>
				  	</div>
				</div>
        </div>
			</div>
            
    </section>

@endsection