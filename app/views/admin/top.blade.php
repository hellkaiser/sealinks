<header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SLC</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sea Links City</b> </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Hiện có 10 thông tin đơn hàng chưa xác nhận</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">       
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  @if(Sentry::getUser()->avatar == "")
                  <img src="{{URL::to('/')}}/public/images/avatar.jpg" class="user-image" alt="User Image">
                  
                  @endif
                  <span class="hidden-xs">{{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{URL::to('/')}}/public/images/avatar.jpg" class="img-circle" alt="User Image">
                    <p>
                      {{Sentry::getUser()->first_name." ".Sentry::getUser()->last_name}}
                      <small>Thành viên từ {{\Carbon\Carbon::createFromTimeStamp(strtotime(Sentry::getUser()->created_at))->diffForHumans()}}</small>
                    </p>
                  </li>
   
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Hồ Sơ</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{URL::route("admin.logout_get")}}" class="btn btn-default btn-flat">Đăng Xuất</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>