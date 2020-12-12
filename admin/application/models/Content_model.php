<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Content_model extends CI_Model{
    
    public function fetch_video_url($name='')
	{
	    $this->db->select('*');
		$this->db->from('video_content');
		if($name !=''){
		  
	       $this->db->where('name',$name);
	    }
	    
		$query = $this->db->get();
	
		return $query->result();
	}
    function update_video_content($data,$name){
	  
		 $this->db->where('name',$name);
		 return $this->db->update('video_content',$data);
	}
	
	/**/
	
	public function fetch_testimonials()
	{
	    $this->db->select('*');
		$this->db->from('testimonials');
		
		$query = $this->db->get();
	
		return $query->result();
	}
    function add_testimonials($data){
	  
		 $this->db->insert('testimonials',$data);
		 return true;
	}
	public function delete_testimonial($testimonial_id){
	    
	   	 $this->db->where('testimonial_id',$testimonial_id);
		 return $this->db->delete('testimonials');
	}
	
}