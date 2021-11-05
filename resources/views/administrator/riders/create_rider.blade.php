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
                                <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('administrator.riders.store')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                  <div class="col-md-12">
                  <center><h4>Rider Details</h4></center>
                  <hr>
                  <br>
                  </div> <div class="col-md-4">
                  <label>First Name</label>
                  <input type="text" name="firstname" value="{{ old('firstname')}}"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label> Last Name</label>
                  <input type="text" name="lastname" value="{{ old('lastname')}}"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label>Email</label>
                  <input type="text" name="email" value="{{ old('email')}}" class="form-control" required placeholder="info@chuify.com">
                  @if ($errors->has('email')) 
                  <p class="help-block" style="color:red;">{{ $errors->first('email') }}
                  </p>
                  @endif
                  </div>
                  <div class="col-md-4">
                  <label>Phone</label><br>
                  <input type="tel" placeholder="Phone*" value="{{ '+254'.old('phone')}}" id="telephone" name="phone" name="phone" class="form-control" required placeholder="+254700000000" class="form-control">
                  @if ($errors->has('phone')) 
                  <p class="help-block" style="color:red;">{{ $errors->first('phone') }}
                  </p>
                  @endif
                  </div>
                  
                  <div class="col-md-4">
                  <label>Number Plate</label>
                  <input type="text" name="numberplate" value="{{ old('numberplate')}}" class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label>Depot</label>
                  <input type="text" name="depot" value="{{ old('depot')}}" class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label>Attach Photo</label><br />
                  <input id="ImageMedias" name="image" required="required" type="file" class="form-control">
                  <hr />
                  <div id="divImageMediaPreview"></div>
                  </div>
                  <div class="col-md-12">
                  <br>
                  <div class="card-footer">
                  <button type="submit" style="font-weight: bold; font-size:15px;" class="btn btn-info">Submit</button>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="{{ route('administrator.riders.index')}}" style="font-weight: bold; font-size:15px;" class="btn btn-warning">Back</a>
                  
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