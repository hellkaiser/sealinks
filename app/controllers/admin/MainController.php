<?php
    namespace Controllers\Admin;
    use BaseController,View;
	class MainController extends BaseController{
		public function index(){
			return View::make("admin.index")->with("title","Admin Control Panel");
		}
	}
?>