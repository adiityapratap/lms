<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('courses_model');
		 $this->load->helper('url');
	}
	
		public function index()
	{
		$this->load->view('general/login');
	}
	
	public function courses($page=1) 
	{ 
		if(!empty($this->session->userdata('username')))
		{
			$courses['courses']=$this->courses_model->fetch_courses();
			//$courses['page']=$page;
			//$courses['max_page']=$this->courses_model->fetch_max_pages('courses');
             
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/courses',$courses);
			$this->load->view('general/footer');
			
	
		}
		else redirect('general/index');
	}
	
	public function new_course()
	{
		if(!empty($this->session->userdata('username')))
		{
		    
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/new_course');
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	
	public function add_new_course()
	    {
	
		$course_name=$_POST['course_name'];
		$course_custom_heading=$_POST['course_custom_heading'];
	    $course_description=$_POST['course_description'];
	    $course_short_description=$_POST['course_short_description'];
	    $other_details=$_POST['other_details'];
	    $feature_1=$_POST['feature_1'];
	    $feature_2=$_POST['feature_2'];
	    $feature_3=$_POST['feature_3'];
	    $feature_4=$_POST['feature_4'];
	    $feature_5=$_POST['feature_5'];
	    $video_url1 = $_POST['video_url1'];
		$video_url2 = $_POST['video_url2'];
		$video_url3 = $_POST['video_url3'];
		$video_url4 = $_POST['video_url4'];
		$video_url5 = $_POST['video_url5'];
	    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !=''){
                   
                  $image = $this->file_upload_code('image');
        }
        else{
                   $image ='';
        }
        // if(isset($_FILES['course_header_image']['name']) && $_FILES['course_header_image']['name'] !=''){
                   
        //           $course_header_image = $this->file_upload_code('course_header_image');
        //         //  if($this->file_upload_code('course_header_image')){
        //         //      echo "uploaded";
        //         //  }
        // }
        // else{
        //           $course_header_image ='';
        // }
        
	    $data = array(
	        'course_name' =>$course_name,
	        'course_custom_heading' =>$course_custom_heading,
	        'course_description'=> $course_description,
	        'course_short_description'=> $course_short_description,
	        'other_details'=> $other_details,
	        'course_image'=>$image,
	        'feature_1'=> $feature_1,
	        'feature_2'=> $feature_2,
	        'feature_3'=> $feature_3,
	        'feature_4'=> $feature_4,
	        'feature_5'=> $feature_5,
	        'video_url1' => $video_url1,
			'video_url2' => $video_url2,
			'video_url3' => $video_url3,
            'video_url4' => $video_url4,
            'video_url5' => $video_url5,
	       // 'course_header_image'=>$course_header_image
	        );
	        
	       //echo "<pre>";
	       //print_r($data);
	       //exit;
		$this->courses_model->add_new_course($data);
		redirect('courses/courses/1');
	}
	
	public function edit_course($course_id)
	    {
		if(!empty($this->session->userdata('username')))
		{
			$data['courses'] =$this->courses_model->fetch_courses($course_id);
		   
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/edit_course',$data);
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	function update_course($courseid){
		    
		    $courses['course'] =$this->courses_model->fetch_courses($course_id);
		    	
		    $course_name=$_POST['course_name'];
		    $course_custom_heading=$_POST['course_custom_heading'];
		    $course_description=$_POST['course_description'];
		    $course_short_description=$_POST['course_short_description'];
		    $other_details=$_POST['other_details'];
		    $course_image_old=$_POST['course_image_old'];
		    $course_header_image_old=$_POST['course_header_image_old'];
		    $feature_1=$_POST['feature_1'];
    	    $feature_2=$_POST['feature_2'];
    	    $feature_3=$_POST['feature_3'];
    	    $feature_4=$_POST['feature_4'];
    	    $feature_5=$_POST['feature_5'];
    	    $video_url1 = $_POST['video_url1'];
    		$video_url2 = $_POST['video_url2'];
    		$video_url3 = $_POST['video_url3'];
    		$video_url4 = $_POST['video_url4'];
    		$video_url5 = $_POST['video_url5'];
            
    	    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !=''){
                       
                      $image = $this->file_upload_code('image');
                     
                      
            }
            else{
                    $image= $course_image_old;  
            }
            //  if(isset($_FILES['course_header_image']['name']) && $_FILES['course_header_image']['name'] !=''){
                       
            //           $course_header_image = $this->file_upload_code('course_header_image');
                      
            // }
            // else{
            //         $course_header_image= $course_header_image_old;  
            // }
		   
	        $data = array(
            	       'course_name' =>$course_name,
            	       'course_custom_heading' =>$course_custom_heading,
            	       'course_description'=> $course_description,
            	       'course_short_description'=> $course_short_description,
            	        'other_details'=> $other_details,
            	       'course_image'=>$image,
            	       'course_header_image'=>$course_header_image,
            	       'feature_1'=> $feature_1,
            	        'feature_2'=> $feature_2,
            	        'feature_3'=> $feature_3,
            	        'feature_4'=> $feature_4,
            	        'feature_5'=> $feature_5,
            	        'video_url1' => $video_url1,
            			'video_url2' => $video_url2,
            			'video_url3' => $video_url3,
                        'video_url4' => $video_url4,
                        'video_url5' => $video_url5
	                    );
	       	$this->courses_model->update_course($data,$courseid); 
		    redirect('courses/courses/1');
	}
	
	public function delete_course(){

			  $course_id = $this->input->post('course_id');
			$delete = $this->courses_model->delete_course($course_id);
	}

	
	// Techers
	
	public function teachers($page=1) 
	{ 
			$data['teachers']=$this->courses_model->fetch_teachers();
			//$courses['page']=$page;
			//$courses['max_page']=$this->courses_model->fetch_max_pages('courses');
           
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/teachers',$data);
			$this->load->view('general/footer');
			
	}
	
	public function new_teacher()
	{
	        $data['courses']=$this->courses_model->fetch_courses();
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/new_teacher',$data);
			$this->load->view('general/footer');	
		
	}
	
	public function add_new_teacher()
	{
	
	    $acc_type=2;
	    $teacher_username = $_POST['teacher_username'];
		$teacher_first_name=$_POST['teacher_first_name'];
		$teacher_last_name=$_POST['teacher_last_name'];
		$teacher_email=$_POST['teacher_email'];
		$teacher_contact=$_POST['teacher_contact'];
		$teacher_course_id=$_POST['course'];
    	$password=md5($_POST['password']);
    	
	    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !=''){
                   
                  $image = $this->file_upload_code('image');
        }
        else{
                   $image ='';
        }
        
	    $data = array(
	        'acc_type' => $acc_type,
	        'username' => $teacher_username,
	        'firstname' =>$teacher_first_name,
	        'lastname' =>$teacher_last_name,
	        'email' =>$teacher_email,
	        'contact' => $teacher_contact,
	        'teacher_course_id' => $teacher_course_id,
	        'password' => $password,
	        'image'=>$image
	        );
	   // echo "<pre>";
	   // print_r($data);
	   // exit;
		$this->courses_model->add_new_teacher($data);
		redirect('courses/teachers/1');
	}
	
	public function edit_teacher($teacher_id)
	{
		
			$data['teacher'] =$this->courses_model->fetch_teachers($teacher_id);
			$data['courses']=$this->courses_model->fetch_courses_only();
	       // echo "<pre>";
	       // print_r($data);
	       // exit;
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/edit_teacher',$data);
			$this->load->view('general/footer');	
	
	}
	
	
	function update_teacher($teacherid){
	    
		$teacher_first_name=$_POST['teacher_first_name'];
		$teacher_last_name=$_POST['teacher_last_name'];
		$teacher_contact=$_POST['teacher_contact'];
		$teacher_course_id=$_POST['course'];
    	
	    $data = array(
	        'firstname' =>$teacher_first_name,
	        'lastname' =>$teacher_last_name,
	        'contact' => $teacher_contact,
	        'teacher_course_id' => $teacher_course_id,
	        );
	       // echo "<pre>";
	       // print_r($data);
	       // exit;
	       	$this->courses_model->update_teacher($data,$teacherid); 
		    redirect('courses/teachers/1');
	}
	
	public function delete_teacher(){

			  echo $teacher_id = $this->input->post('teacher_id');
			  
			$delete = $this->courses_model->delete_teacher($teacher_id);
	}
	
	// trial Class
	public function trial_classes($page=1) 
	{ 
			$data['trial_classes']=$this->courses_model->fetch_trial_classes();
			
			//$courses['page']=$page;
			//$courses['max_page']=$this->courses_model->fetch_max_pages('courses');
           //echo "<pre>";
		   //print_r($data);
		   //exit;
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/trial_classes',$data);
			$this->load->view('general/footer');
			
	}
	

	public function add_new_trial_slot() 
	{ 
		
		$trial_dates = $_POST['trial_date'];
		$trial_course_id = $_POST['trail_course'];
		$no_of_students = $_POST['no_of_students'];
		
	   foreach($trial_dates as $key=>$trial_date){
	      $trial_date = date('Y-m-d', strtotime($trial_date));
	      $slot_time_data  = array(
	          'slotone_start' =>$_POST['slotone_start'][$key],
	          'slottwo_start' =>$_POST['slottwo_start'][$key],
	          'slotthree_start' =>$_POST['slotthree_start'][$key],
	          'slotfour_start' =>$_POST['slotfour_start'][$key],
	          'slotfive_start' =>$_POST['slotfive_start'][$key],
	          
	          'slotone_end' =>$_POST['slotone_end'][$key],
	          'slottwo_end' =>$_POST['slottwo_end'][$key],
	          'slotthree_end' =>$_POST['slotthree_end'][$key],
	          'slotfour_end' =>$_POST['slotfour_end'][$key],
	          'slotfive_end' =>$_POST['slotfive_end'][$key],
	          );
	      
	       $trial_time_slots = serialize($slot_time_data);
	       $data = array(
			  'course_id' => $trial_course_id,
			  'no_of_students' => $no_of_students,
			  'trial_date' => $trial_date,
              'trial_time_slots' => $trial_time_slots,
           
              );
         
           	$this->courses_model->add_new_trial_slot($data);
	       
	   }
	   
	echo "Added";
	
	
			
	}
	public function new_trial_class()
	{
		$courses['courses']=$this->courses_model->fetch_courses();
		$this->load->view('general/header');
		$this->load->view('general/sidebar');
		$this->load->view('courses/new_trial_class',$courses);
		$this->load->view('general/footer');
	}
		public function delete_trial_class(){

			  echo $trial_time_slot_id = $this->input->post('trial_class_id');
			  
			$delete = $this->courses_model->delete_trial_class($trial_time_slot_id);
	}
	
	// follow Class
	public function follow_classes($page=1) 
	{ 
			$data['follow_classes']=$this->courses_model->fetch_follow_classes();
			//$courses['page']=$page;
			//$courses['max_page']=$this->courses_model->fetch_max_pages('courses');
        //   echo "<pre>";
        //   print_r($data);
        //   exit;
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/follow_classes',$data);
			$this->load->view('general/footer');
			
	}
	

	public function add_new_follow_slot() 
	{ 
		$class_name = $_POST['class_name'];
		$follow_dates = $_POST['follow_date'];
		$follow_course_id = $_POST['follow_course'];
		$no_of_students = $_POST['no_of_students'];
		$class_description=$_POST['class_description'];
		$class_short_description = $_POST['class_short_description'];
		$feature_1=$_POST['feature_1'];
	    $feature_2=$_POST['feature_2'];
	    $feature_3=$_POST['feature_3'];
	    $feature_4=$_POST['feature_4'];
	    $feature_5=$_POST['feature_5'];
		if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !=''){
                       
                      $image = $this->file_upload_code('image');
                      
            }
            else{
                    $image= '';  
            }
           
		foreach($follow_dates as $key=>$follow_date){
	      $follow_date = date('Y-m-d', strtotime($follow_date));
	      $slot_time_data  = array(
	          'slotone_start' =>$_POST['slotone_start'][$key],
	          'slottwo_start' =>$_POST['slottwo_start'][$key],
	          'slotthree_start' =>$_POST['slotthree_start'][$key],
	          'slotfour_start' =>$_POST['slotfour_start'][$key],
	          'slotfive_start' =>$_POST['slotfive_start'][$key],
	          
	          'slotone_end' =>$_POST['slotone_end'][$key],
	          'slottwo_end' =>$_POST['slottwo_end'][$key],
	          'slotthree_end' =>$_POST['slotthree_end'][$key],
	          'slotfour_end' =>$_POST['slotfour_end'][$key],
	          'slotfive_end' =>$_POST['slotfive_end'][$key],
	          );
	      
	       $follow_time_slots = serialize($slot_time_data);
	       
	       $data = array(
	          'class_name' => $class_name,
			  'course_id' => $follow_course_id,
			  'no_of_students' => $no_of_students,
			  'follow_date' => $follow_date,
			  'follow_time_slots' => $follow_time_slots,
			  'class_description' => $class_description,
			  'class_short_description' => $class_short_description,
			  'class_feature_1'=> $feature_1,
    	      'class_feature_2'=> $feature_2,
    	      'class_feature_3'=> $feature_3,
    	      'class_feature_4'=> $feature_4,
    	      'class_feature_5'=> $feature_5,
              'image' => $image
              );
             
           	$this->courses_model->add_new_follow_slot($data);
		}
	     redirect('courses/follow_classes/1');
			
	}

	
	/* Follow Class */
	public function new_follow_class()
	{
		$courses['courses']=$this->courses_model->fetch_courses();
		$this->load->view('general/header');
		$this->load->view('general/sidebar');
		$this->load->view('courses/new_follow_class',$courses);
		$this->load->view('general/footer');
	}
		// Students record
	public function students($page=1) 
	{ 
			$data['students']=$this->courses_model->fetch_students();
			//$courses['page']=$page;
			//$courses['max_page']=$this->courses_model->fetch_max_pages('courses');
           
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/students',$data);
			$this->load->view('general/footer');
			
	}
	public function update_status(){
	    
	    $booking_id=$_POST['booking_id'];
	    $status=$_POST['status'];
	    $data = array(
            	   'status' =>$status,
	       ); 
	       
	    $this->courses_model->update_status($data,$booking_id);
	    
	}
		public function delete_follow_class(){

			  echo $follow_time_slot_id = $this->input->post('follow_time_slot_id');
			  
			$delete = $this->courses_model->delete_follow_class($follow_time_slot_id);
	}
	// Student Booking trial Class record
	public function student_booking_trial($page=1) 
	{ 
			$data['student_booking_trial']=$this->courses_model->fetch_student_booking_trial();
			//$courses['page']=$page;
			//$courses['max_page']=$this->courses_model->fetch_max_pages('courses');
          
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/student_booking_trial',$data);
			$this->load->view('general/footer');
			
	}
	
	public function edit_student_booking_trial($teacher_id)
	{
		
			$student_booking_trial =$this->courses_model->fetch_student_booking_trial($teacher_id);
		    
		 
		    $data = array(
	        'student_name' => $student_booking_trial[0]->student_name,
	        'student_email' => $student_booking_trial[0]->student_email,
	        'student_phone' => $student_booking_trial[0]->student_phone,
	        'course_name' => $student_booking_trial[0]->course_name,
	        'trial_date' => $student_booking_trial[0]->trial_date,
	        'time_slot' => $student_booking_trial[0]->time_slot
	        );
	        
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/edit_student_booking_trial',$data);
			$this->load->view('general/footer');	
	
	}
	// Student Booking Follow Class record
	public function student_booking_follow($page=1) 
	{ 
			$data['student_booking_follow']=$this->courses_model->fetch_student_booking_follow();
			//$courses['page']=$page;
			//$courses['max_page']=$this->courses_model->fetch_max_pages('courses');
           
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('courses/student_booking_follow',$data);
			$this->load->view('general/footer');
			
	}
	
	// upload file/image
	public function file_upload_code($name_value=''){
                
                if(isset($name_value) && $name_value !=''){
                        //echo "   Passing value: ".$name_value;
                         $config['upload_path'] = './uploaded_files/';
                         $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc|pptx';
                         $config['max_size'] = 400000;
                         $config['max_width'] = 5000;
                         $config['max_height'] = 5000;
                         
                         $new_name = uniqid().'_'.$_FILES[$name_value]['name'];
                         
                         $new_name = preg_replace('/\s+/', '_', $new_name);
                         $config['file_name'] = $new_name;
        
                         $this->load->library('upload', $config);
                         
                         if (!$this->upload->do_upload($name_value, $new_name)) {
                    
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error_msg', $error['error']);
                        
                        } 
                        else{
                            return $new_name;
                        }
                        
                            
                        }
        }
	
}