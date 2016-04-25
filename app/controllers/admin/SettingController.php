<?php
	namespace Controllers\Admin;
	class SettingController extends \BaseController{
		public function getIndex(){
			$general = \General::first();
			$email = \EmailConfig::first();
			return \View::make("admin.setting.index")->with("title","Cấu Hình Hệ Thống")->with("general",$general)->with("email",$email);
		}
		public function postGeneral(){
			$general = \General::first();
			$valid = \Validator::make(\Input::all(),\General::$rule,\General::$lang);
			if($valid->passes()){
				$general->title = \Input::get("title_page");
				$general->description = \Input::get("description_page");
				$general->keyword = \Input::get("keyword_page");
				$general->is_index = \Input::get("bot_index_page");
				$general->lang_sys = \Input::get("language_page");
				$general->save();
				return \Redirect::to("admin/setting#general")->with("success","Bạn đã đổi thông tin cấu hình chung thành công");
			}else{
				return \Redirect::to("admin/setting#general")->with("error",$valid->errors()->first())->withInput();
			}
		}
		public function postEmail(){
			$email = \EmailConfig::first();
			$valid = \Validator::make(\Input::all(),\EmailConfig::$rule,\EmailConfig::$lang);
			if($valid->passes()){
				$email->driver = \Input::get("driver");
				$email->host = \Input::get("host");
				$email->port = \Input::get("port");
				$email->encryption = \Input::get("encryption");
				$email->address_from = \Input::get("address_from");
				$email->name_from = \Input::get("name_from");
				$email->email = \Input::get("email");
				$email->password = \Input::get("password");
				$email->save();
				return \Redirect::to("admin/setting#email")->with("success","Bạn đã đổi thông tin cấu hình Mail Service thành công");
			}else{
				return \Redirect::to("admin/setting#email")->with("error",$valid->errors()->first())->withInput();
			}
		}
	}
?>