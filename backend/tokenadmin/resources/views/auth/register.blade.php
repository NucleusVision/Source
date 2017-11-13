<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BANG PAPERS | Register</title>
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
        @if(Session::has('status'))
        <div class="alert alert-{{ Session::get('status') }} alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>{{ Session::get('message') }}</strong> 
        </div>
        @endif
        <form id="adminRegister" action="{{ route('auth.register') }}" method="post">
        {!! csrf_field() !!}
        <h3 class="form-title"> Sign Up</h3>
        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
            <input class="form-control" type="text" name="company_name" id="company" value="{{ old('company_name') }}" placeholder="Company Name" >
            @if($errors->has('company_name'))
                <span class="help-block" style="font-size: 13px;">
                    <strong>{{ $errors->first('company_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
          <input class="form-control" type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First Name">
            @if($errors->has('first_name'))
                <span class="help-block" style="font-size: 13px;">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
          <input class="form-control" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"  placeholder="Last Name">
            @if($errors->has('last_name'))
                <span class="help-block" style="font-size: 13px;">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
            @if($errors->has('email'))
                <span class="help-block" style="font-size: 13px;">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('contact_number') ? ' has-error' : '' }}">
          <input class="form-control" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" placeholder="Contact Number">
            @if($errors->has('contact_number'))
                <span class="help-block" style="font-size: 13px;">
                    <strong>{{ $errors->first('contact_number') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <input class="form-control" type="password" name="password"  id="password" placeholder="Password">
          @if($errors->has('password'))
                <span class="help-block" style="font-size: 13px;">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
          <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
          @if($errors->has('confirm_password'))
                <span class="help-block" style="font-size: 13px;">
                    <strong>{{ $errors->first('confirm_password') }}</strong>
                </span>
          @endif
        </div>
        <div class="form-group"><button type="submit" class="btn btn-primary pull-right">Sign Up</button></div>
        <h4><a href="{{ route('admin.login') }}">Sign In</a></h4> 
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
