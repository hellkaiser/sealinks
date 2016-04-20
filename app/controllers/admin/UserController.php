<?php
	namespace Controllers\Admin;
	class UserController extends \BaseController{
		public function getList(){
			$user = \Sentry::findAllUsers();
			return \View::make("admin.user.index")->with("title","Danh Sách Thành Viên")->with("user",$user);
		}
		public function getAdd(){
			$location_service = \Location::with("service","locationTranslate")->get();
			foreach($location_service as $k=>$item){
				$location_service[$k]["service_name"] = $item->service()->with("serviceTranslate")->get();
			}
	
			return \View::make("admin.user.add")->with("title","Thêm Thành Viên")->with("location_service",$location_service);
		}
		public function postAdd(){
			$valid = \Validator::make(\Input::all(),\User::$add_rule,\User::$user_lang);
			if($valid->passes()){
				$user_insert = array(
					"first_name" => \Input::get("first_name"),
					"last_name"  => \Input::get("last_name"),
					"email"      => \Input::get("email"),
					"password"   => \Input::get("password"),
					'activated'  => true
				);
				if(\Input::get("permision") == "superuser"){
					$user_insert['permissions'] = array(
						"superuser" => 1
					);
				}else{
					foreach(\Input::get("list_permision") as $item){
						$key = 'rule_'.strval($item);
						$list_permision[$key] =  1;	
						
					}
					$user_insert['permissions'] = $list_permision;
				}
				
				\Sentry::createUser($user_insert);
				return \Redirect::route("admin.user_index_get")->with("success","Bạn đã tạo thành công thành viên");
			}else{
				return \Redirect::route("admin.user_add_get")->with("error",$valid->errors()->first())->withInput();
			}
		}
	}
?>