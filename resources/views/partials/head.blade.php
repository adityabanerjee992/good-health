<head>
{{--     <meta charset="UTF-8">
    <title>Health Care | Responsive HTML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta name="description" content="A responsive Ready code Bootstrap site." />
    <meta name="keywords" content="css3, perspective, 3d, jquery, responsive, template" />
    <meta name="author" content="http://themepack.net" />
    <link rel="shortcut icon" href="{{ url('images/favicon.ico') }}"> 

    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('css/custom-style.css')}}">
    <link rel="stylesheet" href="{{url('css/responsive.css')}}">
 --}}

<meta charset="UTF-8">
<title>SRS Health Care</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta name="description" content="SRS Health Care" />
<meta name="keywords" content="SRS Health Care" />

<link rel="shortcut icon" href="{{ url('images/favicon.ico') }}"> 

<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }} ">
<link rel="stylesheet" href="{{ url('css/font-awesome.min.css') }} ">
<link rel="stylesheet" href="{{ url('css/custom-style.css') }} ">
<link rel="stylesheet" href="{{ url('css/responsive.css') }} ">


</head>
<div class="modal fade" id="pincodePopup">
    <a class="close" data-dismiss="modal">×</a>
 
  <div class="modal-body">
      <div class="pincode-popup">
          <form class="bootstrap-modal-form" action="{{ route('check-user-pincode') }}">
              {!! Form::token() !!}
                <input type="text" name="user_pincode" placeholder="Enter Your PinCode" required value="{{ Cookie::get('user_pincode') }}" />
                <input type="submit" name="" value="submit" />
          </form>
      </div>
  </div>
  
</div>