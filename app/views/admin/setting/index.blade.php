@extends("admin.master")

@section("content")
	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">{{$title}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#general" data-toggle="tab">Chung</a></li>
                        <li><a href="#email" data-toggle="tab">Mail Service</a></li>
                    </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="general">                   
                      <div class="box-body">
                        {{Form::open(array("route"=>"admin.setting_general_post"))}}
                        <div class="form-group">
                          {{Form::label("title_page","Tiêu Đề của Trang")}}
                          {{Form::text("title_page",$general->title,array("placeholder"=>"Nhập tiêu đề trang...","class"=>"form-control"))}}
                        </div>
                        <div class="form-group">
                          {{Form::label("description_page","Mô Tả của Trang")}}
                          {{Form::textarea("description_page",$general->description,array("placeholder"=>"Nhập mô tả trang...","class"=>"form-control"))}}
                        </div>
                        <div class="form-group">
                          {{Form::label("keyword_page","Từ khóa của Trang (cách nhau bởi dấu ,)")}}
                          {{Form::text("keyword_page",$general->keyword,array("placeholder"=>"Nhập từ khóa của trang...","class"=>"form-control"))}}
                        </div>
                        <div class="form-group">
                          {{Form::label("bot_index_page","Cho phép google index trang web không ?")}}
                          <br />
                          <span class="radio">
                          @if($general->is_index == 1)
                            <label style="margin-right:5px">
                            {{Form::radio("bot_index_page",1,true)}} Có
                            </label>
                            <label>
                            {{Form::radio("bot_index_page",0)}} Không
                            </label>
                          @else
                            <label style="margin-right:5px">
                            {{Form::radio("bot_index_page",1)}} Có
                            </label>
                            <label>
                            {{Form::radio("bot_index_page",0,true)}} Không
                            </label>
                          @endif
                          </span>
                        </div>
                        <div class="form-group row">
                          <div class="col-xs-4">
                            {{Form::label("language_page","Ngôn Ngữ Mặc Định")}}
                            {{Form::select("language_page",array(
                              "vn" => "Việt Nam",
                              "en" => "Tiếng Anh" 
                            ),$general->lang_sys,array("class"=>"form-control"))}}
                          </div>
                        </div>
                        <div class="form-group">
                          {{Form::submit("Lưu Thay Đổi",array("class"=>"btn btn-flat btn-primary"))}}
                        </div>
                        {{Form::close()}}
                    </div><!-- /.box-body -->  
                    </div><!-- /.tab-pane -->
                     <div class="tab-pane" id="email">
                     {{Form::open(array("route"=>"admin.setting_email_post"))}}
                      <div class="box-body">
                        <div class="form-group">
                        {{Form::label("driver","Driver")}}
                        {{Form::text("driver",$email->driver,array("class"=>"form-control","placeholder"=>"Vui lòng nhập driver..."))}}
                        </div>
                        <div class="form-group">
                        {{Form::label("host","Host")}}
                        {{Form::text("host",$email->host,array("class"=>"form-control","placeholder"=>"Vui lòng nhập host..."))}}
                        </div>
                        <div class="form-group row">
                        <div class="col-xs-2">
                          {{Form::label("port","Port")}}
                          {{Form::text("port",$email->port,array("class"=>"form-control","placeholder"=>"port..."))}}
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-xs-2">
                          {{Form::label("encryption","Encryption")}}
                          {{Form::text("encryption",$email->encryption,array("class"=>"form-control","placeholder"=>" encryption..."))}}
                        </div>
                        </div>
                        <div class="form-group">
                        {{Form::label("from","From mail")}}
                        {{Form::text("address_from",$email->address_from,array("class"=>"form-control","placeholder"=>"Vui lòng nhập address from..."))}}
                        <br />
                        {{Form::text("name_from",$email->name_from,array("class"=>"form-control","placeholder"=>"Vui lòng nhập name from..."))}}
                        </div>
                        <div class="form-group">
                        {{Form::label("email","Tên email")}}
                        {{Form::text("email",$email->email,array("class"=>"form-control","placeholder"=>"Vui lòng nhập Email..."))}}
                        </div>
                        <div class="form-group">
                        {{Form::label("password","Mật Khẩu")}}
                        {{Form::input("password","password",$email->password,array("class"=>"form-control","placeholder"=>"Vui lòng nhập mật khẩu..."))}}
                        </div>
                        <div class="form-group">
                        {{Form::submit("Lưu Thay Đổi",array("class"=>"btn btn-flat btn-primary"))}}
                        </div>   
                      </div><!-- /.box-body -->
                      {{Form::close()}}
                    </div><!-- /.tab-pane -->
                  </div><!-- /.tab-content -->
                  </div><!-- nav-tabs-custom -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
@stop
@section("bottom_script")
  <!-- jQuery 2.1.4 -->
    <script src="{{URL::to('/')}}/public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{URL::to('/')}}/public/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="{{URL::to('/')}}/public/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{URL::to('/')}}/public/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src=".{{URL::to('/')}}/public/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{URL::to('/')}}/public/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::to('/')}}/public/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::to('/')}}/public/dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(document).ready(function(){
        var url = document.location.toString();
        if (url.match('#')) {
            $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
        } 

        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        })
      });
    </script>
@stop
