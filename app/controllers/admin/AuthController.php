<?php
	namespace Controllers\Admin;
	use BaseController,View,Input,Validator,User,Redirect,Sentry;
	class AuthController extends BaseController{
		public function getLogin(){
			return View::make("admin.user.login");
		}
		public function postLogin(){
			$valid = Validator::make(Input::all(),User::$login_rule,User::$user_lang);
			if($valid->passes()){
				try{
					$data_login = array(
						"email" => Input::get("email"),
						"password" => Input::get("password")
					);
					if(Input::get("remember_pass")){
						$remember = TRUE;
					}else{
						$remember = FALSE;
					}
					Sentry::authenticate($data_login,$remember);
					return Redirect::route("admin.index")->with("success","Bạn đã đăng nhập thành công");
				}catch(\Cartalyst\Sentry\Users\WrongPasswordException $e){
					return Redirect::route("admin.login_get")->with("error","Mật khẩu không đúng");
				}catch(\Cartalyst\Sentry\Users\UserNotFoundException $e){
					return Redirect::route("admin.login_get")->with("error","Email không tồn tại");
				}
			}else{
				return Redirect::route("admin.login_get")->with("error",$valid->errors()->first());
			}
		}
		public function getLogout(){
			Sentry::logout();
			return Redirect::route("admin.login_get")->with("success","Bạn đã Đăng xuất thành công");
		}
	}
?>