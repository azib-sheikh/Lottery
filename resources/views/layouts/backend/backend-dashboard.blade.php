<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="{{ url('public/website_logo.png') }}" type="image/x-icon">
  <title>Lottery Admin Panel @yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Font: Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  {{-- <link rel="stylesheet" href="{{url('assets/adminlte/plugins/fontawesome-free/css/all.min.css')}}"> --}}
  <!-- Theme style -->
  {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <style>
        *{
         font-family: 'Lato', sans-serif;   
        }
        /* .main-sidebar {
           background-color: #FF3CAC;
            background-image: linear-gradient(225deg, #FF3CAC 0%, #784BA0 50%, #2B86C5 100%);
        } */
        .main-sidebar,.navbar-dark {
            /* background-color: #FF3CAC; */
            /* background-image: linear-gradient(225deg, #FF3CAC 0%, #784BA0 50%, #2B86C5 100%); */
        background-image: radial-gradient( circle 610px at 5.2% 51.6%,  rgba(5,8,114,1) 0%, rgba(7,3,53,1) 97.5% );
        /* background-image: radial-gradient( circle 976px at 51.2% 51%,  rgba(11,27,103,1) 0%, rgba(16,66,157,1) 0%, rgba(11,27,103,1) 17.3%, rgba(11,27,103,1) 58.8%, rgba(11,27,103,1) 71.4%, rgba(16,66,157,1) 100.2%, rgba(187,187,187,1) 100.2% ); */
        
        }
        .content-wrapper{
            /* background-image: linear-gradient( 174.2deg,  rgba(255,244,228,1) 7.1%, rgba(240,246,238,1) 67.4% ); */
            /* background-image: radial-gradient( circle 780.6px at 10% 20%,  rgba(133,255,189,1) 0%, rgba(255,251,125,1) 90.7% ); */
            /* background-image: linear-gradient( 109.6deg,  rgba(121,203,202,1) 11.2%, rgba(119,161,211,1) 91.1% ); */
            /* background-image: linear-gradient( 359.8deg,  rgba(252,255,222,1) 2.2%, rgba(182,241,171,1) 99.3% ); */
            /* background-image: linear-gradient( 358.7deg,  rgba(42,136,157,1) 1.7%, rgba(122,197,214,1) 51.1%, rgba(211,232,242,1) 95.5% ); */
            /* background-image: radial-gradient( circle 344px at 1.4% 0%,  rgba(242,185,252,1) 19.3%, rgba(250,254,190,1) 80.7% ); */
            /* background-image: radial-gradient( circle 993px at 0.5% 50.5%,  rgba(137,171,245,0.37) 0%, rgba(245,247,252,1) 100.2% ); */
            /* background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(234,249,249,0.67) 0.1%, rgba(239,249,251,0.63) 90.1% ); */
            background-image: radial-gradient( circle 1224px at 10.6% 8.8%,  rgba(255,255,255,1) 0%, rgba(153,202,251,1) 100.2% );
        }
        .btn-primary,.btn-primary-gradient , .btn-primary:hover{
            background-color: #6610f2;
            border-color: #6610f2;
        }
        
        
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d977d3adb6.js" crossorigin="anonymous"></script>
    <style>
        .help-block{
            color: red;
        }
    </style>
    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

@include('layouts.partials.backend.header')



@yield('content')



@include('layouts.partials.backend.footer')



@stack('scripts')

</body>
</html>
