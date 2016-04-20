@extends("admin.master")

@section("content")
	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">{{$title}}</h3>&nbsp;&nbsp;<a href="{{URL::route('admin.location_add_get')}}" class="btn btn-primary btn-xs btn-flat">Thêm Địa Điểm</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="location_list" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Slug</th>
                        <th>Hành Động</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $stt = 0; ?>
                      @foreach($data as $item)
                      <?php $stt++; ?>
                      <tr>
                        <td>{{$stt}}</td>
                        <td>
                          @foreach($item->locationTranslate as $v)
                            <strong>{{$v->lang_code}}</strong> : {{$v->name}}
                            <br>
                          @endforeach
                        </td>
                        <td>{{$item->slug}}</td>
                        <td>
                          <a href="{{URL::route("admin.location_edit_get",array($item->id))}}" class="btn btn-app"><i class="fa fa-edit"></i>Sửa</a>
                          <a href="{{URL::route("admin.location_del_get",array($item->id))}}" class="btn btn-app delete"><i class="fa fa-trash"></i>Xóa</a>
                        </td>
                      </tr> 
                      @endforeach                 
                    </tbody>
                  </table>
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
        $("#location_list").DataTable({
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
      });
    </script>
@stop
