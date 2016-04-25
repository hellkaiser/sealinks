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
              {{Form::open(array("route"=>"admin.contact_add_post"))}}
                <!-- Custom Tabs -->
                  <div class="box-body">
                    <div class="form-group">
                      {{Form::label("title","Tên Địa Chỉ: ")}}
                      {{Form::text("title","",array("class"=>"form-control","placeholder"=>"Nhập địa chỉ ..."))}}
                    </div>
                    <div class="form-group">
                      {{Form::label("address","Địa Chỉ: ")}}
                      {{Form::text("address","",array("class"=>"form-control","placeholder"=>"Nhập địa chỉ ..."))}}
                    </div>
                    <div class="form-group">
                      {{Form::label("phone","Số Điện Thoại : ")}}
                      <div id="phone">
                      {{Form::text("phone[]","",array("class"=>"form-control","placeholder"=>"Nhập Số điện thoại ..."))}}
                      </div>
                      <a href="javascript:void(0)"id="add_phone" class="btn btn-flat btn-primary" style="margin-top: 5px">+</a>
                    </div>
                    <div class="form-group">
                      {{Form::label("fax","Fax : ")}}
                      {{Form::text("fax","",array("class"=>"form-control","placeholder"=>"Nhập Số fax ..."))}}
                    </div>
                    <div class="form-group">
                      {{Form::label("email","Email : ")}}
                      {{Form::email("email","",array("class"=>"form-control","placeholder"=>"Nhập email ..."))}}
                    </div> 
                    <div class="form-group">
                      {{Form::label("location","Chọn Địa Điểm: ")}}
                      {{Form::select("location",$location_select,null,array("class"=>"form-control"))}}
                    </div>
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
          $(document).on("click","#add_phone",function(){
              text = '<div class="input-group">{{Form::text("phone[]","",array("class"=>"form-control","placeholder"=>"Nhập Số điện thoại ..."))}} <span class="input-group-addon"><a href="#" class="btn btn-flat btn-danger" id="delete_phone">X</a></span></div>';
              $("#phone").append(text);
          });
          $(document).on("click","#delete_phone",function(e){
              e.preventDefault();
              $(this).parent().parent().hide();
          });
          
      })
    </script>
@stop