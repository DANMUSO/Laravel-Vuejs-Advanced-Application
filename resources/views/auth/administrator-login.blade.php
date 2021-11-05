@extends('layouts.app')

@section('content')
<div class="container">
<div class="limiter">
		<div class="container-login100">
        
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="{{ route('administrator.login.submit') }}">
                        @csrf
                        <span class="login100-form-title" style="background-color:#C71585;">
						Admin Sign In
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter Email">
						<input placeholder="Email" style="border-radius:25px" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Please enter password">
						<input style="border-radius:25px" placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <span class="focus-input100"></span>
					</div>

					<div class="text-right p-t-13 p-b-23">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="background-color:#C71585" type="submit">
                        {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
					</div>
				</form>
			</div>
		</div>
	</div>
    
</div>
@endsection
