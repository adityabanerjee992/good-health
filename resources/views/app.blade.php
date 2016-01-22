<!DOCTYPE html>
    
<html lang="en">

    @include('partials.head')

    <body>

        @include('partials.nav')

        @yield('content')
        
    	@include('partials.suggestions')

    	@include('home.partials.login-register-modal')
            
        @include('partials.footer')

        @include('partials.scripts')
        @yield('scripts')
    </body>

</html>

<!-- This is only necessary if you do Flash::overlay('...') -->
<script>
    $('#flash-overlay-modal').modal();
</script>
