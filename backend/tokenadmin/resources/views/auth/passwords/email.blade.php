<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BANG PAPERS | Forgot password</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/global.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

  </head>
  <body class="login">
    <div class="logo">
      <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo-main.png') }}" alt=""></a>
    </div>
    <div class="content">
      @if (count($errors) > 0)
      <div class="row mrb10 center-align">
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      </div>
      @endif
      @if(Session::has('status'))
        <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ Session::get('status') }}</strong> 
        </div>
      @endif
      <form id="forgotPassword" action="{{ route('auth.password.email') }}" method="post">
          {{ csrf_field() }}
        <h3 class="form-title"> Forgot password?</h3>
        <p>Please enter your email address. You will receive a link to create a new password via email.</p>
        <div class="form-group">
          <input class="form-control" type="text" name="email" id="company" placeholder="Email Address">
        </div>        
        <div class="form-group"><button type="submit" class="btn btn-primary pull-right">Submit</button></div>
        
        <div class="clearfix"></div> 
        <hr>
        <p class="copyright">&copy; 2017 BANG PAPERS PVT. LTD. All Rights Reserved.</p>
      </form>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}" type="text/javascript"></script>
  </body>
</html>
