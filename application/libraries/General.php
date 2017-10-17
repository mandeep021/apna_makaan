<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General {

	function __construct() {
		$CI =& get_instance();
	}
	// Used For Image and document upload
	function image_upload($para){
		global $CI;
			$path 		= isset($para["path"])?$para["path"]:'';
			$fields 	= isset($para["fields"])?$para["fields"]:'';
			$enc_name 	= isset($para["enc_name"])?$para["enc_name"]:true;
			$new_name 	= isset($para["new_name"])?$para["new_name"]:false;
			$width	 	= isset($para["width"])?$para["width"]:650;
			$height	 	= isset($para["height"])?$para["height"]:650;
			$ext	 	= isset($para["ext"])?$para["ext"]:'';
			$image	 	= isset($para["image"])?$para["image"]:true;
			
			$CI->load->library('Upload');
			if(!file_exists($path)){
				mkdir($path, 0777, true);
			}
			$config['upload_path']=$path;
			if($ext!='' && is_array($ext) && count($ext)>0){
				$ex='';
				for($i=0;$i<count($ext);$i++){
					$ex.=$ext[$i].'|';
				}
				$ex=rtrim($ex,'|');
			}
			else{
				$ex = 'gif|jpg|png|jpeg';
			}
			$config['allowed_types'] = $ex;
			//$config['encrypt_name'] = true;
			if($new_name){
				$config['file_name']=$new_name;
				$enc_name = false;
			}
			if($enc_name){
				$config['encrypt_name'] = true;
			}
			else{
				$config['encrypt_name'] = false;
			}
			$CI->upload->initialize($config);
			if($CI->upload->do_upload($fields)) {

					$value = $CI->upload->data();
					if($image){
						$this->image_resize($value['full_path'],$width,$height);
					}
					$value['error']='';
					return $value;
			}
			else{
				$value['error']=$CI->upload->display_errors();
				//$value='error';
				return $value;
			}
	}
	function image_resize($path,$width,$height){
		global $CI;
		$CI->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $width;
		$config['height'] = $height;
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
	}
	function document_upload($path,$name,$enc_name=true,$new_name=false,$ext=''){
		global $CI;

			$CI->load->library('upload');
			if(!file_exists($path)){
				mkdir($path, 0777, true);
			}
			if($new_name){
				$config['file_name']=$new_name;
				$enc_name = false;
			}
			if($enc_name){
				$config['encrypt_name'] = true;
			}
			else{
				$config['encrypt_name'] = false;
			}
			$config['upload_path']=$path;
			if($ext!='' && is_array($ext) && count($ext)>0){
				$ex='';
				for($i=0;$i<count(ext);$i++){
					$ex.=$ext[$i].'|';
				}
				$ex=rtrim($ex,'|');
			}
			else{
				$ex = 'doc|docx|pdf|gif|jpg|png|jpeg';
			}
			$config['allowed_types'] = $ex;
			$CI->upload->initialize($config);
			if($CI->upload->do_upload($name)) {

					$value = $CI->upload->data();
					$value['error']='';
					return $value;
			}
			else{
				$value['error']=$CI->upload->display_errors();
				return $value;
			}
	}
	public function get_config($name){
		global $CI;
		$CI->db->where('vName',$name);
		$query=$CI->db->get('configuration');
		$result= $query->result();
		return $result[0]->vValue;
	}
	// Used For General Database Operation Like Insert, Update, and Select
	public function get_all($table,$where = array(),$sorting = array()){
			global $CI;

			if(count($where)>0){
				$CI->db->where($where);
			}
			if(count($sorting)>0){
				$CI->db->order_by($sorting[0],$sorting[1]);
			}
			$query = $CI->db->get($table);
			return $query->result_array();
	}
	public function get($table,$select = '',$where = array(),$sorting = array()){
			global $CI;
			if($select != ''){
					$CI->db->select($select);
			}
			if(count($where)>0){
				$CI->db->where($where);
			}
			if(count($sorting)>0){
				$CI->db->order_by($sorting);
			}
			$query = $CI->db->get($table);
			return $query->result_array();
	}
	public function insert($table,$data){
			global $CI;
			$CI->db->insert($table, $data);
			return $CI->db->insert_id();
	}
	public function update($table,$data,$where){
			global $CI;
			return $CI->db->update($table,$data,$where);
	}
	public function delete($table,$where){
			global $CI;
			$CI->db->where($where);
			return $CI->db->delete($table);
	}
	public function cust_query($query){
		global $CI;
		return $CI->db->query($query);
	}
	// Used For Authentication
	public function checkAuth($admin=''){
		global $CI;
		$CI->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$CI->output->set_header('Pragma: no-cache');
		$CI->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$current_controller = $CI->router->fetch_class();
		if($CI->session->userdata('Id')=='' && $CI->session->userdata('Id')==null){
			$current_method = $CI->router->fetch_method()!='index'?$CI->router->fetch_method():'';
			$CI->session->set_userdata("requested_page", BASE_URL.$current_controller.'/'.$current_method);
			redirect(BASE_URL);
		}
	}
	// Used For Admin Authentication
	public function checkAdminAuth(){
		global $CI;
		$CI->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$CI->output->set_header('Pragma: no-cache');
		$CI->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$current_controller = $CI->router->fetch_class();
		if($CI->session->userdata('Id')=='' && $CI->session->userdata('Id')==null){
			$current_method = $CI->router->fetch_method()!='index'?$CI->router->fetch_method():'';
			$CI->session->set_userdata("requested_page", BASE_URL.$current_controller.'/'.$current_method);
			redirect(BASE_URL);
		}
		else if(!$CI->session->userdata('cr_admin')){
			redirect(BASE_URL);	
		}
	}

	// For Create Email Template from name
	public function send_mail($data){
		global $CI;
		$CI->load->library('email');
		$subject = $data['subject'];
		$body = $data['body'];	
		/*$CI->load->library('parser');
		$subject = $CI->parser->parse_string($subject,$data);
		if($template){
			$body = $CI->parser->parse_string($body,$data);	
		}*/
		
		/*$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; */
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'mail.projectsdgl.com',
		    'smtp_port' => 26,
		    'smtp_user' => 'skillindia@projectsdgl.com',
		    'smtp_pass' => 'Skill@India1',
		    'mailtype'  => 'html', 
		    'charset'   => 'utf-8'
		);
		
		
		$CI->email->initialize($config);
		$from = $data['from_email'];
		
		$CI->email->from($from, $data['from_name']);
		$CI->email->to($data['to_email']);
		$CI->email->subject($subject);	
		$CI->email->message($body);
		if ( !$CI->email->send())
		{
			    echo $CI->email->print_debugger();exit;
			return false;
		}
		else
		{

			return true;
		}
		return true;
	}
	public function IsvalidButterFlyID($bId='')
	{
		global $CI;
		if(isset($bId) && !empty($bId))
		{
			$num_rec = $CI->db->where('vButterfliesId',$bId)->get('childprofile')->num_rows();
			if($num_rec>0)
					 return true;
			else
			return false;
		}
		else	
			return false;
	}	
	
    
}
?>
