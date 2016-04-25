<?php
	class General extends Eloquent{
		protected $table = "general";
		public $timestamps = false;
		protected $primaryKey = "lang_sys";


		public static $rule = array(
			"title_page" => "required|min:10",
			"description_page" => "required|min:15",
			"keyword_page" => "required|min:10"
		);
		public static $lang = array(
			"title_page.required" => "Vui lòng nhập tiêu đề trang",
			"title_page.min" => "Tiêu đề trang phải lớn hơn :min ký tự",
			"description_page.required" => "Vui lòng nhập mô tả của trang",
			"description_page.min" => "Mô tả của trang phải lớn hơn :min ký tự",
			"keyword_page.required" => "Vui lòng nhập từ khóa của trang",
			"keyword_page.min" => "Từ khóa của trang phải lớn hơn :min ký tự"
		);
	}
?>