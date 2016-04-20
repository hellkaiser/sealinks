<?php
	class LocationService extends Pivot{
		protected $table = "location_service";
		protected $guarded = array("id");
		public $timestamps = false;
		public function location(){
			return $this->belongsTo("Location","location_id");
		}
		public function service(){
			return $this->belongsTo("Service","service_id");
		}
	}
?>