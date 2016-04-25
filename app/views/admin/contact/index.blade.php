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
                      <?php $i=0; ?>
                      @foreach($contact as $item)
                        <?php $i++; ?>
                        @if(isset($item->location_name))
                          @if($i==1)
                            <li class="active"><a href="#{{$item->id}}" data-toggle="tab">{{$item->location_name->location_translate[0]->name}}</a></li>
                          @else
                            <li><a href="#{{$item->id}}" data-toggle="tab">{{$item->location_name->location_translate[0]->name}}</a></li>
                          @endif
                        @else
                          @if($i==1)
                            <li class="active"><a href="#{{$item->id}}" data-toggle="tab">{{$item->title}}</a></li>
                          @else
                            <li><a href="#{{$item->id}}" data-toggle="tab">{{$item->title}}</a></li>
                          @endif  
                        @endif        
                      @endforeach
                        <a href="{{URL::route("admin.contact_add_get")}}" class="btn btn-flat btn-primary">+</a>
                    </ul>
                  <div class="tab-content">
                  <?php $j = 0; ?>
                    @foreach($contact as $item)
                      <?php $j++; ?>
                 
                      @if($j==1)
                      <div class="tab-pane active" id="{{$item->id}}">  
                      {{Form::open(array("route"=>array("admin.contact_action_post",$item->id)))}}                 
                        <div class="box-body">
                          <div class="form-group">
                            {{Form::label("title","Tên Địa Chỉ: ")}}
                            {{Form::text("title",$item->title,array("class"=>"form-control","placeholder"=>"Nhập địa chỉ ..."))}}
                          </div>
                          <div class="form-group">
                            {{Form::label("address","Địa Chỉ: ")}}
                            {{Form::text("address",$item->address,array("class"=>"form-control","placeholder"=>"Nhập địa chỉ ..."))}}
                          </div>
                          <div class="form-group">
                            {{Form::label("phone","Số Điện Thoại : ")}}
                            <div id="phone">
                            @foreach(json_decode($item->phone) as $item2)
                            {{Form::text("phone[]",$item2,array("class"=>"form-control","placeholder"=>"Nhập Số điện thoại ..."))}}
                            @endforeach
                            </div>
                            <a href="javascript:void(0)"id="add_phone" class="btn btn-flat btn-primary" style="margin-top: 5px">+</a>
                          </div>
                          <div class="form-group">
                            {{Form::label("fax","Fax : ")}}
                            {{Form::text("fax",$item->fax,array("class"=>"form-control","placeholder"=>"Nhập Số fax ..."))}}
                          </div>
                          <div class="form-group">
                            {{Form::label("email","Email : ")}}
                            {{Form::email("email",$item->email,array("class"=>"form-control","placeholder"=>"Nhập email ..."))}}
                          </div> 
                          <div class="form-group">
                            <button type="submit" name="edit"  class="btn btn-primary btn-flat margin" value="1">Lưu Thay Đổi</button>
                            <button type="submit" name="del" class="btn btn-danger btn-flat margin " value="1">Xóa</button>
                          </div> 
                        </div><!-- /.box-body --> 
                        {{Form::close()}}
                      </div><!-- /.tab-pane -->
                      @else
                      <div class="tab-pane" id="{{$item->id}}">
                        {{Form::open(array("route"=>array("admin.contact_action_post",$item->id)))}}                   
                        <div class="box-body">
                          <div class="form-group">
                            {{Form::label("title","Tên Địa Chỉ: ")}}
                            {{Form::text("title",$item->title,array("class"=>"form-control","placeholder"=>"Nhập địa chỉ ..."))}}
                          </div>
                          <div class="form-group">
                            {{Form::label("address","Địa Chỉ: ")}}
                            {{Form::text("address",$item->address,array("class"=>"form-control","placeholder"=>"Nhập địa chỉ ..."))}}
                          </div>
                          <div class="form-group">
                            {{Form::label("phone","Số Điện Thoại : ")}}
                            <div id="phone">
                            @foreach(json_decode($item->phone) as $item2)
                            {{Form::text("phone[]",$item2,array("class"=>"form-control","placeholder"=>"Nhập Số điện thoại ..."))}}
                            @endforeach
                            </div>
                            <a href="javascript:void(0)"id="add_phone" class="btn btn-flat btn-primary" style="margin-top: 5px">+</a>
                          </div>
                          <div class="form-group">
                            {{Form::label("fax","Fax : ")}}
                            {{Form::text("fax",$item->fax,array("class"=>"form-control","placeholder"=>"Nhập Số fax ..."))}}
                          </div>
                          <div class="form-group">
                            {{Form::label("email","Email : ")}}
                            {{Form::email("email",$item->email,array("class"=>"form-control","placeholder"=>"Nhập email ..."))}}
                          </div> 
                          <div class="form-group">
                            <button type="submit" name="edit"  class="btn btn-primary btn-flat margin" value="1">Lưu Thay Đổi</button>
                            <button type="submit" name="del" class="btn btn-danger btn-flat margin " value="1">Xóa</button>
                          </div> 
                        
                        </div><!-- /.box-body -->
                        {{Form::close()}}
                      </div><!-- /.tab-pane -->
                      @endif    
                    @endforeach
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
        });

        $(document).on("click","#add_phone",function(){
              text = '<div class="input-group">{{Form::text("phone[]","",array("class"=>"form-control","placeholder"=>"Nhập Số điện thoại ..."))}} <span class="input-group-addon"><a href="#" class="btn btn-flat btn-danger" id="delete_phone">X</a></span></div>';
              $("#phone").append(text);
          });
          $(document).on("click","#delete_phone",function(e){
              e.preventDefault();
              $(this).parent().parent().hide();
          });
          
      });
    </script>
@stop
