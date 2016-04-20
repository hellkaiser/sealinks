@extends("admin.master")

@section("content")
	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">{{$title}}</h3>&nbsp;&nbsp;<a href="{{URL::route('admin.user_add_get')}}" class="btn btn-primary btn-xs btn-flat">Thêm Thành Viên</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  {{Form::open(array("route"=>"admin.user_editall_post"))}}
                  <table id="user_list" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>{{Form::checkbox("check_all",null,null,array("id"=>"checkall"))}}</th>
                        <th>STT</th>
                        <th>Họ</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Quyền</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $stt = 0; ?>
                      @foreach($user as $item)
                        <?php $stt++ ?>
                        <tr>
                          <td>{{Form::checkbox("checkbox_status[]",$item->id,null,array("class"=>"checkbox_status"))}}</td>
                          <td>{{$stt}}</td>
                          <td>{{$item->first_name}}</td>
                          <td>{{$item->last_name}}</td>
                          <td>{{$item->email}}</td>
                          <td>
                            @if($item->hasAccess("superuser"))
                                <span class="label label-danger">Supper Admin</span>
                            @else
                                <span class="label label-primary">Editor</span>
                            @endif
                          </td>
                          <td>
                            @if(Sentry::findThrottlerByUserId($item->id)->isBanned())
                               <span class="label label-warning">Không Kích Hoạt</span>
                            @else
                                <span class="label label-success">Kích Hoạt</span>
                            @endif
                          </td>
                          <td>
                            <a href="{{URL::route("admin.user_edit_get",array($item->id))}}" class="btn btn-app"><i class="fa fa-edit"></i>Sửa</a>
                            <a href="{{URL::route("admin.user_del_get",array($item->id))}}" class="btn btn-app delete"><i class="fa fa-trash"></i>Xóa</a>
                          </td>
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
        $("#user_list").DataTable({
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
			    },
			    "aria": {
			        "sortAscending":  ": activate to sort column ascending",
			        "sortDescending": ": activate to sort column descending"
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
          $check = $("#user_list .checkbox_status");
          if($(this).is(":checked")){
           $check.prop("checked",true);
          }else{  
            $check.prop("checked",false);
          }
        });

        $("#user_list input[type=checkbox]").on("click",function(){
          if($(this).is(":checked")){
            $("#active").removeClass("disabled");
            $("#reactive").removeClass("disabled");
          }else{
            $("#active").addClass("disabled");
            $("#reactive").addClass("disabled");
          } 
        });
      });
    </script>
@stop
