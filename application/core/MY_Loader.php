<?php

class MY_Loader extends CI_Loader {
	function __construct(){
		
		parent::__construct();
		$this->CI =& get_instance();
		//$this->load->model('Foodcategory');

	}
	
	function master($template_name, $data = array(), $return = FALSE){
		/************************* product category ************************/	
		
		$data["template_name"] =  $template_name;
		$content = $this->view('master', $data, $return);
		if($return){
		return $content;
		}
	}

}
