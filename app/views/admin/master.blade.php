<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$title}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/public/plugins/datatables/dataTables.bootstrap.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <div class="example-modal">
            <div class="modal" id="confirm">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thông Báo</h4>
                  </div>
                  <div class="modal-body">
                    <p>Bạn có muốn thực thi hành động này không ?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Không</button>
                    <button type="button" class="btn btn-primary" id="delete">Có</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
          </div><!-- /.example-modal -->
      @include("admin.top")
      <!-- Left side column. contains the logo and sidebar -->
      @include("admin.sidebar")

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
        <h1>
                Khu Vực Quản Lý
          <small>Dành Cho Admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route("admin.index")}}"><i class="fa fa-dashboard"></i> Trang Chủ</a></li>
            <li class="active">{{$title}}</li>
        </ol>
        </section>
        <section class="notification">
          @if(Session::has("error"))
            <div class="callout callout-warning">
                {{Session::get("error")}}
            </div>
          @endif
          @if(Session::has("success"))
            <div class="callout callout-success">
              {{Session::get("success")}}
            </div>
          @endif
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
         @yield("content")

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      @include("admin.footer")

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        @include("admin.control_sidebar")
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    @yield("bottom_script")
  </body>
</html>
