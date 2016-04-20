<?php
class User extends Cartalyst\Sentry\Users\Eloquent\User  {

	/**** Setting Language Validation  ****/
	public static $user_lang = array(
		"email.required" => "Vui lòng nhập Email",
		"email.email" => "Vui lòng nhập đúng định dạng email",
		"password.required" => "Vui lòng nhập mật khẩu",
		"first_name.required" => "Vui lòng nhập họ của bạn",
		"last_name.required" => "Vui lòng nhập tên của bạn",
		"email.unique" => "Email đã tồn tại trong hệ thống",
		"password.min" => "Mật khẩu phải lớn hơn :min ký tự",
		"repassword.required" => "Vui lòng nhập xác nhận mật khẩu",
		"repassword.same" => "Mật khẩu và xác nhận mật khẩu không giống nhau" 
	);
	/**** Setting rule login validation  ****/
	public static $login_rule = array(
		"email" => "required|email",
		"password" => "required"
	);
	public static $add_rule = array(
		"first_name" => "required",
		"last_name" => "required",
		"email" => "required|email|unique:users,email",
		"password" => "required|min:5",
		"repassword" => "required|same:password"
	);
	public function getTimeagoAttribute(){
			$date = \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
			return $date;
		}
}
