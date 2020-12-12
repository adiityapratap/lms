<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('content_model');
		 $this->load->helper('url');
	}
	
		public function index()
	{
		$this->load->view('general/login');
	}
	
	/* Video */
	public function videos($page=1) 
	{ 
		if(!empty($this->session->userdata('username')))
		{
             $data['video_content_slider']=$this->content_model->fetch_video_url('slider');
            $data['video_content']=$this->content_model->fetch_video_url('why_us');
          
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('content/videos',$data);
			$this->load->view('general/footer');
			
	
		}
		else redirect('general/index');
	}
	public function update_video_content() 
	{ 
		if(!empty($this->session->userdata('username')))
		{
		    $video_url1 = $_POST['video_url1'];
		    $video_url2 = $_POST['video_url2'];
		    $video_url3 = $_POST['video_url3'];
		    $video_url4 = $_POST['video_url4'];
		    $video_url5 = $_POST['video_url5'];
		    $why_choose_us = $_POST['why_choose_us'];
		    
		     $data1 = array(
			  'video_url1' => $video_url1,
			  'video_url2' => $video_url2,
			  'video_url3' => $video_url3,
              'video_url4' => $video_url4,
              'video_url5' => $video_url5
              );
              
              $data2 = array(
			  'video_url1' => $why_choose_us
              );
              
              
            $this->content_model->update_video_content($data1,'slider');
             $this->content_model->update_video_content($data2,'why_us');
		    redirect('content/videos');
			
	
		}
		else redirect('general/index');
	}
	
	/* testimonials */
	public function testimonials($page=1) 
	{ 
		if(!empty($this->session->userdata('username')))
		{
             $data['testimonials']=$this->content_model->fetch_testimonials();
          
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('content/testimonials',$data);
			$this->load->view('general/footer');
			
	
		}
		else redirect('general/index');
	}
	public function new_testimonial()
	{
		if(!empty($this->session->userdata('username')))
		{
		    
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('content/new_testimonial');
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	public function add_new_testimonial() 
	{ 
		if(!empty($this->session->userdata('username')))
		{
		    $username = $_POST['username'];
		    $comment = $_POST['comment'];
		    
		     $data = array(
			  'username' => $username,
              'comment' => $comment
              );
              
            $this->content_model->add_testimonials($data);
		    redirect('content/testimonials');
			
	
		}
		else redirect('general/index');
	}
	public function delete_testimonial(){

			  echo $testimonial_id = $this->input->post('testimonial_id');
			  
			$delete = $this->content_model->delete_testimonial($testimonial_id);
	}
}