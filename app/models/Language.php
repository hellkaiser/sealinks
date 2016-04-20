<?php
	class Language extends Eloquent{
		protected $table = "Languages";
		protected $guarded = array("code");
		protected $primaryKey = 'code';
		public $timestamps = false;
		public function locationTranslate(){
			return $this->hasMany("LocationTranslate","lang_code","code");
		}
		public function serviceTranslate(){
			return $this->hasMany("ServiceTranslate","lang_code","code");
		}
	}
?>