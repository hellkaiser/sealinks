<?php
	class Service extends Eloquent{
		protected $table = "services";
		protected $guarded = array("id");
		public $timestamps = false;
		public static $rule_add_vn = array(
			"service_name_vn" => "required|unique:services_translate,name",
			"service_description_vn" => "required|min:10"
		);
		public static $rule_add_en = array(
			"service_name_en" => "required|min:3",
			"service_description_en" => "required|min:10"
		);
		public static $lang_service = array(
			"service_name_vn.required" => "Vui lòng nhập tên dịch vụ tiếng việt",
			"service_name_vn.unique" => "Tên dịch vụ tiếng việt đã tồn tại, vui lòng chọn tên khác",
			"service_description_vn.required" => "Vui lòng nhập mô tả dịch vụ tiếng việt",
			"service_description_vn.min" => "Mô tả dịch vụ tiếng việt phải lớn hơn :min ký tự",
			"service_name_en.required" => "Vui lòng nhập tên dịch vụ tiếng anh",
			"service_name_en.min" => "Tên dịch vụ tiếng anh phải lớn hơn :min ký tự",
			"service_description_en.required" => "Vui lòng nhập mô tả dịch vụ tiếng anh",
			"service_description_en.min" => "Mô tả dịch vụ tiếng việt phải lớn hơn :min ký tự"
		);
		public function serviceTranslate(){
			return $this->hasMany("ServiceTranslate","service_id");
		}
		public function location(){
			return $this->belongsToMany("Location","location_service")->withPivot('id');
		}
		public function newPivot(Eloquent $parent, array $attributes, $table, $exists) {
	        if ($parent instanceof Service) {
	            return new LocationService($parent, $attributes, $table, $exists);
	        }
	        return parent::newPivot($parent, $attributes, $table, $exists);
	    }
	}
?>