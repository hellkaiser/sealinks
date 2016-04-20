@extends("admin.master")
@section("content")
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">{{$title}}</h3>&nbsp;&nbsp;<a href="{{URL::route('admin.service_add_get')}}" class="btn btn-primary btn-xs btn-flat">Thêm Dịch Vụ</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  {{Form::open(array("route"=>"admin.service_editall_post"))}}
                  <table id="service_list" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>{{Form::checkbox("check_all",null,null,array("id"=>"checkall"))}}</th>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Mô Tả</th>
                        <th>Dịch Vụ</th>
                        <th>Địa Điểm</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                          $stt = 0;
                        ?>
                         @foreach($data as $item)
                         <?php $stt++ ?>
                          <tr>
                            <td>{{Form::checkbox("checkbox_status[]",$item->id,null,array("class"=>"checkbox_status"))}}</td>
                            <td>{{$stt}}</td>
                            <td>
                              @foreach($item->serviceTranslate as $v)
                                <strong>{{$v->lang_code}}</strong> : {{$v->name}}
                                <br />
                              @endforeach
                            </td>
                            <td>
                              @foreach($item->serviceTranslate as $v)
                                <strong>{{$v->lang_code}}</strong> : {{Str::words(strip_tags($v->description),10,"...")}}
                                <br />
                              @endforeach
                            </td>
                            <td>
                              @if($item['service_parent'] == "")
                               <span class="label label-primary">Dịch Vụ Cha</span>
                              @else
                                @if($item['service_parent'])
                                  {{$item['service_parent']->service_translate[0]->name}}
                                @endif
                              @endif   
                            </td>
                            <td>
                            @if($item['location_name'])
                              <ul class="list-unstyled" style="font-size: 12px">
                              @foreach($item['location_name'] as $item2)
                                <li>{{$item2->locationTranslate[0]->name}}</li>
                              @endforeach
                              </ul>
                            @endif
                            </td>
                            <td>
                              @if($item->status == 1)
                                <span class="label label-success">Đã Kích Hoạt</span>
                              @else
                               <span class="label label-warning">Không Kích Hoạt</span>
                              @endif
                            </td>
                            <td>
                          <a href="{{URL::route("admin.service_edit_get",array($item->id))}}" class="btn btn-app"><i class="fa fa-edit"></i>Sửa</a>
                          <a href="{{URL::route("admin.service_del_get",array($item->id))}}" class="btn btn-app delete"><i class="fa fa-trash"></i>Xóa</a>
                        </td>
                          </tr>
                         @endforeach      
                    </tbody>
                    <tfoot>
                    <tr>
                      <td colspan="8">
                      <button type="submit" name="active" id="active" class="btn bg-maroon btn-flat margin disabled" value="1">Kích Hoạt</button>
                      <button type="submit" name="reactive" id="reactive" class="btn bg-purple btn-flat margin disabled" value="1">Không Kích Hoạt</button>
                      </td>
                    </tr>                    
                    </tfoot>
                  </table>
                  {{Form::close()}}
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
      $(function () {
        $("#service_list").DataTable({
        	"language": {
	            "decimal":        "",
			    "emptyTable":     "Không có giá trị trong bảng",
			    "info":           "Hiển thị _START_ đến _END_ của _TOTAL_ dòng",
			    "infoEmpty":      "Hiển thị 0 đến 0 của 0 dòng",
			    "infoFiltered":   "(filtered from _MAX_ total entries)",
			    "infoPostFix":    "",
			    "thousands":      ",",
			    "lengthMenu":     "Hiển thị _MENU_ dòng",
			    "loadingRecords": "Đang tải...",
			    "processing":     "Đang thực hiện...",
			    "search":         "Tìm Kiếm:",
			    "zeroRecords":    "Không có giá trị",
			    "paginate": {
			        "first":      "Đầu tiên",
			        "last":       "Cuối Cùng",
			        "next":       "Tiếp",
			        "previous":   "Trước"
			    }
	        }
        }); 
      });
      $(document).ready(function(){
        $(".delete").on("click",function(e){
          e.preventDefault();
          url = $(this).attr("href");
          $('#confirm')
          .modal({ backdrop: 'static', keyboard: false })
          .one('click', '#delete', function () {
              window.location.href = url;
          });
        });
        $("#checkall").on("click",function(){
          $check = $("#service_list .checkbox_status");
          if($(this).is(":checked")){
           $check.prop("checked",true);
          }else{  
            $check.prop("checked",false);
          }
        });
        $("#service_list input[type=checkbox]").on("click",function(){
          if($(this).is(":checked")){
            $("#active").removeClass("disabled");
            $("#reactive").removeClass("disabled");
            $("#deleteall").removeClass("disabled");
          }else{
            $("#active").addClass("disabled");
            $("#reactive").addClass("disabled");
            $("#deleteall").addClass("disabled");
          } 
        });
      });
    </script>
@stop