<div class="row">
  <!-- Title Buttons -->
	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="account-btns-gp">
    		@if(Request::is('my-account/account-information'))
        		<a href="{{ route('my-account-info') }}"><span class="account-btns active ">Account Information</span></a>
        	@else
	        	<a href="{{ route('my-account-info') }}"><span class="account-btns">Account Information</span></a>
	        @endif    		

	        @if(Request::is('my-account/my-address'))
        		<a href="{{ route('my-address') }}"><span class="account-btns active">Address Book</span></a>
        	@else
	        	<a href="{{ route('my-address') }}"><span class="account-btns">Address Book</span></a>
	        @endif	        

	        @if(Request::is('my-account/my-orders') || Request::is('my-account/my-order-details/*'))
        		<a href="{{ route('my-orders') }}"><span class="account-btns active">My Orders</span></a>
        	@else
	        	<a href="{{ route('my-orders') }}"><span class="account-btns">My Orders</span></a>
	        @endif

	        @if(Request::is('my-account/my-documents/prescription') || Request::is('my-account/my-documents/medical-report'))
        		<a href="{{ route('my-documents','prescription') }}"><span class="account-btns active">My Documents</span></a>
        	@else
	        	<a href="{{ route('my-documents','prescription') }}"><span class="account-btns">My Documents</span></a>
	        @endif

        </div>
    </div><!-- End Title Buttons -->
</div>