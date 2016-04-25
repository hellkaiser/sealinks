<?php 
	class EmailConfig extends Eloquent{
		protected $table = "mail";
		public $timestamps = false;
		protected $primaryKey = "email";

		public static $rule = array(
			"driver" => "required",
			"host" => "required",
			"port" => "required|integer",
			"encryption" => "required",
			"address_from" => "required|email",
			"name_from" => "required",
			"email" => "required|email",
			"password" => "required"
		);
		public static $lang = array(
			"driver.required" => "Vui lòng nhập driver của Mail Service",
			"host.required" => "Vui lòng nhập host của Mail Service",
			"port.required" => "Vui lòng nhập port của Mail Service",
			"port.integer" => "Port phải là một số",
			"encryption.required" => "Vui lòng nhập encryption của Mail Service",
			"address_from.required" => "Vui lòng nhập địa chỉ mail from của Mail Service",
			"address_from.email" => "Địa chỉ mail from của Mail Service không phải là định dạng emal",
			"name_from.required" => "Vui lòng nhập tên from của Mail Service",
			"email.required" => "Vui lòng nhập tên email đăng nhập của Mail Service",
			"email.email" => "Email đăng nhập không phải là định dạng email",
			"password.required" => "Vui lòng nhập mật khẩu email của Mail Service"
		);
	}
?>