<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	public function index()
	{
		redirect(BASE_URL);
	}
	public function additional_room(){
		$this->general->checkAdminAuth();
		$additional_room = $this->general->get_all("tbl_additional_rooms",array("status !="=>2));
		$data = array();
		$data["additional_room"] = $additional_room;
		$this->load->view('admin/u_additional_room',$data);
	}

}
