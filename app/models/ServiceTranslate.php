<?php
	class ServiceTranslate extends Eloquent{
		protected $table = "services_translate";
		protected $guarded = array("id");
		public $timestamps = false;
		public function service(){
			return $this->belongsTo("Service","service_id");
		}
		public function language(){
			return $this->belongsTo("Language","lang_code");
		}
	}
?>