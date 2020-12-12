<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('general_model');
			$this->load->library('email');
	}
	public function index()
	{
		$this->load->view('general/login');
	}
	public function teacher()
	{
		$this->load->view('general/teacher_login');
	}
	public function login($show_option ='')
	{
	    
	    $acc_type=$_POST["acc_type"];
	    
		$username=$_POST["username"];
		$password=$_POST["password"];
	
		$res=$this->general_model->validateLogin($username,$password,$acc_type);
		
		$this->session->set_userdata('username',$res[0]->username);
		$this->session->set_userdata('useracc',$res[0]->acc_type);
		$fullname=$res[0]->firstname." ".$res[0]->lastname;
		$this->session->set_userdata('userfullname',$fullname);
		$this->session->set_userdata('userimg',$res[0]->image);
			
		if(empty($res) && $show_option == '')
		{
			//Login failed
			$data['login_error']=1;
			
			$this->load->view('general/login',$data);
		}
		else
		{
			//Login successful, open dashboard
			
			$this->zouki_mainpage();
			
		}
	}
	public function zouki_mainpage(){
	    
	    $data=$this->general_model->fetch_dash_data();
	    
			$this->load->view('general/header-dash');
			$this->load->view('general/sidebar');
			$this->load->view('general/dashboard',$data);

			$this->load->view('general/footer-dash');
			
	}
	public function dashboard()
	{
		if(!empty($this->session->userdata('username')))
		{
			$this->load->model('general_model');
			$data=$this->general_model->fetch_dash_data();
			$this->load->view('general/header-dash'); 			
			$this->load->view('general/sidebar');
			$this->load->view('general/dashboard',$data);
			$this->load->view('general/footer-dash');
		}
		else redirect('general/index');
	}
	public function forget_password()
	{
		$this->load->view('general/forget_password');
		
	}
	public function reset_password($form=''){
	   // ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	    
	    if(isset($form) && $form !='admin'){
	        
	        if(isset($_POST["new_pwd"]) && $_POST["new_pwd"] !=''){
	            
	            $updated = $this->general_model->update_pass($_POST["new_pwd"]);
	            
	            if($updated){
					// echo "done";
					// exit;
					$this->load->view('general/reset_password_successfull');
	            }
	            
	        }else{
	         $data = array(
					'identity'		=> $this->input->post('email'),
					
				);
                 $config['mailtype'] = 'html';
                  $config['protocol'] = 'sendmail';
          //$config['charset'] = 'iso-8859-1';

                 $this->email->initialize($config);
		           $message = $this->load->view('general/forgot_pwd', $data, true);
					$this->email->clear();
					$this->email->from('info@excellenceacademyofmusic.com');
					$this->email->to('sree03m@gmail.com');
					// $this->email->cc('ranjit@sugarinc.in');
					$this->email->subject('Excellenceacademyofmusic - Password Reset Link');
					$this->email->message($message);
					if ($this->email->send())
					{
					echo "<h2>Password reset link sent to email</h2>";
						exit;
					}
					
	        }
	           
	    }else{
	       
	        	$this->load->view('general/reset_password');
	        
	    }
	}
	public function customers()
	{
		if(!empty($this->session->userdata('username')))
		{
			$data['companies']=$this->general_model->fetch_companies();
			$data['departments']=$this->general_model->fetch_departments();
			$data['customers']=$this->general_model->fetch_customers();
		
			
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('general/customers',$data);
			$this->load->view('general/footer');			
		}
		else redirect('general/index');
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('general/index');
	}
	
}
