<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
	
	}
	public function index()
	{
		redirect(BASE_URL);
	}
	public function view(){
		$this->general->checkAdminAuth();
		$admin  = $this->general->get_all("tbl_admin_users");
		
		$data = array();
		$data["admin"] = $admin;
		$this->load->view('admin/admin_view',$data);
	}
	public function action($id = ''){
		$this->general->checkAdminAuth();
		$data = array();
		if($id != ''){
			$admin = $this->general->get_all("tbl_admin_users",array("_id"=>$id));
			$data["admin"] = $admin;
		}
		$this->load->view('admin/admin_action',$data);
	}
	public function save_data(){
		$this->general->checkAdminAuth();
		$data = get_post_array();
		$admin_id = $data["admin_id"];
		unset($data["admin_id"]);
		if($admin_id == ''){
			$data["password"] = password_hash($data["password"],PASSWORD_DEFAULT);
			$admin_id = $this->general->insert("tbl_admin_users",$data);
		}
		else{
			$this->general->update("tbl_admin_users",$data,array("_id"=>$admin_id));
		}
		$redirect_url = ADMIN_URL.'madmin';
		echo true_return_response(array("msg"=>"Admin Inserted","redirect"=>$redirect_url));
	}
	public function delete_admin($id = '',$action){
		if($id == ''){
			$this->session->set_flashdata('error_msg', 'Error Occured, Please try again');
			redirect(ADMIN_URL.'madmin');
		}
		$data = array();
		$data["status"] = $action;
		$this->general->update("tbl_admin_users",$data,array("_id",$id));
		$this->session->set_flashdata('success_msg', 'Action Successfully');
		redirect(ADMIN_URL.'madmin');
	}

}
