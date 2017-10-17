<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct() {
		parent::__construct();
	
	}
	public function index()
	{

	}
	public function view(){
		$data = array();
			if($this->session->userdata('cr_admin')){
				if($this->session->userdata('Id')!='' && $this->session->userdata('Id')!=null){
					redirect(ADMIN_URL.'dashboard');
				}
			}
			//$country = $this->general->get_all("tbl_country",array("status"=>1));
			//$data["country"] = $country;
			$this->load->view('admin/login',$data);
	}
	public function do_login(){
		$return = array();
		$email_id = isset($_REQUEST["email_id"])?$_REQUEST["email_id"]:'';
		$password = isset($_REQUEST["password"])?$_REQUEST["password"]:'';

		if(!$email_id || !$password){
			$return['status'] = false;
			$return['msg'] = "Please Fill all the data";
			echo json_encode($return);exit;
		}
		$result = $this->general->get_all("tbl_admin_users",array("email_id"=>$email_id));

		if(count($result)<=0){
			$return['status'] = false;
			$return['msg'] = "Invalid Username id or password";
			echo json_encode($return);exit;
		}
		//echo password_hash($password,PASSWORD_DEFAULT).' => '.$result[0]['password'];exit;
		if(!password_verify($password,$result[0]['password'])){
			$return['status'] = false;
			$return['msg'] = "Invalid Username id or password";
			echo json_encode($return);exit;
		}
		else if($result[0]["status"] != 1){
			$return['status'] = false;
			$return['msg'] = "Sorry, You are inactive, please contact to administrator for further information";
			echo json_encode($return);exit;	
		}
		$this->session->set_userdata("Id", 1);
		$this->session->set_userdata("user_name", $result[0]['username']);
		$this->session->set_userdata("userId", $result[0]['_id']);
		$this->session->set_userdata("cr_admin", true);
		
		$return['redirect'] = $this->session->userdata('requested_page') ? $this->session->userdata('requested_page') : ADMIN_URL.'dashboard';
		
		$return['status'] = true;
		$return['msg'] = 'Authenticate';
		echo json_encode($return);exit;
	}
	public function do_logout(){
		$this->session->sess_destroy();
		redirect(ADMIN_URL);
	}
	public function change_password($id = ''){
		if($id == ''){
			$this->session->set_flashdata('for_verify_error', 'Invalid Code');
			redirect(BASE_URL);
		}
		$check = $this->general->get_all("tbl_users",array("forgot_code"=>$id));
		if(count($check)<=0){
			$this->session->set_flashdata('for_verify_error', 'Invalid Code');
			redirect(BASE_URL);
		}
		$this->session->set_flashdata('for_user_id', $check[0]["_id"]);
		$this->session->set_flashdata('for_success_msg', 'Email address is Successfully Verified');

		redirect(BASE_URL);
	}
	public function reset_password(){
		$id = isset($_REQUEST["id"])?$_REQUEST["id"]:'';
		$password = isset($_REQUEST["pass"])?$_REQUEST["pass"]:'';
		if($password == ''){
			$return["status"] = false;
			$return["msg"] = "Please enter password";
			echo json_encode($return);exit;
		}

		$data = array();
		$data["password"] 		= md5($password);
		$data["forgot_code"]	= '';
		$this->general->update("tbl_users",$data,array("_id"=>$id));
		$return["status"] = true;
		$return["msg"] = "Your Password has been changed successfully";
		echo json_encode($return);exit;
	}
}
