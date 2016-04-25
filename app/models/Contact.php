<?php
	class Contact extends Eloquent{
		protected $table = "contacts";
		protected $guarded = array("id");
		protected $fillable = array('title', 'address', 'fax','phone','email','location_id');

		public $timestamps = false;

		public static $rule_add = array(
			"title" => "required|unique:contacts,title",
			"address" => "required|min:10",
			"fax" => "required|min:10",
			"email" => "required|email",
			"location" => "unique:contacts,location_id,0,location_id"
		);
		public static $rule_edit = array(
			"title" => "required|unique:contacts,title",
			"address" => "required|min:10",
			"fax" => "required|min:10",
			"email" => "required|email",
		);
		public static $lang_contact = array(
			"title.required" => "Vui lòng nhập tên liên hệ",
			"address.required" => "Vui lòng nhập địa chỉ liên hệ",
			"address.min" => "Địa chỉ liên hệ phải lớn hon :min ký tự",
			"fax.required" => "Vui lòng nhập Fax",
			"fax.min" => "Fax phải lớn hơn :min ký tự",
			"email.required" => "Vui lòng nhập địa chỉ email",
			"emai.email" => "Email này không đúng định dạng email",
			"location.unique" => "Liên Hệ cho địa điểm này đã tồn tại",
			"title.unique" => "Tên địa điểm này đã tồn tại"
		);

		public function location(){
			return $this->belongsTo("Location","location_id");
		}
	}
?>