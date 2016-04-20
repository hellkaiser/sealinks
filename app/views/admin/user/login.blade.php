<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sea Links City | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><img src='{{asset("public/images/logo.png")}}' /></a>
      </div><!-- /.login-logo -->
      @if(Session::has("error"))
      <div class="alert alert-warning" role="alert"><i class="glyphicon glyphicon-ok">&nbsp;</i>       {{Session::get("error")}}</div>
      @endif
      <div class="login-box-body">
        <p class="login-box-msg"><strong>ĐĂNG NHẬP</strong></p>
        {{Form::open(array("route"=>"admin.login_post"))}}
          <div class="form-group has-feedback">
            {{Form::email("email",'',array("class"=>"form-control","placeholder"=>"Email"))}}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
          {{Form::password("password",array("class"=>"form-control","placeholder"=>"Mật khẩu"))}}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  {{Form::checkbox("remember_pass","1")}} Nhớ Mật Khẩu
                </label>
              </div>
            </div><!-- /.col -->
            
          </div>
          <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
              {{Form::submit("Đăng Nhập",array("class"=>"btn btn-primary btn-block btn-flat"))
              }}
            </div><!-- /.col -->
          </div>
        {{Form::close()}}

        <div class="social-auth-links text-center">
          <p>--- THÊM ---</p>
          <a href="#" class="btn btn-block btn-social btn-primary btn-flat"><i class="glyphicon glyphicon-question-sign"></i>Quên Mật Khẩu</a>
        </div><!-- /.social-auth-links -->
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{URL::to('/')}}/public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{URL::to('/')}}/public/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="{{URL::to('/')}}/public/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
