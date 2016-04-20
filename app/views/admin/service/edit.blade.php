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
            	{{Form::open(array("route"=>array("admin.service_edit_post",$service_item->id)))}}
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
                    			{{Form::label("service_name_vn","Tên Dịch Vụ")}}
                      		{{Form::text("service_name_vn",$service_item->vn->name,array("placeholder"=>"Nhập tên dịch vụ...","class"=>"form-control"))}}
                    		</div>
                        <div class="form-group">
                          {{Form::label("service_description_vn","Mô Tả Dịch Vụ")}}
                          {{Form::textarea("service_description_vn",$service_item->vn->description,array("class"=>"form-control textarea"))}}
                        </div>
		                </div><!-- /.box-body -->  
                  	</div><!-- /.tab-pane -->
                  	<div class="tab-pane" id="en">
                  		<div class="box-body">
                        @if($service_item->en)
		                    <div class="form-group">
		                    {{Form::label("service_name_en","Service Name")}}
		                    {{Form::text("service_name_en",$service_item->en->name,array("class"=>"form-control","placeholder"=>"Enter Service Name..."))}}
		                    </div>
		                    <div class="form-group">
                          {{Form::label("service_description_en","Service Description")}}
                          {{Form::textarea("service_description_en",$service_item->en->description,array("class"=>"form-control textarea"))}}
                        </div>
                        @else
                        <div class="form-group">
                        {{Form::label("service_name_en","Service Name")}}
                        {{Form::text("service_name_en","",array("class"=>"form-control","placeholder"=>"Enter Service Name..."))}}
                        </div>
                        <div class="form-group">
                          {{Form::label("service_description_en","Service Description")}}
                          {{Form::textarea("service_description_en","",array("class"=>"form-control textarea"))}}
                        </div>
                        @endif
                  		</div><!-- /.box-body -->
                  	</div><!-- /.tab-pane -->
                	</div><!-- /.tab-content -->
              		</div><!-- nav-tabs-custom -->
              		<div class="box-body">
                    <div class="form-group">
                      {{Form::label("service","Thuộc Dịch Vụ")}}
                      {{Form::select("service",$service,$service_item->parent,array("class"=>"form-control"))}}
                    </div>
		                <div class="form-group">
		                {{Form::label("location","Thuộc Địa Điểm")}}
                    <br />
                    @if(count($service_item->location) > 0)
                      @foreach($location as $item)
                        <span class="checkbox" style="display:inline-block;margin-left: 5px">
                          <label>
                          <?php $check = false; ?>
                          @foreach($service_item->location as $item2)
                            @if($item->location_id == $item2->id)
                                <?php $check = true;break; ?>
                            @endif
                          @endforeach
                          {{Form::checkbox("location[]",$item->location_id,$check)}} {{$item->name}}
                          </label>
                        </span>
                      @endforeach
                    @endif
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
    </script>
@stop