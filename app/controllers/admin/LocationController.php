<?php
	namespace Controllers\Admin;
	class LocationController extends \BaseController{
		// method get location list
		public function getList(){
			$data = \Location::with("locationTranslate")->get();
			return \View::make("admin.location.index")->with("title","Danh Sách Địa Điểm")->with("data",$data);
		}
		// method get form add location
		public function getAdd(){
			return \View::make("admin.location.add")->with("title","Thêm Địa Điểm");
		}
		// method handle add location
		public function postAdd(){
			$valid = \Validator::make(\Input::all(),\Location::$rule_add,\Location::$lang_location);
			if($valid->passes()){
				// get english name of location
				$name_en = \Input::get("location_name_en");

				/* insert location into model Location */
				$location_insert = \Location::create(array(
						"slug" => \Input::get("slug")
				));
				$location_id = $location_insert->id;
				$location = \Location::find($location_id);

				/* insert data of location follow vietnam language */
				$data_insert_vn = new \LocationTranslate(array(
						"name" => \Input::get("location_name_vn"),
						"lang_code" => "vn"
				));
				$location->locationTranslate()->save($data_insert_vn);

				// check english name of location exitst
				if($name_en != ""){
					/*if exitst, insert data of location follow english language  */
					$data_insert_en = new \LocationTranslate(array(
						"name" => $name_en,
						"lang_code" => "en"
					));	
					$location->locationTranslate()->save($data_insert_en);
				}
				return \Redirect::route("admin.location_index_get")->with("success","Bạn đã tạo địa điểm thành công");
			}else{
				return \Redirect::route("admin.location_add_get")->with("error",$valid->errors()->first());
			}
		}
		// method get form edit location
		public function getEdit($id){
			// get location by id
			$location = \Location::with("locationTranslate")->find($id);
			//get data by vietnam language of location
			$location['vn'] = $location->locationTranslate()->where("lang_code","vn")->first();
			// get data by english language of location
			$location['en'] = $location->locationTranslate()->where("lang_code","en")->first();
			return \View::make("admin.location.edit")->with("title","Sửa Địa Điểm")->with("location",$location);
		}
		// method handle edit location
		public function postEdit($id){
			$rule = array(
				"location_name_vn" => "required|min:5",
				"slug" => "required|min:5|unique:locations,slug,$id"
			);
			$valid = \Validator::make(\Input::all(),$rule,\Location::$lang_location);
			if($valid->passes()){
				// update location by id
				$location = \Location::find($id);
				$location->slug = \Input::get("slug");
				$location->save();

				//update vietnam language of location
				$location->locationTranslate()->where("lang_code","vn")->update(array(
					"name"=>\Input::get("location_name_vn")
				));
				// get english language of location 
				$location_en = $location->locationTranslate()->where("lang_code","en")->first();
				// check input english language of location is exitst
				if(\Input::get("location_name_en") != ""){
					// if exitst, check english language of location is exitst in database
					if(count($location_en) > 0){
						/* if exitst, update english language of location */
						$location->locationTranslate()->where("lang_code","en")->update(array(
								"name"=>\Input::get("location_name_en")
							));
					}else{
						/* if not exitst, add english language of location */
						$data_insert_en = new \LocationTranslate(array(
							"name" => \Input::get("location_name_en"),
							"lang_code" => "en"
						));	
						$location->locationTranslate()->save($data_insert_en);
					}
				}else{
					// if input english location not exitst
					if(count($location_en) > 0){
						// if exitst english location in database, delete this location
						$location->locationTranslate()->where("lang_code","en")->delete();
					}
				}
				return \Redirect::route("admin.location_index_get")->with("success","Bạn đã sửa địa điểm thành công");
			}else{
				return \Redirect::route("admin.location_edit_get",array($id))->with("error",$valid->errors()->first());
			}
		}
		// method handle delete location
		public function getDel($id){
			$location = \Location::find($id);
			$location->delete();
			return \Redirect::route("admin.location_index_get")->with("success","Bạn đã xóa địa điểm thành công");
		}
	}
?>