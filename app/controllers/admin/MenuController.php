<?php
	namespace Controllers\Admin;
	class MenuController extends \BaseController{
		public function getIndex(){
			return \View::make("admin.menu.index")->with("title","Menu");
		}
		public function getUpdate(){
			$data = \Input::get("data");
			print_r( json_decode($data));
		}
	}
?>