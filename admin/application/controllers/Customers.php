<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('customers_model');
		 $this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view('general/login');
	}
	
	
	public function customers($page=1) 
	{ 
		if(!empty($this->session->userdata('username')))
		{
			$customers['customers']=$this->customers_model->fetch_customers();
		
			$customers['page']=$page;
			$customers['max_page']=$this->customers_model->fetch_max_pages('customer');
           
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('customers/customers',$customers);
			$this->load->view('general/footer');
			
	
		}
		else redirect('general/index');
	}

    public function delete_customer()
    {
		$customer_id = $this->input->post('customer_id');
		$delete = $this->customers_model->delete_customer($customer_id);
	}
	
	public function edit_customer($customer_id)
	{
		if(!empty($this->session->userdata('username')))
		{
			$customer =$this->customers_model->fetch_customers($customer_id);
		    
		 
		    $data = array(
            	        'firstname' => $customer[0]->firstname,
            	        'lastname'=> $customer[0]->lastname,
            	        'customer_email' => $customer[0]->customer_email,
            	        'customer_telephone' => $customer[0]->customer_telephone,
            	        'customer_mobile' => $customer[0]->customer_mobile,
            	        'company_name' => $customer[0]->company_name,
            	        'customer_address' => $customer[0]->customer_address,
            	        'customer_id' => $customer[0]->customer_id
            	        );
	        
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('customers/edit_customer',$data);
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	function update_customer($customer_id)
	{
		    $firstname=$_POST['firstname'];
		    $lastname=$_POST['lastname'];
		    $customer_email=$_POST['customer_email'];
		    $customer_telephone=$_POST['customer_telephone'];
		    $customer_mobile=$_POST['customer_mobile'];
		    $company_name=$_POST['company_name'];
		    $customer_address=$_POST['customer_address'];
		    
		    
    	    if(isset($_FILES['customer_image']['name']) && $_FILES['customer_image']['name'] !=''){
                       
                      $image = $this->file_upload_code('customer_image');
                       $data = array(
            	        'firstname' =>$firstname,
            	        'lastname'=> $lastname,
            	        'customer_email' => $customer_email,
            	        'customer_telephone' => $customer_telephone,
            	        'customer_mobile' => $customer_mobile,
            	        'company_name' => $company_name,
            	        'customer_address' => $customer_address,
            	        'customer_image' => $image
            	        );
            }
            else{
                       $data = array(
            	        'firstname' =>$firstname,
            	        'lastname'=> $lastname,
            	        'customer_email' => $customer_email,
            	        'customer_telephone' => $customer_telephone,
            	        'customer_mobile' => $customer_mobile,
            	        'company_name' => $company_name,
            	        'customer_address' => $customer_address
            	        );
            }
		   
	        
	       	$this->customers_model->update_customer($data,$customer_id); 
	        redirect('customers/customers/1');
    }
  
	public function view_customer($customer_id)
	{
		if(!empty($this->session->userdata('username')))
		{
			$customer =$this->customers_model->fetch_customers($customer_id);
		    
		 
		    $data = array(
            	        'firstname' => $customer[0]->firstname,
            	        'lastname'=> $customer[0]->lastname,
            	        'customer_email' => $customer[0]->customer_email,
            	        'customer_telephone' => $customer[0]->customer_telephone,
            	        'customer_mobile' => $customer[0]->customer_mobile,
            	        'company_name' => $customer[0]->company_name,
            	        'customer_address' => $customer[0]->customer_address,
            	        'customer_image' => $customer[0]->customer_image,
            	        'customer_id' => $customer[0]->customer_id,
            	        'date_added' => $customer[0]->date_added
            	        );
	        
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('customers/view_customer',$data);
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	
	public function new_customer()
	{
		if(!empty($this->session->userdata('username')))
		{
		
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
		    $this->load->view('customers/new_customer');
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	
	function add_customer()
	{
		    $firstname=$_POST['firstname'];
		    $lastname=$_POST['lastname'];
		    $customer_email=$_POST['customer_email'];
		    $customer_telephone=$_POST['customer_telephone'];
		    $customer_mobile=$_POST['customer_mobile'];
		    $company_name=$_POST['company_name'];
		    $customer_address=$_POST['customer_address'];
		    
		    
    	    if(isset($_FILES['customer_image']['name']) && $_FILES['customer_image']['name'] !=''){
                       
                      $image = $this->file_upload_code('customer_image');
                       
            }
            else{
                     $image =""; 
            }
		   $data = array(
            	        'firstname' =>$firstname,
            	        'lastname'=> $lastname,
            	        'customer_email' => $customer_email,
            	        'customer_telephone' => $customer_telephone,
            	        'customer_mobile' => $customer_mobile,
            	        'company_name' => $company_name,
            	        'customer_address' => $customer_address,
            	        'customer_image' => $image
            	        );
	        
	       	$this->customers_model->add_customer($data); 
	        redirect('customers/customers/1');
    }
    public function file_upload_code($name_value=''){
                
                if(isset($name_value) && $name_value !=''){
                        
                         $config['upload_path'] = './uploaded_files/';
                         $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc|pptx';
                         $config['max_size'] = 200000;
                         $config['max_width'] = 2000;
                         $config['max_height'] = 2000;
                         
                         $new_name = uniqid().'_'.$_FILES[$name_value]['name'];
                         
                         $new_name = preg_replace('/\s+/', '_', $new_name);
                         $config['file_name'] = $new_name;
        
                         $this->load->library('upload', $config);
                         
                         if (!$this->upload->do_upload($name_value, $new_name)) {
                    
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error_msg', $error['error']);
                        
                        } 
                
                        return $new_name;
                            
                        }
    }
   
}

?>