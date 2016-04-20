<?php
	class Location extends Eloquent{
		protected $table = "locations";
		protected $guarded = array("id");
		public $timestamps = false;
		public static $rule_add = array(
			"location_name_vn" => "required|min:5",
			"slug" => "required|min:5|unique:locations,slug"
		);
		public static $lang_location = array(
			"location_name_vn.required" => " Vui lòng nhập tên địa điểm",
			"location_name_vn.min" => "Vui lòng nhập tên địa điểm lớn hơn :min ký tự",
			"slug.required" => "Vui lòng nhập Slug",
			"slug.min" => "Vui lòng nhập slug lớn hơn :min ký tự",
			"slug.unique" => "Slug đã tồn tại, vui lòng nhập slug khác"
		);
		public function locationTranslate(){
			return $this->hasMany("LocationTranslate","location_id");
		}
		public function service(){
			return $this->belongsToMany("Service","location_service")->withPivot('id');
		}
		public function newPivot(Eloquent $parent, array $attributes, $table, $exists) {
	        if ($parent instanceof Location) {
	            return new LocationService($parent, $attributes, $table, $exists);
	        }
	        return parent::newPivot($parent, $attributes, $table, $exists);
	    }
	}
?>