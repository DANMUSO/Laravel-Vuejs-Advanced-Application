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
                  <form role="form" style="font-size:15px;" enctype="multipart/form-data" method="POST" action="{{ route('administrator.vendors.update', $vendor->vendor_id)}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              {{ method_field('PATCH')}}
                <div class="row">
                  <div class="col-md-12"> 
                  <h4>Vendor Details</h4>
                  <hr>
                  </div> <div class="col-md-4">
                  <label>Vendor's Name</label>
                  <input type="text" name="vendor_name" value="{{$vendor ->vendor_name }}" class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label> Physical Address</label>
                  <input type="text" name="vendor_address" value="{{$vendor ->vendor_address }}"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label>Contact Person</label>
                  <input type="text" name="person" value="{{$vendor ->person }}"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4"> 
                  <label>Contact Person Phone</label>
                  <input type="tel" name="phone" id="telephone" value="{{$vendor ->phone}}" class="form-control" required placeholder="+254700000000">
                  @if ($errors->has('phone')) 
                  <p class="help-block" style="color:red;">{{ $errors->first('phone') }}</p> @endif
                  
                  </div>
                  <div class="col-md-4">
                  <label>Contact Person Email</label>
                  <input type="text" name="email" value="{{$vendor ->email }}"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" required placeholder="info@chuify.com">
                  </div>
                  <div class="col-md-4">
                  <label>Attach Contract Document</label><br />
                  <input name="doc" type="file" class="form-control">
                  <input type="text" hidden  name="olddoc" value="{{ $vendor->doc}}">
                  </div>
                  <div class="col-md-4">
                  <label>Attach Photo</label><br />
                  <input id="ImageMedias" name="image" type="file" class="form-control"/>
                  <input type="text" hidden  name="oldfile" value="{{ $vendor->image}}">
                  <hr/>
                  <div id="divImageMediaPreview"></div>
                  <img src="{{ $vendor->image}}" style="width:20%; height:40%">
                  </div>
                  <div class="col-md-12">
                  <br>
                  <br>
                  <br>
                  <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update</button>
                  <a href="{{ route('administrator.vendors.index')}}" style="font-weight: bold; font-size:15px;" class="btn btn-warning">Cancel</a>
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