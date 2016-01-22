<!-- LOGIN/REGISTER -->
<section class="log-reg modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="overflow-y: auto;">
	<div class="container-fluid bdr-container">
		<div class="row">

			<div class="open-acc">
				<p class="already-acc text-center">Already have an account?? <a href="#">Login</a> <span data-dismiss="modal" class="pull-right modal-close" title="Close">Close [x]</span></p>
				<h3 class="create-new-acc text-center">Create a new account</h3>
			</div> <!-- /.open-acc -->

			<div class="col-md-3 mobile-hide"></div>

			<div class="col-md-3 col-xs-12">
				<div class="social-login-sec">
					<p class="fb-login-txt soci-inline-txt"><img src="{{ url('images/login-facebook.png') }}" alt="Login with Facebook">Login with Facebook</p>
					<p class="google-plus-login-txt soci-inline-txt"><img src="{{ url('images/login-google-plus.png') }}" alt="Login with Facebook">Login with Google+</p>
				</div> <!-- /.social-login-sec -->
			</div> <!-- /.col-md-3 -->

			<div class="col-md-1 col-sm-12 mobile-hide">
				<img src="{{ url('images/login-divider.png') }}" class="login-divider">
			</div> <!-- /.col-md-2 -->

			<div class="col-md-3 col-xs-12">
				<div class="login-forms">
					<form method="POST" action="" class="login-form">
					    <div class="form-group">
					    	<label>Email Address</label>
					    	<input type="email" name="email" class="form-control">
					    </div>

						<div class="form-group">
						    <label>Password</label>
						    <input type="password" name="password" class="form-control">
					    </div>

						<div class="form-group">
						    <label>Confirm Password</label>
						    <input type="password" name="password" class="form-control">
					    </div>

					    <input type="submit" value="Sign up" class="sign-up-btn">
					    <div class="clearfix"></div>
					</form>
				</div> <!-- /.login-form -->
			</div> <!-- /.col-md-7 -->

			<div class="col-md-2 mobile-hide"></div>

		</div> <!-- /.row -->
	</div> <!-- /.container -->

	<div class="container-fluid bdr-container" style="margin-top: 15px;">
		<div class="row">

			<div class="open-acc">
				<p class="already-acc text-center">New to stair? <a href="#">Create a new account</a> </p>
				<h3 class="create-new-acc text-center">Login</h3>
			</div> <!-- /.open-acc -->

			<div class="col-md-3 mobile-hide"></div>

			<div class="col-md-3 col-xs-12">
				<div class="social-login-sec">
					<p class="fb-login-txt soci-inline-txt"><img src="{{ url('images/login-facebook.png') }}" alt="Login with Facebook">Login with Facebook</p>
					<p class="google-plus-login-txt soci-inline-txt"><img src="{{ url('images/login-google-plus.png') }}" alt="Login with Facebook">Login with Google+</p>
				</div> <!-- /.social-login-sec -->
			</div> <!-- /.col-md-3 -->

			<div class="col-md-1 col-sm-12 mobile-hide">
				<img src="{{ url('images/login-divider.png') }}" class="login-divider">
			</div> <!-- /.col-md-2 -->

			<div class="col-md-3 col-xs-12">
				<div class="login-form">
					<form method="POST" action="" class="login-form">
					    <div class="form-group">
					    	<label>Email Address</label>
					    	<input type="email" name="email" class="form-control">
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

			<div class="col-md-2 mobile-hide"></div>

		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section> <!-- /.log-reg -->
