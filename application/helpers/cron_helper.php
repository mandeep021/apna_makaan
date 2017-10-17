<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('false_return_response'))
{
    function false_return_response($msg = '')
    {
        $return = array();
		$return["status"] 	= false;
		$return["msg"] 		= $msg;
		$return["data"] 	= array();
		return json_encode($return);
    }   
}
if(!function_exists('true_return_response')){
	function true_return_response($para = array()){
		$return = array();
		$return["status"] 	= true;
		$return["msg"] 		= "Successfully";
		$return["data"] 	= isset($para["data"])?$para["data"] :array();
		$return["redirect"] = isset($para["redirect"])?$para["redirect"] : false;
		return json_encode($return);
	}
}
if(!function_exists('get_post_array')){
	function get_post_array(){
		$data = array();
		foreach ($_POST as $key => $value) {
			$data[$key] = $value;
		}
		if(count($data)<=0){
			return array();
		}
		return $data;
	}
}
if(!function_exists('print_array')){
	function print_array($array){
		echo '<pre>';print_r($array);echo '</pre>';
	}
}
if(!function_exists('get_images_url')){
	function get_images_url($image_name,$path,$join = ''){

		$default_image = PUBLIC_HTML.'images/no_image_found.png';
		if($image_name == '' || $path == ''){
			return $default_image;
		}
		if($join != ''){
			$join=$join.'/';
		}
		if(!file_exists($path.$join.$image_name)){
			return $default_image;
		}
		return BASE_URL.$path.$join.$image_name;
	}
}
if(!function_exists('age_calculator')){
	function age_calculator($dob){
		return date_diff(date_create($dob), date_create('today'))->y;
	}
}
if(!function_exists('get_status')){
	function get_status($status_code = 0){
		switch ($status_code) {
		    case 0:
		        return "In Active";
		        break;
		    case 1:
		        return "Active";
		        break;
		    case 2:
		        return "Deleted";
		        break;
		}
	}
}