<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('general_model');
	}
	public function index()
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
		    $this->session->set_userdata('usercourse',$res[0]->teacher_course_id);
	   
		if(empty($res) && $show_option == '')
		{
			//Login failed
			$data['login_error']=1;
			$this->load->view('general/teacher_login',$data);
		}
		else
		{
			//Login successful, open dashboard
			
			
			$this->zouki_mainpage();
			
		}
	}
	public function zouki_mainpage(){
	    
	    //$data=$this->general_model->fetch_dash_data();
	    
			$this->load->view('general/header-dash');
			$this->load->view('general/sidebar');
			$this->load->view('general/dashboard');

			$this->load->view('general/footer');
			
	}
	public function dashboard()
	{
		if(!empty($this->session->userdata('username')))
		{
			$this->load->model('general_model');
			//$data=$this->general_model->fetch_dash_data();
			$this->load->view('general/header-dash'); 			
			$this->load->view('general/sidebar');
			$this->load->view('teacher/dashboard');
			$this->load->view('general/footer-dash');
		}
		else redirect('general/index');
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('general/teacher');
	}
}
