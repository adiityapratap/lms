<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class General_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
	}
	
	public function update_pass($new_pass=''){
	     
	    $newpassword = md5($new_pass);
	    
		 $data_user =  array(
		     'password'=>$newpassword
		     );
	    $this->db->where('user_id',1);
		 return $this->db->update('tbl_user',$data_user);
	}
	public function validateLogin($username,$password,$acc_type)
	{
		$query=$this->db->query("SELECT * FROM tbl_user WHERE username = '" . $username . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . htmlspecialchars($password, ENT_QUOTES) . "'))))) OR password = '" .md5($password). "') AND acc_type = '". $acc_type ."'");
		$res=$query->result();
		return $res;
	}
		public function fetch_dash_data()
	{
		$query=$this->db->query("SELECT count(*) as total_courses FROM courses");
		$res['total_courses']=$query->result()[0]->total_courses;
		$query=$this->db->query("SELECT count(*) as total_teachers FROM tbl_user WHERE acc_type = '2'");
		$res['total_teachers']=$query->result()[0]->total_teachers;
		$query=$this->db->query("SELECT count(*) as total_students FROM students");
		$res['total_students']=$query->result()[0]->total_students;
// 		echo "SELECT count(*) as total_trial_classes FROM trial_class_time_slots WHERE trial_date BETWEEN '".date("Y-m-d",strtotime('now'))."' AND '".date("Y-m-d",strtotime('last day of this month'))."'";
		$query=$this->db->query("SELECT count(*) as total_trial_classes FROM trial_class_time_slots WHERE trial_date BETWEEN '".date("Y-m-d",strtotime('now'))."' AND '".date("Y-m-d",strtotime('last day of this month'))."'");
// 		exit;
		$res['total_trial_classes']=$query->result()[0]->total_trial_classes;
		
		$query=$this->db->query("SELECT sum(order_total) as total_trial_classes FROM orders WHERE delivery_date_time BETWEEN '".date("Y-m-d",strtotime('first day of this month'))." 00:00:01' AND '".date("Y-m-d",strtotime('last day of this month'))." 23:59:59'");

		return $res;
	}


}
