<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
	
	}
	public function index()
	{
		redirect(BASE_URL);
	}
	public function view(){
		$this->load->view('admin/dashboard');
	}
}
