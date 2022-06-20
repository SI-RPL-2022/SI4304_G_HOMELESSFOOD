<?php

if(!function_exists('show_alert')){
	function show_alert($message, $status){
		return '<div class="alert alert-'.$status.' alert-dismissible">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  '.$message.'
				</div>';
	}
}

if(!function_exists('is_login')){
	function is_login(){
		if(Session::has('user')) return true;
		return false;
	}
}


if(!function_exists('is_admin')){
	function is_admin(){
		if(!is_login()) return false;
		if(Session::get('user')->akses == 'admin') return true;

		return false;
	}
}

if(!function_exists('is_driver')){
	function is_driver(){
		if(!is_login()) return false;
		if(Session::get('user')->akses == 'driver') return true;

		return false;
	}
}

if(!function_exists('is_user')){
	function is_user(){
		if(!is_login()) return false;
		if(Session::get('user')->akses == 'user') return true;

		return false;
	}
}