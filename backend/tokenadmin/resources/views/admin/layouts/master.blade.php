<?php 
	$v = '?v=1.2.3';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>NUCLEUS VISION | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/assets/css/global.css<?php echo $v; ?>" rel="stylesheet" type="text/css" />
    <link href="/assets/css/custom.css<?php echo $v; ?>" rel="stylesheet" type="text/css" />
    <script src="/assets/js/jquery.min.js" type="text/javascript"></script>
    <!-- <script src="/assets/js/sweetalert.js"></script> -->
    <script src="/assets/js/sweetalert2.all.min.js"></script>
    <script src="/assets/js/core.js"></script>
    <script src="/assets/js/spin.min.js" type="text/javascript"></script>
    <script src="{{ asset("assets/js/notify.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/js/notify-metro.js") }}" type="text/javascript"></script>	
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}<?php echo $v; ?>" type="image/png" sizes="16x16">
  </head>
  <body class="sidebar-mini">
        <div class="wrapper">  
            @include('admin.partial.header')

            @include('admin.partial.sidebar')

            @yield('content')

            @include('admin.partial.footer')
            
            @if(Session::has('status'))
            <script type="text/javascript"> 
                $.notify({
                    title: '',
                    text: "{{ Session::get('message') }}"
                }, {
                    style: 'metro',
                    className: "{{ Session::get('status') }}",
                    autoHide: true,
                    clickToHide: true
                });
            </script> 
            @endif
        </div>

        <div class="loader">
            <div class="spinner"></div>
        </div>
      
        <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/js/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/assets/js/app.min.js<?php echo $v; ?>" type="text/javascript"></script>
        <script src="/assets/js/jquery.validate.min.js"></script>
        <script src="/assets/js/moment-with-locales.js"></script>
        <script src="/assets/js/bootstrap-datetimepicker.js"></script>
        <script src="/assets/js/custom.js<?php echo $v; ?>"></script>
    </body>
</html>    
        