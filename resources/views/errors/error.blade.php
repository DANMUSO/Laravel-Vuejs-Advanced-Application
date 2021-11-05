@extends('layouts.app')

@section('content')
<div class="container">
<div class="limiter">
		<div class="container-login100">
        
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178">
                
                        <span class="login100-form-title" style="background-color:#fff;">
                        
						<p>{{ $error }}</p>
						</span>
                        <center><a href="{{ route('administrator.dashboard')}}" style="color:blue">BACK</a></center>
				   <br>
				</form>
			</div>
		</div>
	</div>
    
</div>
@endsection
