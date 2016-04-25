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
		public function getEdit($id){
			$location_service = \Location::with("service","locationTranslate")->get();
			foreach($location_service as $k=>$item){
				$location_service[$k]["service_name"] = $item->service()->with("serviceTranslate")->get();
			}
			try{
				$user = \Sentry::findUserById($id);
				return \View::make("admin.user.edit")->with("title","Sửa Thành Viên")->with("location_service",$location_service)->with("user",$user);
			}catch(\Cartalyst\Sentry\Users\UserNotFoundException $e){
				return \Redirect::route("admin.user_index_get")->with("error","Thành viên này không tồn tại trong hệ thống");
			}
		}
		public function postEdit($id){
			$rule = array(
				"first_name" => "required",
				"last_name" => "required",
				"email" => "required|email|unique:users,email,$id",
			);
			$valid = \Validator::make(\Input::all(),$rule,\User::$user_lang);
			if($valid->passes()){
				$pass = \Input::get("new_password");

				$user = \Sentry::findUserById($id);
				
				$user->first_name = \Input::get("first_name");
				$user->last_name = \Input::get("last_name");
				$user->email = \Input::get("email");
				if($pass != ""){
					$user->password = $pass;
				}

				if($user->getPermissions() != null){
					foreach($user->getPermissions() as $k=>$v){
						$list_old_permision[$k] =  0;	
					}
					$user->permissions = $list_old_permision;
					$user->save();
				}
				if(\Input::get("permision") == "superuser"){
					$user->permissions = array(
						"superuser" => 1
					);
				}else{
					if(\Input::get("list_permision") != ""){
						foreach(\Input::get("list_permision") as $item){
							$key = 'rule_'.strval($item);
							$list_permision[$key] =  1;	
							
						}
						$user->permissions = $list_permision;
					}
				}
				$user->save();
				return \Redirect::route("admin.user_index_get")->with("success","Bạn đã sửa thành viên thành công");
			}else{
				return \Redirect::route("admin.user_edit_get",array($id))->with("error",$valid->errors()->first());
			}
		}
		public function getDel($id){
			try{
			    // Find the user using the user id
			    $throttle = \Sentry::findThrottlerByUserId($id);

			    // Ban the user
			    $throttle->ban();
			    return \Redirect::route("admin.user_index_get")->with("success","Bạn đã banned thành viên thành công");
			}catch (\Cartalyst\Sentry\Users\UserNotFoundException $e){
			    return \Redirect::route("admin.index")->with("error","Thành viên này không tồn tại trong hệ thống");
			}
		}
		public function postEditAll(){
			$active = \Input::get("active");
			$reactive = \Input::get("reactive");
			$id = \Input::get("checkbox_status");
			if(isset($active)){
				foreach( $id as $item){
					// Find the user using the user id
				    $throttle = \Sentry::findThrottlerByUserId($item);

				    // Ban the user
				    $throttle->unban();
				}
				return \Redirect::route("admin.user_index_get")->with("success","Bạn đã kích hoạt thành công danh sách thành viên");
			}elseif($reactive){
				foreach( $id as $item){
					// Find the user using the user id
				    $throttle = \Sentry::findThrottlerByUserId($item);

				    // Ban the user
				    $throttle->ban();
				}
				return \Redirect::route("admin.user_index_get")->with("success","Bạn đã ReActive thành công danh sách thành viên");
			}
		}
	}
?>