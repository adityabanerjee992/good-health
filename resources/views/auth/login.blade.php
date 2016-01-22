@extends('app')

@section('content')

	<div class="container-fluid bdr-container customer-login">
		<div class="row">

			<div class="open-acc">
				<p class="already-acc text-center">New To GoodHealth ? <a href="/auth/register/{{ $route }}">Create a new account</a> </p>
				<h3 class="create-new-acc text-center">Login</h3>
				@include('flash::message')
			</div> <!-- /.open-acc -->

<!--			<div class="col-md-3 mobile-hide"></div>-->

			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<div class="social-login-sec">
					<p class="fb-login-txt soci-inline-txt"><img src="{{ url('images/login-facebook.png') }}" alt="Login with Facebook">Login with Facebook</p>
					<p class="google-plus-login-txt soci-inline-txt"><img src="{{ url('images/login-google-plus.png') }}" alt="Login with Facebook">Login with Google+</p>
				</div> <!-- /.social-login-sec -->
			</div> <!-- /.col-md-3 -->

			<div class="col-lg-1 col-md-1 col-sm-1 col-sm-12 mobile-hide">
				<img src="{{ url('images/login-divider.png') }}" class="login-divider">
			</div> <!-- /.col-md-2 -->

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="login-form">


			<!-- if there are login errors, show them here -->
				@if ($error = $errors->first('email'))
				  <div class="alert alert-danger">
				    {{ $error }}
				  </div>
				@endif

				@if ($error = $errors->first('password'))
				  <div class="alert alert-danger">
				    {{ $error }}
				  </div>
				@endif

					<form method="POST" action="{{ $postUrl }}" class="login-form">

						{!! csrf_field() !!}
					    
				    	<input type="hidden" name="redirect_url" class="form-control" value="{{ $redirectTo }}">
				    	<input type="hidden" name="route" class="form-control" value="{{ $route }}">
					    <div class="form-group">
					    	<label>Email Address</label>
					    	<input type="email" name="email" class="form-control" value="{{ old('email') }}">
					    </div>

						<div class="form-group">
						    <label>Password</label>
						    <input type="password" name="password" class="form-control">
					    </div>

					    <p><label><a href="" class="pw-forgot">Forgot password</a></label></p>

					    <input type="submit" value="Login" class="sign-up-btn">
					    <div class="clearfix"></div>
					</form>
				</div> <!-- /.login-form -->
			</div> <!-- /.col-md-7 -->

<!--			<div class="col-md-2 mobile-hide"></div>-->

		</div> <!-- /.row -->
	</div> <!-- /.container -->

@endSection