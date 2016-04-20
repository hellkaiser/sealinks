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
            	{{Form::open(array("route"=>array("admin.location_edit_post",$location->id)))}}
              	<!-- Custom Tabs -->
              		<div class="nav-tabs-custom">
                		<ul class="nav nav-tabs">
                  			<li class="active"><a href="#vn" data-toggle="tab">VN</a></li>
                  			<li><a href="#en" data-toggle="tab">EN</a></li>
                		</ul>
                	<div class="tab-content">
                  	<div class="tab-pane active" id="vn">                   
                  		<div class="box-body">
                    		<div class="form-group">
                    			{{Form::label("location_name_vn","Tên Địa Điểm")}}
                      			{{Form::text("location_name_vn",$location->vn->name,array("placeholder"=>"Nhập tên địa điểm...","class"=>"form-control"))}}
                    		</div>
		                </div><!-- /.box-body -->  
                  	</div><!-- /.tab-pane -->
                  	<div class="tab-pane" id="en">
                  		<div class="box-body">
		                    <div class="form-group">
		                    {{Form::label("location_name_en","Location Name")}}
		                    @if($location->en)
		                    {{Form::text("location_name_en",$location->en->name,array("class"=>"form-control","placeholder"=>"Enter Location Name..."))}}	                    
		                   	@else
							{{Form::text("location_name_en","",array("class"=>"form-control","placeholder"=>"Enter Location Name..."))}}
		                   	@endif
		                   	</div>
                  		</div><!-- /.box-body -->
                  	</div><!-- /.tab-pane -->
                	</div><!-- /.tab-content -->
              		</div><!-- nav-tabs-custom -->
              		<div class="box-body">
		                <div class="form-group">
		                {{Form::label("slug","Slug")}}
		                {{Form::text("slug",$location->slug,array("class"=>"form-control","placeholder"=>"Nhập Slug..."))}}
		                </div>
		                   
                  	</div><!-- /.box-body -->
              		<div class="box-footer">
              			{{Form::submit("Sửa",array("class"=>"btn btn-primary"))}}
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
@stop