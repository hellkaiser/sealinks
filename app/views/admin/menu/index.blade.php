@extends("admin.master")
@section("content")
    <div class="dd" id="nestable">
            <ol class="dd-list">
                <li class="dd-item" data-id="1">
                    <div class="dd-handle">Item 1</div>
                </li>
                <li class="dd-item" data-id="2">
                    <div class="dd-handle">Item 2</div>
                    <ol class="dd-list">
                        <li class="dd-item" data-id="3"><div class="dd-handle">Item 3</div></li>
                        <li class="dd-item" data-id="4"><div class="dd-handle">Item 4</div></li>
                        <li class="dd-item" data-id="5">
                            <div class="dd-handle">Item 5</div>
                            <ol class="dd-list">
                                <li class="dd-item" data-id="6"><div class="dd-handle">Item 6</div></li>
                                <li class="dd-item" data-id="7"><div class="dd-handle">Item 7</div></li>
                                <li class="dd-item" data-id="8"><div class="dd-handle">Item 8</div></li>
                            </ol>
                        </li>
                        <li class="dd-item" data-id="9"><div class="dd-handle">Item 9</div></li>
                        <li class="dd-item" data-id="10"><div class="dd-handle">Item 10</div></li>
                    </ol>
                </li>
                <li class="dd-item" data-id="11">
                    <div class="dd-handle">Item 11</div>
                </li>
                <li class="dd-item" data-id="12">
                    <div class="dd-handle">Item 12</div>
                </li>
            </ol>
        </div>

@stop
@section("bottom_script")
  <!-- jQuery 2.1.4 -->
    <script src="{{URL::to('/')}}/public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="{{URL::to('/')}}/public/dist/js/jquery.nestable.js"></script>
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
        $(document).ready(function () {
            $('#nestable').nestable().on("change",function(){
                data = window.JSON.stringify($(this).nestable('serialize'));
                $.ajax({
                    "url" : '{{URL::route("admin.menu_update_get")}}',
                    "type" : "get",
                    "data" : "data="+data,
                    "success" : function(kq){
                        alert(kq);
                    }
                });
            });
        });
    </script>
@stop
