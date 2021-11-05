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
                                <form role="form" style="font-size:15px;" enctype="multipart/form-data" method="POST" action="{{ route('administrator.riders.update', $riders->rider_id)}}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              {{ method_field('PATCH')}}
                <div class="row">
                <div class="col-md-12"> 
                  <center><h4>Rider Details</h4></center>
                  <hr>
                  </div> <div class="col-md-4">
                  <label>First Name</label>
                  <input type="text" name="firstname" value="{{$riders ->firstname }}" class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label> Last Name</label>
                  <input type="text" name="lastname" value="{{$riders ->lastname }}"  class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label>Phone</label>
                  <input type="tel" id="telephone" name="phone" value="{{$riders ->phone}}"  class="form-control" required placeholder="">
                  @if ($errors->has('phone')) 
                  <p class="help-block" style="color:red;">{{ $errors->first('phone') }}
                  </p>
                  @endif
                  </div>
                  <div class="col-md-4"> 
                  <label>Email</label>
                  <input type="text" name="email" value="{{$riders ->email}}" class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label>Number Plate</label>
                  <input type="text" name="numberplate" value="{{$riders ->numberplate}}"   class="form-control" required placeholder="">
                  </div>
                  <div class="col-md-4">
                  <label>Attach Photo</label><br />
                  <input id="ImageMedias" name="image" type="file" class="form-control"/>
                  <input type="text" hidden  name="oldfile" value="{{ $riders->image}}">
                  <hr/>
                  <div id="divImageMediaPreview"></div>
                  <img src="{{ $riders->image}}" style="width:20%; height:40%">
                  </div>
                  <div class="col-md-12">
                  <br>
                  <br>
                  <br>
                  <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update</button>
                  <a href="{{ route('administrator.riders.index')}}" style="font-weight: bold; font-size:15px;" class="btn btn-warning">Cancel</a>
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