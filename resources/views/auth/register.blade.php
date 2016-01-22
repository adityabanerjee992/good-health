@extends('app')

@section('content')
	
		<div class="container-fluid bdr-container customer-register">
		<div class="row">

			<div class="open-acc">
				<p class="already-acc text-center">Already have an account?? <a href="/auth/login">Login</a> 
				{{-- <span data-dismiss="modal" class="pull-right modal-close" title="Close">Close [x]</span></p> --}}
				<h3 class="create-new-acc text-center">Create a new account</h3>
			</div> <!-- /.open-acc -->

<!--			<div class="col-md-3 mobile-hide"></div>-->

			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<div class="social-login-sec">
					<p class="fb-login-txt soci-inline-txt"><img src="{{ url('images/login-facebook.png') }}" alt="Login with Facebook">Login with Facebook</p>
					<p class="google-plus-login-txt soci-inline-txt"><img src="{{ url('images/login-google-plus.png') }}" alt="Login with Facebook">Login with Google+</p>
				</div> <!-- /.social-login-sec -->
			</div> <!-- /.col-md-3 -->

			<div class="col-lg-1 col-md-1 col-sm-1 mobile-hide or-divider">
				<img src="{{ url('images/login-divider.png') }}" class="login-divider">
			</div> <!-- /.col-md-2 -->

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="login-forms">

					<form method="POST" action="{{ $postUrl }}" class="login-form">
						{!! csrf_field() !!}

						<input type="hidden" name="redirect_url" class="form-control" value="{{ $redirectTo }}">
				    	<input type="hidden" name="route" class="form-control" value="{{ $route }}">
					    
					    <div class="form-group">
					        <label>Name </label>
					        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
					        @if ($errors->has('name'))
							    {!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
							@endif
					    </div>  


					    <div class="form-group">
					    	<label>Email Address</label>
					    	<input type="email" name="email" class="form-control" value="{{ old('email') }}" >
					    	  @if ($errors->has('email'))
							    {!! $errors->first('email', '<small class="text-danger">:message</small>') !!}
							@endif
					    </div>

						<div class="form-group">
						    <label>Password</label>
						    <input type="password" name="password" class="form-control">
						    @if ($errors->has('password'))
							    {!! $errors->first('password', '<small class="text-danger">:message</small>') !!}
							@endif
					    </div>

						<div class="form-group">
						    <label>Confirm Password</label>
						    <input type="password" name="password_confirmation" class="form-control">
						    @if ($errors->has('password_confirmation'))
							    {!! $errors->first('password_confirmation', '<small class="text-danger">:message</small>') !!}
							@endif
					    </div>

					    <div class="form-group">
					        <label>Mobile Number </label>
					        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
				            @if ($errors->has('phone'))
							    {!! $errors->first('phone', '<small class="text-danger">:message</small>') !!}
							@endif
					    </div>

					    <input type="submit" value="Sign up" class="sign-up-btn">
					    <div class="clearfix"></div>
					</form>
				</div> <!-- /.login-form -->
			</div> <!-- /.col-md-7 -->

			<div class="col-md-2 mobile-hide"></div>

		</div> <!-- /.row -->
	</div> <!-- /.container -->

@endSection
