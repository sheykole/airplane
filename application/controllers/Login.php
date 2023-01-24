<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('func_helper');
		$this->load->model('admin_m');
		$this->load->helper('form');
	}
	function index()
	{
		
		$data['title'] = "Admin - Login";
		$data[]="";
		if($_POST)
		{
			//echo $ip =$_SERVER['REMOTE_ADDR'];die();	
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if($this->form_validation->run() == true)
			{
				//echo 'here';die();	
				$username = $this->input->post('username', TRUE);
				$password = hash_pass($this->input->post('password'));
				$data = array('username' => $username, 'password'=>$password);
				
				//check the status of the user
						$result = $this->admin_m->get($this->security->xss_clean($data),true);
						if($result)
						{
									
									$data = array(
										'username'=>$result->username,
										'name' =>$result->name,
										'user_type' =>$result->type,
										'is_logged_in'=>1,
										'verify'=>0
									);
									$this->session->set_userdata($data);
									$date= date("Y-m-d H:i:s");
									$dat = array('last_login'=>$date);
									$whr = array('username'=>$username);
									$this->admin_m->save($dat,$whr);
									
										$this->session->set_userdata($data);
										redirect('admin','refresh');							
								
							}
							else
							{
								$this->session->set_flashdata('warn',"Invalid login details, try again");
							}
			}
		}
		$this->load->view('login',$data);
	}	
	
	
	
}

