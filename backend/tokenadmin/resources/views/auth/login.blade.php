<?php 
	$v = '?v=1.2.4';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NUCLEUS VISION | Login</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="/assets/shortcut icon" type="image/x-icon" href="favicon.ico">
        <link href="/assets/css/global.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="{{ asset('/assets/img/favicon.png') }}<?php echo $v; ?>" type="image/png" sizes="16x16">
    </head>
    <body class="login">
        <div class="logo">
            <a href="{{ url('/') }}"><img src="/assets/img/logo-main.png<?php echo $v; ?>" alt=""></a>
        </div>
        <div class="content">
            <form id="adminLogin" action="{{ route('admin.login') }}" method="post">
                {!! csrf_field() !!}
                <h3 class="form-title"><a> Sign In</a></h3>
                @if ($errors->has('invalid_details'))
                    <span class="help-block" style="font-size: 13px;color: #a94442;">
                        <strong>{{ $errors->first('invalid_details') }}</strong>
                    </span>
                @endif
                @if(Session::has('csrf_error'))
                    <span class="help-block" style="font-size: 13px;color: #a94442;">
                        <strong>{{ Session::get('csrf_error') }}</strong>
                    </span>
                @endif
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-icon">
                        <span aria-hidden="true" class="icon-user"></span>
                        <input class="form-control placeholder-no-fix" type="text" type="email" maxlength="255" name="email" size="40" value="{{ old('email') }}" required="required">
                    </div> 
                    @if ($errors->has('email'))
                        <span class="help-block" style="font-size: 13px;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-icon">
                        <span aria-hidden="true" class="icon-lock"></span>
                        <input class="form-control placeholder-no-fix" type="password" maxlength="255" name="password" size="40" value="{{ old('password') }}" autocomplete="off" required="required">
                    </div> 
                    @if ($errors->has('password'))
                        <span class="help-block" style="font-size: 13px;">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="checkbox">
                    <label><input id="remember" name="remember" type="checkbox" value="remember"> Remember me</label>
                    <button type="submit" class="btn btn-primary pull-right">Sign In</button>
                </div>
				<!--
                <h4><a href="{{ route('auth.register') }}">Sign Up</a> <span class="copyright">|</span> <a href="{{ route('auth.forgot.password') }}">Forgot password?</a></h4>-->
        <hr>
                <p class="copyright">&copy; 2017 NUCLEUS VISION. All Rights Reserved.</p>
            </form>
        </div>
        <script src="/assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/js/jquery.validate.min.js" type="text/javascript"></script>
    </body>
</html>
