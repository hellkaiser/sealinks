@extends("admin.master")
@section("content")
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$title}}</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <div class="row">
            	<div class="col-md-6">
            	{{Form::open(array("route"=>"admin.user_add_post"))}}
              	<!-- Custom Tabs -->
              		<div class="box-body">
                    <div class="form-group">
                      {{Form::label("first_name","Họ : ")}}
                      {{Form::text("first_name","",array("class"=>"form-control","placeholder"=>"Nhập họ ..."))}}
                    </div>
                    <div class="form-group">
                      {{Form::label("last_name","Tên : ")}}
                      {{Form::text("last_name","",array("class"=>"form-control","placeholder"=>"Nhập tên ..."))}}
                    </div>
                    <div class="form-group">
                      {{Form::label("email","Email : ")}}
                      {{Form::email("email","",array("class"=>"form-control","placeholder"=>"Nhập email ..."))}}
                    </div>
                    <div class="form-group">
                      {{Form::label("password","Mật Khẩu : ")}}
                      {{Form::password("password",array("class"=>"form-control","placeholder"=>"Nhập mật khẩu ..."))}}
                    </div>
		                <div class="form-group">
                      {{Form::label("repassword","Xác Nhận Mật Khẩu : ")}}
                      {{Form::password("repassword",array("class"=>"form-control","placeholder"=>"Nhập xác nhận mật khẩu ..."))}}
                    </div>
                    <div class="form-group">
                      {{Form::label("Phân Quyền : ")}}
                      <div class="radio">
                        <label>
                        {{Form::radio("permision","superuser","checked",array("id"=>"superuser"))}} Supper Admin
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                        {{Form::radio("permision","edior",null,array("id"=>"editor"))}} Editor
                        </label>
                      </div>
                    </div>   
                      <div class="box box-danger hidden" id="permision">
                        <div class="box-body">
                        <ul class="list-unstyled">
                          @foreach($location_service as $item)
                            <li>
                              {{Form::checkbox("list_permision_checkall",null,null,array("class"=>"checkall_permistion"))}}<strong>{{$item->locationTranslate[0]->name}}</strong>
                            </li>
                            <div class="checkbox_permision">
                            @foreach($item['service_name'] as $item2)
                            <span class="checkbox" style="display:inline-block;margin-left: 5px">
                              <label>
                                {{Form::checkbox("list_permision[]",$item2->pivot->id)}}{{$item2->serviceTranslate[0]->name}}
                              </label>
                            </span>
                            @endforeach
                            </div>
                          @endforeach
                        </ul>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                  	</div><!-- /.box-body -->
              		<div class="box-footer">
              			{{Form::submit("Thêm",array("class"=>"btn btn-primary"))}}
		            </div>
              	{{Form::close()}}
            	</div><!-- /.col -->
          	</div> <!-- /.row -->
        </div><!-- /.box -->
    </div><!--/.col (left) -->
</div>   <!-- /.row -->
@stop
@section("bottom_script")
	<!-- jQuery 2.1.4 -->
    <script src="{{URL::to('/')}}/public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{URL::to('/')}}/public/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{URL::to('/')}}/public/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::to('/')}}/public/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::to('/')}}/public/dist/js/demo.js"></script>
    <script src="{{URL::to('/')}}/public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script language="javascript">
      $(".textarea").wysihtml5({
        toolbar: {
          "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
          "emphasis": true, //Italics, bold, etc. Default true
          "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
          "html": true, //Button which allows you to edit the generated HTML. Default false
          "link": false, //Button to insert a link. Default true
          "image": false, //Button to insert an image. Default true,
          "color": true, //Button to change color of font  
          "blockquote": false, //Blockquote  
        }
      });
      $(document).ready(function(){
          $("#editor").on("click",function(){
              $("#permision").removeClass("hidden");
          });
          $("#superuser").on("click",function(){
              $("#permision").addClass("hidden");
          });
          $(".checkall_permistion").on("click",function(){
            if($(this).is(":checked")){
              $(this).parent("li").next(".checkbox_permision").find("input[type=checkbox]").prop("checked",true);
            }else{
              $(this).parent("li").next(".checkbox_permision").find("input[type=checkbox]").prop("checked",false);
            } 
          });
      })
    </script>
@stop