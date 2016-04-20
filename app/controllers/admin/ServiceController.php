<?php
	namespace Controllers\Admin;
	class ServiceController extends \BaseController{
		public function getList(){
			// Lấy dữ liệu từ kết các bảng sau : service, service_translate, location
			$data = \Service::with("serviceTranslate","location")->get();
			if($data){
				foreach($data as $k=>$v){
					// lấy tên location thuộc bảng location_translate
					$data[$k]['location_name'] = $v->location()->with(array("locationTranslate"=>function($query){
						$query->where("lang_code","vn");
					}))->get();
				}
				foreach($data as $k=>$v){
					// lấy tên service thuộc bảng service_translate
					$data[$k]['service_parent'] = \Service::with("serviceTranslate")->find($v->parent);	
				}
			}
				
			return \View::make("admin.service.index")->with("title","Danh Sách Dịch Vụ")->with("data",$data);
		}
		public function getAdd(){
			$service_select[0] = "Dịch Vụ Cha";
			// lấy location với language là vietnam
			$location = \LocationTranslate::with("location")->where("lang_code","vn")->get();

			// lấy service với language là vietnam
			$service = \ServiceTranslate::with("service")->where("lang_code","vn")->get();
			if($service){
				// nếu tồn tại service
				foreach($service as $item){
					// lưu service theo dạng select để truyền vào select box
					$service_select[$item->service->id] = $item->name; 
				}
			}
			return \View::make("admin.service.add")->with("title","Thêm Dịch Vụ")->with("location",$location)->with("service",$service_select);
		}
		public function postAdd(){
			$service_name_en = \Input::get("service_name_en");
			$service_description_en = \Input::get("service_description_en");
			$rule = \Service::$rule_add_vn;
			if($service_name_en != "" || $service_description_en != ""){
				// nếu tên hoặc mô tả tiếng anh có tồn tại thì thêm rule cho validator
				$rule = array_merge($rule,\Service::$rule_add_en);
			}
			$valid = \Validator::make(\Input::all(),$rule,\Service::$lang_service);
			if($valid->passes()){
				// tạo service
				$service_insert = \Service::create(array(
					"status" => 0,
					"parent" => \Input::get("service")
				));
				$service_id = $service_insert->id;
				$service = \Service::find($service_id);

				// đưa nội dung vào bảng pivot location_service
				foreach(\Input::get("location") as $item){
					$service->location()->attach(\Input::get("location"));
				}
				// tạo service translate tiếng việt cho service vừa tạo
				$data_insert_vn = new \ServiceTranslate(array(
					"name" => \input::get("service_name_vn"),
					"description" => \Input::get("service_description_vn"),
					"lang_code" => "vn"
				));
				$service->serviceTranslate()->save($data_insert_vn);

				if($service_name_en != "" && $service_description_en != ""){
					//nếu có dữ liệu tên và mô tả tiếng anh thì thêm service tiếng anh
					$data_insert_en = new \ServiceTranslate(array(
						"name" => \input::get("service_name_en"),
						"description" => \Input::get("service_description_en"),
						"lang_code" => "en"
					));
					$service->serviceTranslate()->save($data_insert_en);
				}
				return \Redirect::route("admin.service_index_get")->with("success","Bạn đã tạo thành công dịch vụ");
			}else{
				return \Redirect::route("admin.service_add_get")->with("error",$valid->errors()->first())->withInput();
			}
		}
		public function getEdit($id){
			$service_select[0] = "Dịch Vụ Cha";
			// lấy location với language là việt nam
			$location = \LocationTranslate::with("location")->where("lang_code","vn")->get();

			// lấy service với language là english
			$service = \ServiceTranslate::with("service")->where("lang_code","vn")->get();
			if($service){
				// nếu có service
				foreach($service as $item){
					//lưu service theo dạng select để truyền vào select box
					$service_select[$item->service->id] = $item->name; 
				}
			}

			// lấy service với id 
			$service_item = \Service::with("serviceTranslate","location")->find($id);
			// lấy service theo language vietnam
			$service_item['vn'] = $service_item->serviceTranslate()->where("lang_code","vn")->first();
			// lấy service theo language enlish
			$service_item['en'] = $service_item->serviceTranslate()->where("lang_code","en")->first();
			return \View::make("admin.service.edit")->with("title","Sửa Dịch Vụ")->with("location",$location)->with("service",$service_select)->with("service_item",$service_item);
		}
		public function postEdit($id){
			$service_name_en = \Input::get("service_name_en");
			$service_description_en = \Input::get("service_description_en");
			// lấy service theo id
			$service = \Service::with("serviceTranslate","location")->find($id);
			$rule = array(
				"service_name_vn" => "required|unique:services_translate,name,".$service->serviceTranslate[0]->id,
				"service_description_vn" => "required|min:10"
			);
			if($service_name_en != "" || $service_description_en != ""){
				// nếu tồn tại tên và mô tả tiếng anh thì thêm rule
				$rule = array_merge($rule,\Service::$rule_add_en);
			}
			$valid = \Validator::make(\Input::all(),$rule,\Service::$lang_service);
			if($valid->passes()){
				// update service
				$service->parent = \Input::get("service");
				$service->save();

				// update bảng pivot service_location
				$service->location()->sync(\Input::get("location"));

				// update service translate tiếng việt
				$service->serviceTranslate()->where("lang_code","vn")->update(array(
						"name" => \Input::get("service_name_vn"),
						"description" => \Input::get("service_description_vn")
				));

				// lấy dữ liệu service tiếng anh
				$service_en = $service->serviceTranslate()->where("lang_code","en")->first();
				if($service_name_en != "" && $service_description_en != ""){
					// nếu tên và mô tả tiếng anh tồn tại
					if(count($service_en) > 0){
						// nếu dữ liệu tiếng anh đã tồn tại trong db, update service translate tiếng anh
						$service_en->update(array(
							"name" => $service_name_en,
							"description" => $service_description_en
						));
					}else{
						// nếu dữ liệu tiếng anh không tồn tại trong db, tạo service translate tiếng anh
						$data_insert_en = new \ServiceTranslate(array(
							"name" => $service_name_en,
							"description" => $service_description_en,
							"lang_code" => "en"
						));
						$service->serviceTranslate()->save($data_insert_en);
					}
				}else{
					// nếu không có tên và mô tả tiếng anh
					if(count($service_en) > 0){
						// nếu có dữ liệu tiếng anh trong db, xóa service translate tiếng anh
						$service_en->delete();
					}
				}
				return \Redirect::route("admin.service_index_get")->with("success","Bạn đã sửa dịch vụ thành công");
			}else{
				return \Redirect::route("admin.service_edit_get",array($service->id))->with("error",$valid->errors()->first());
			}
		}
		public function getDel($id){
			$service = \Service::find($id);
			$service->delete();
			return \Redirect::route("admin.service_index_get")->with("success","Bạn đã xóa dịch vụ thành công");
		}
		public function postEditAll(){
			$active = \Input::get("active");
			$reactive = \Input::get("reactive");
			$id = \Input::get("checkbox_status");
			if(isset($active)){
				// nếu nút nhấn là active thì chuyển trạng thái thành active
				foreach($id as $item){
					$service = \Service::find($item);
					if($service->status == 0){
						$service->status = 1;
						$service->save();
					}
				}
				return \Redirect::route("admin.service_index_get")->with("success","Bạn đã thay đổi trạng thái thành công");
			}elseif(isset($reactive)){
				// nếu nút nhấn là reactive thì chuyển trạng thái thành reactive
				foreach($id as $item){
					$service = \Service::find($item);
					if($service->status == 1){
						$service->status = 0;
						$service->save();
					}
				}
				return \Redirect::route("admin.service_index_get")->with("success","Bạn đã thay đổi trạng thái thành công");
			}
		}
	}
?>