<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses_model extends CI_Model{
public function fetch_courses($course_id='')
	{
	    $this->db->select('*');
		$this->db->from('courses');
		if($course_id !=''){
		  
	       $this->db->where('course_id',$course_id);
	    }
	    //$this->db->join('tbl_user','courses.course_id = tbl_user.teacher_course_id','left');
		 
		$query = $this->db->get();
	//echo $qry=$this->db->last_query();
	//	 exit;
		return $query->result();
	}
	public function fetch_courses_only($course_id='')
	{
	    $this->db->select('*');
		$this->db->from('courses');
		if($course_id !=''){
		  
	       $this->db->where('course_id',$course_id);
	    }
	    
		$query = $this->db->get();
	
		return $query->result();
	}
		public function fetch_max_pages($table)
	{
		if($table=='course')
			$query=$this->db->query("SELECT * FROM courses WHERE course_name NOT LIKE '*%' AND course_name NOT LIKE ''");
		   return ceil($query->num_rows()/20);
	}
	
		public function add_new_course($data){
		    
		    $this->db->insert('courses',$data);
		    return true;
		}
	
	function update_course($data_course,$courseid){
	  
		 $this->db->where('course_id',$courseid);
		 return $this->db->update('courses',$data_course);
	}
	public function delete_course($course_id){
	    
	   	 $this->db->where('course_id',$course_id);
		 return $this->db->delete('courses');
	}
	
	
	
	//Teacher
	
	
	public function fetch_teachers($teacher_id='')
	{
	    
	    echo "db".$teacher_id;
	    $this->db->select('*');
		$this->db->from('tbl_user');
		if($teacher_id !=''){
		  $array = array('user_id' => $teacher_id, 'acc_type' => '2');
	       $this->db->where($array);
	    }
	    else{
	    $this->db->where('acc_type','2');
	    }
	    $this->db->join('courses','tbl_user.teacher_course_id = courses.course_id');
		$query = $this->db->get();
// 	echo "<pre>";
// 	        print_r($query);
// 	        exit;
		return $query->result();
	}
	
	public function add_new_teacher($data){
		    
		    $this->db->insert('tbl_user',$data);
		    return true;
	}
	

	
	function update_teacher($data_teacher,$teacherid){ 
	  
		 $this->db->where('user_id',$teacherid);
		 return $this->db->update('tbl_user',$data_teacher);
	}
	public function delete_teacher($teacher_id){
	    
	   	 $this->db->where('user_id',$teacher_id);
		 return $this->db->delete('tbl_user');
	}
	
	//trial classes
		public function add_new_trial_slot($data){
		    
		    $this->db->insert('trial_class_time_slots',$data);
		    return true;
	}
	public function fetch_trial_classes($trial_time_slot_id='')
	{
	    $this->db->select('*');
		$this->db->from('trial_class_time_slots as tc');
		
		if($trial_time_slot_id !=''){
		  
			$this->db->where('tc.trial_time_slot_id',$trial_time_slot_id);
	    }
		if($this->session->userdata('useracc') == '2'){
			$course_id=$this->session->userdata('usercourse');
			$this->db->where('tc.course_id',$course_id);
		}
		
	    $this->db->join('courses as c','tc.course_id = c.course_id');
		
		$query = $this->db->get();
		// echo $qry=$this->db->last_query();
		// exit;
		return $query->result();
	}
		public function delete_trial_class($trial_time_slot_id){
	    
	   	 $this->db->where('trial_time_slot_id',$trial_time_slot_id);
		 return $this->db->delete('trial_class_time_slots');
	}
	
	//follow classes
		public function add_new_follow_slot($data){
		    
		    $this->db->insert('follow_class_time_slots',$data);
		    return true;
	}
	public function fetch_follow_classes($follow_time_slot_id='')
	{
	    
	    $this->db->select('*');
		$this->db->from('follow_class_time_slots as fc');
		
		if($follow_time_slot_id !=''){
		  
	       $this->db->where('fc.follow_time_slot_id',$follow_time_slot_id);
	    }
		if($this->session->userdata('useracc') == '2'){
			$course_id=$this->session->userdata('usercourse');
			$this->db->where('fc.course_id',$course_id);
		}
	    $this->db->join('courses as c','fc.course_id = c.course_id');
		$query = $this->db->get();
	
		return $query->result();
	}
		public function delete_follow_class($follow_time_slot_id){
	    
	   	 $this->db->where('follow_time_slot_id',$follow_time_slot_id);
		 return $this->db->delete('follow_class_time_slots');
	}
	
	// Student Booking follow Class record
	public function fetch_students($student_id='')
	{
	    $this->db->select('*');
		$this->db->from('students');
		
		if($student_id !=''){
		  
	       $this->db->where('student_id',$student_id);
	    }
	    $query = $this->db->get();
	
		return $query->result();
	}
	public function update_status($data,$booking_id=''){
	    
	    $this->db->where('booking_id',$booking_id);
		 return $this->db->update('booking_trial_class',$data); 
	}
		// Student Booking trial Class record
	public function fetch_student_booking_trial($booking_id='')
	{
	    $this->db->select('*');
		$this->db->from('booking_trial_class as bt');
		
		if($booking_id !=''){
		  
	       $this->db->where('bt.booking_id',$booking_id);
	    }
		if($this->session->userdata('useracc') == '2'){
			$course_id=$this->session->userdata('usercourse');
			$this->db->where('bt.course_id',$course_id);
		}
		
		
	    $this->db->join('courses as c','bt.course_id = c.course_id');
	    $this->db->join('trial_class_time_slots as tc','bt.time_slot_id = tc.trial_time_slot_id');
	    $this->db->join('students as s','bt.student_id = s.student_id');
		$query = $this->db->get();
	
		return $query->result();
	}
	
		// Student Booking follow Class record
	public function fetch_student_booking_follow($booking_id='')
	{
	    $this->db->select('*');
		$this->db->from('booking_follow_class as bf');
		
		if($booking_id !=''){
		  
	       $this->db->where('bf.booking_id',$booking_id);
	    }
		if($this->session->userdata('useracc') == '2'){
			$course_id=$this->session->userdata('usercourse');
			$this->db->where('bf.course_id',$course_id);
		}
	    $this->db->join('courses as c','bf.course_id = c.course_id');
	    $this->db->join('follow_class_time_slots as tc','bf.time_slot_id = tc.follow_time_slot_id');
	    $this->db->join('students as s','bf.student_id = s.student_id');
		$query = $this->db->get();
	
		return $query->result();
	}
	
}