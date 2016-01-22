@extends('app')

@section('content')
	<!-- ENTER ADDRESS -->
	<section class="enter-address">
		<div class="container">
	    	<div class="row">
	       		@include('myaccounts.partials.submenu')
	        </div>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h2 class="text-center myaccount-title">ACCOUNT INFORMATION</h2>
					<br/>
		            @include('flash::message')
                            <div class="col-md-6 col-sm-6 col-xs-12">
	                <form action="{{ route('my-account-info-post') }}" method="POST" class="myaccount_page_detail">
		                 {!! Form::token() !!}
		                 <input type="hidden" name="form" value="account_info" >
		                 
		                 	<div class="account_info_user">

							@if ($error = $errors->first('name'))
							  <div class="alert alert-danger">
							    {{ $error }}
							  </div>
							@endif					

{{-- 							@if ($error = $errors->first('gender'))
							  <div class="alert alert-danger">
							    {{ $error }}
							  </div>
							@endif --}}

		                 	<h3>Account Information</h3>
		                    	{{-- <select class="form-control myaccount_gender"  name ="gender">
		                        	@if($user->gender == NULL)
			                        	<option value="" selected>select</option>
			                        @else
			                        	<option value="">select</option>
			                        @endIf

		                        	@if($user->gender == 'male')
		                        		<option value="male" selected>Male</option>
		                        	@else
		                        		<option value="male">Male</option>
		                        	@endIf

		                        	@if($user->gender == 'female')
			                            <option value="female" selected>Female</option>
			                        @else
			                        	<option value="female">Female</option>
			                        @endIf
		                        </select> --}}
		                    	<input  name ="name" type="text" class="form-control myaccount_name" placeholder="Name" value="{{ $user->name }}" />
		                        <input  name ="email" type="email" class="form-control myaccount_email" placeholder="Email" disabled="true" value="{{ $user->email }}"/>
		                        <input type="submit" class="myaccount_pass_save" value="Save" />
		                    </div>
		                 
	                 </form>
 	               </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
 	                <form id="" action="{{ route('my-account-info-post') }}" method="POST" class="myaccount_page_detail">
		                {!! Form::token() !!}
		                <input type="hidden" name="form" value="change_password" >
		                 
		                 <div class="account_pass_user">

							@if ($error = $errors->first('current_password'))
							  <div class="alert alert-danger">
							    {{ $error }}
							  </div>
							@endif					

							@if ($error = $errors->first('password'))
							  <div class="alert alert-danger">
							    {{ $error }}
							  </div>
							@endif

							@if ($error = $errors->first('confirm_password'))
							  <div class="alert alert-danger">
							    {{ $error }}
							  </div>
							@endif

		                 	<h3>change password</h3>
		                    	<input name ="current_password" type="password" class="form-control myaccount_pass" placeholder="Current Password" />
		                        <input name ="password" type="password" class="form-control myaccount_pass" placeholder="New Password" />
		                        <input name ="confirm_password" type="password" class="form-control myaccount_pass" placeholder="Confirm New Password" />
		                        <input type="submit" class="myaccount_pass_save" value="Change Password" />
		                    </div>
		                      
					</form>		
                            </div>

				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</section> <!-- /.enter-address -->

@stop
