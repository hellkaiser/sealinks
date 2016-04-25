<?php
	namespace Controllers\Admin;
	class ContactController extends \BaseController{
		public function getIndex(){
			$contact = \Contact::with("location")->get();
			foreach($contact as $k=>$item){
				$contact[$k]['location_name'] = $item->location()->with("locationTranslate")->first();
			}
			return \View::make("admin.contact.index")->with("title","Danh Sách Liên Hệ")->with("contact",$contact);
		}
		public function getAdd(){
			$location_select[0] = "Liên Hệ Trang Chủ";
			$location = \Location::with("locationTranslate")->get();
			if($location){
				foreach($location as $item){
					$location_select[$item->id] = $item->locationTranslate[0]->name;
				}
			}
			return \View::make("admin.contact.add")->with("title","Thêm Liên Hệ")->with("location_select",$location_select);
		}
		public function postAdd(){
			$valid = \Validator::make(\Input::all(),\Contact::$rule_add,\Contact::$lang_contact);
			if($valid->passes()){
				$phone = array_filter(\Input::get("phone"));
				 $data = json_encode($phone);

				$contact_insert = array(
					"title" => \Input::get("title"),
					"address" => \Input::get("address"),
					"phone" => $data,
					"fax" => \Input::get("fax"),
					"email" => \Input::get("email"),
				);
				if(\Input::get("location") != 0){
					$contact_insert['location_id'] = \Input::get("location");
				}
				\Contact::insert($contact_insert);
				return \Redirect::route("admin.contact_index_get")->with("success","bạn đã thêm thành công liên hệ");
			}else{
				return \Redirect::route("admin.contact_add_get")->with("error",$valid->errors()->first())->withInput(\Input::except('phone'));
			}
		}
		public function postAction($id){
			$contact = \Contact::find($id);
			if($contact){
				if(\Input::get("edit")){
					$rule_edit = array(
						"title" => "required|unique:contacts,title,$id",
						"address" => "required|min:10",
						"fax" => "required|min:10",
						"email" => "required|email",
					);
					$valid = \Validator::make(\Input::all(),$rule_edit,\Contact::$lang_contact);
					if($valid->passes()){
						$contact->title = \Input::get("title");
						$contact->address = \Input::get("address");
						$contact->phone = json_encode(array_filter(\Input::get("phone")));
						$contact->fax = \Input::get("fax");
						$contact->email = \Input::get("email");
						$contact->save();
						return \Redirect::route("admin.contact_index_get")->with("success","Bạn đã sửa thành công liên hệ : ".$contact->title);
					}else{
						return \Redirect::route("admin.contact_index_get")->with("error",$valid->errors()->first());
					}
				}elseif(\Input::get("del")){
					$contact->delete();
					return \Redirect::route("admin.contact_index_get")->with("success","Bạn đã xóa thành công liên hệ : ".$contact->title);
				}
			}else{
				return \Redirect::route("admin.index")->with("error","Liên hệ này không tồn tại trong hệ thống");
			}
		}
	}
?>