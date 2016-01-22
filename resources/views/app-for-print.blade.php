<!DOCTYPE html>
    
<html lang="en">

    @include('partials.head')

    <body>
        @yield('content')
        
        @include('partials.scripts')
    </body>

</html>

<!-- This is only necessary if you do Flash::overlay('...') -->
<script>
    $('#flash-overlay-modal').modal();

    window.print();
</script>
