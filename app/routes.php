<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
/**** Route Admin Control Panel ****/
Route::group(array("prefix"=>"admin"),function(){

	Route::get('/',array('as'=>'admin.index','before'=>'admin.check_user','uses'=>'Controllers\Admin\MainController@index'));
	/**** Route Login Admin ****/
	Route::get('login',array('as'=>'admin.login_get','before'=>'admin.is_login','uses'=>'Controllers\Admin\AuthController@getLogin'));
	Route::post('login',array('as'=>'admin.login_post','before'=>'csrf|admin.is_login','uses'=>'Controllers\Admin\AuthController@postLogin'));
	Route::get('logout',array('as'=>'admin.logout_get','before'=>'admin.check_user','uses'=>'Controllers\Admin\AuthController@getLogout'));
	/**** Route Location   ****/
	Route::get("location",array("as"=>"admin.location_index_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\LocationController@getList"));
	Route::get("location/add",array("as"=>"admin.location_add_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\LocationController@getAdd"));
	Route::post("location/add",array("as"=>"admin.location_add_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\LocationController@postAdd"));
	Route::get("location/edit/{id}",array("as"=>"admin.location_edit_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\LocationController@getEdit"))->where(array("id"=>"[0-9]+"));
	Route::post("location/edit/{id}",array("as"=>"admin.location_edit_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\LocationController@postEdit"))->where(array("id"=>"[0-9]+"));
	Route::get("location/del/{id}",array("as"=>"admin.location_del_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\LocationController@getDel"))->where(array("id"=>"[0-9]+"));
	/**** Route Service ****/
	Route::get("service",array("as"=>"admin.service_index_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\ServiceController@getList"));
	Route::get("service/add",array("as"=>"admin.service_add_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\ServiceController@getAdd"));
	Route::post("service/add",array("as"=>"admin.service_add_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\ServiceController@postAdd"));
	Route::get("service/edit/{id}",array("as"=>"admin.service_edit_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\ServiceController@getEdit"))->where(array("id"=>"[0-9]+"));
	Route::get("service/del/{id}",array("as"=>"admin.service_del_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\ServiceController@getDel"))->where(array("id"=>"[0-9]+"));
	Route::post("service/edit/{id}",array("as"=>"admin.service_edit_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\ServiceController@postEdit"))->where(array("id"=>"[0-9]+"));
	Route::post("service/activeall",array("as"=>"admin.service_editall_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\ServiceController@postEditAll"));
	/*** Route user ****/
	Route::get("user",array("as"=>"admin.user_index_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\UserController@getList"));
	Route::get("user/add",array("as"=>"admin.user_add_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\UserController@getAdd"));
	Route::post("user/add",array("as"=>"admin.user_add_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\UserController@postAdd"));
	Route::post("user/editall",array("as"=>"admin.user_editall_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\UserController@postEditAll"));
	Route::get("user/edit/{id}",array("as"=>"admin.user_edit_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\UserController@getEdit"))->where("id","[0-9]+");
	Route::get("user/del/{id}",array("as"=>"admin.user_del_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\UserController@getDel"))->where("id","[0-9]+");
	Route::post("user/edit/{id}",array("as"=>"admin.user_edit_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\UserController@postEdit"))->where("id","[0-9]+");
	/**** Route Setting  ****/
	Route::get("setting",array("as"=>"admin.setting_index_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\SettingController@getIndex"));
	Route::post("setting/general",array("as"=>"admin.setting_general_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\SettingController@postGeneral"));
	Route::post("setting/email",array("as"=>"admin.setting_email_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\SettingController@postEmail"));
	/**** Route Contact ****/
	Route::get("contact",array("as"=>"admin.contact_index_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\ContactController@getIndex"));
	Route::get("contact/add",array("as"=>"admin.contact_add_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\ContactController@getAdd"));
	Route::post("contact/add",array("as"=>"admin.contact_add_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\ContactController@postAdd"));
	Route::post("contact/action/{id}",array("as"=>"admin.contact_action_post","before"=>"csrf|admin.check_access:superuser","uses"=>"Controllers\Admin\ContactController@postAction"))->where(array("id","[0-9]+"));
	/**** Route Menu ****/
	Route::get("menu",array("as"=>"admin.menu_index_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\MenuController@getIndex"));
	Route::get("menu/update",array("as"=>"admin.menu_update_get","before"=>"admin.check_access:superuser","uses"=>"Controllers\Admin\MenuController@getUpdate"));
});