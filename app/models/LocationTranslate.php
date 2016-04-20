<?php
	class LocationTranslate extends Eloquent{
		protected $table = "locations_translate";
		protected $guarded = array("id");
		public $timestamps = false;
		public function location(){
			return $this->belongsTo("Location","location_id");
		}
		public function language(){
			return $this->belongsTo("Language","lang_code");
		}
	}
?>