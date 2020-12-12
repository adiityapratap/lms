<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customers_model extends CI_Model{
    
    public function fetch_customers($customer_id='')
	{
	    $this->db->select('*');
		$this->db->from('customer');
		if($customer_id !=''){
		  
	       $this->db->where('customer_id',$customer_id);
	    }
		$query = $this->db->get();
	
		return $query->result();
	}
	
	public function fetch_max_pages($table)
	{
		if($table=='customer')
			$query=$this->db->query("SELECT * FROM customer");
		   return ceil($query->num_rows()/20);
	}
	
	public function delete_customer($customer_id)
	{
	   	 $this->db->where('customer_id',$customer_id);
		 return $this->db->delete('customer');
	}
    
    function update_customer($data_customer,$customer_id)
    {
		 $this->db->where('customer_id',$customer_id);
		 return $this->db->update('customer',$data_customer);
	}
	public function add_customer($data){
		    
		    $this->db->insert('customer',$data);
		    return true;
	}
}
    
    
?>