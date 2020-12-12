<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Orders_model extends CI_Model{
	
	function __construct() {
		parent::__construct();
	}
	
		public function delete_order($order_id)
	{
	    
	     $date_modified = date("Y-m-d H:i:s",strtotime("now"));
	     
	 
	   $this->db->query("UPDATE orders SET order_status= 0 ,  date_modified = '".$date_modified."' WHERE order_id=".$order_id);
	    
		
	}
	
	
	public function myob($order_id)
	{
	    
	     $date_added = date("Y-m-d H:i:s",strtotime("now"));
	     
	   
	     
	   $this->db->query("UPDATE orders SET otype='Maroondah' ,order_status= 99 ,marrondah_order = 1 WHERE order_id=".$order_id);
	    
	   
		
	}
	
		public function group_mark_as_paid($orders,$referrer='')
	{
	    
	     $date_added = date("Y-m-d H:i:s",strtotime("now"));
	     
	   
	   foreach($orders as $order){
	      
      $tmp = explode('_', $order);

     $ofrom = $tmp[0];
     $order_id = $tmp[1];
     
	 
	     
	     
	   	 $this->db->query("UPDATE orders SET order_status= 3 , mark_paid_comment = '".$referrer."', date_modified = '".$date_added."' WHERE order_id=".$order_id);

	    
	   }
	  
		
	}
	
	public function mark_paid($order_id,$referrer='')
	{
	      $date_added = date("Y-m-d H:i:s",strtotime("now"));
	     
	       $this->db->query("UPDATE orders SET order_status= 1 , mark_paid_comment = '".$referrer."', date_modified = '".$date_added."' WHERE order_id=".$order_id);
	    
	}
	
	
	public function fetch_order_history($params,$myob='',$order_date='')
	{
	  
	    
	  
	    
		if(empty($params))
		{
		    
		    if(isset($myob) && $myob =='myob'){
		        
		   $query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id join company co ON c.company_id=co.company_id WHERE  o.order_status != 0 and o.marrondah_order = 1   ORDER BY o.order_id desc");

		    }else{ 
		  
		$query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id join company co ON c.company_id=co.company_id WHERE o.order_status != 0 and o.marrondah_order = 0 and  delivery_date_time>='".date("Y-m-d",strtotime("now"))." 00:00:01"."' ORDER BY o.order_id desc");
       
		        
		    }
			return $query->result();
		}
		else{
		    
// 		    	if(empty($params['date_from']) && empty($params['date_to'])){    
		    
// 		    if($myob == '' && $order_date == 'future_order')
//     {
//         $sqll = 'o.delivery_date_time >= CURDATE()';
        
//     }
    
// 		}
		
	
		  //  	print($params['customer']); exit;
		    
		    
			if(!empty($params['sort_order'])){
				if($params['sort_order']==0){
					$order_by='delivery_date_time asc';
				}
				else if($params['sort_order']==1){
					$order_by='delivery_date_time desc';
				}
				else if($params['sort_order']==2){
					$order_by='order_id asc';
				}
				else $order_by='order_id desc';
			}
			else $order_by='delivery_date_time asc';
			if(!empty($params['date_to']) &&  !empty($params['date_from']) && $params['date_from'] == $params['date_to']){
			   
			    $fromWhere="delivery_date_time LIKE '%".date("Y-m-d",strtotime($params['date_from']))."%'";
			    $toWhere="1";
			    
			}else{
			if(!empty($params['date_from']))
				$fromWhere="delivery_date_time >='".date("Y-m-d",strtotime($params['date_from']))." 00:00:01'";
			else if($myob == 'myy')
			$fromWhere=1;
			else
			$fromWhere = 1;
			
			if(!empty($params['date_to']))
				$toWhere="delivery_date_time<='".date("Y-m-d",strtotime($params['date_to']))." 23:59:59'";
			else $toWhere="1";
			}
			if(isset($params['company']))
				$companyWhere="c.company_id=".$params['company'];
			else $companyWhere="1";
			if(isset($params['fname']) && isset($params['lname']) && $params['fname'] !='' && $params['lname'] != '')
			 if($params['fname'] !='unset' && $params['lname'] != 'unset')
				$cWhere="c.firstname='".$params['fname']."' and c.lastname= '".$params['lname']."'";
				else
					$cWhere="1";
			else if(isset($params['fname']) && ($params['fname'] !='' || $params['fname'] !='unset'))
			$cWhere="c.firstname='".$params['fname']."'";
			else
			$cWhere="1";
			if(isset($params['order_no']) && $params['order_no'] !='unset')
				$orderidwhere="o.order_id=".$params['order_no'];
			else $orderidwhere="1";
		
		
			 if(isset($myob) && $myob =='myob'){
			     
	
// 		echo "SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id join company co ON c.company_id=co.company_id WHERE  o.order_status != 0 and o.marrondah_order = 1 and ".$fromWhere." AND ".$toWhere." AND ".$companyWhere." AND ".$cWhere." ORDER BY ".$order_by;
// 		exit;
			$query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id join company co ON c.company_id=co.company_id WHERE  o.order_status != 0 and o.marrondah_order = 1 and ".$fromWhere." AND ".$toWhere." AND ".$companyWhere." AND ".$cWhere." ORDER BY ".$order_by);
			
			 } if(isset($orderidwhere) && $orderidwhere != 1){
			   
			   
		 $query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id left join company co ON c.company_id=co.company_id WHERE ".$companyWhere." AND ".$cWhere." AND ".$orderidwhere. " AND o.order_status != 0  and o.order_status != 99  ORDER BY ".$order_by);

			        
			    }else{
			  
			 // echo "SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id join company co ON c.company_id=co.company_id WHERE o.order_status != 0 and o.marrondah_order = 0 and ".$fromWhere." AND ".$toWhere." AND ".$companyWhere." AND ".$cWhere." ORDER BY ".$order_by; exit;    
				$query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id join company co ON c.company_id=co.company_id WHERE o.order_status != 0 and  o.order_status != 99 and ".$fromWhere." AND ".$toWhere." AND ".$companyWhere." AND ".$cWhere." ORDER BY ".$order_by);
		     
			     
			 }
			return $query->result();
		}
	}
	public function fetch_past_orders($params)
	{
		if(empty($params))
		{
			$query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id join company co ON c.company_id=co.company_id WHERE o.order_status != 0 and o.marrondah_order = 0  and delivery_date_time<'".date("Y-m-d",strtotime("now"))." 00:00:01"."' ORDER BY delivery_date_time desc");
			return $query->result();
		}
		else{
			if(!empty($params['sort_order'])){
				if($params['sort_order']==0){
					$order_by='delivery_date_time desc';
				}
				else if($params['sort_order']==1){
					$order_by='delivery_date_time asc';
				}
				else if($params['sort_order']==2){
					$order_by='order_id asc';
				}
				else $order_by='order_id desc';
			}
			else{
				$order_by='delivery_date_time asc';
			}
			if(!empty($params['date_from']))
				$fromWhere="delivery_date_time >='".date("Y-m-d",strtotime($params['date_from']))." 00:00:01'";
			else $fromWhere="1=1";
			if(!empty($params['date_to']))
				$toWhere="delivery_date_time <='".date("Y-m-d",strtotime($params['date_to']))." 23:59:59'";
			else $toWhere="1=1";
			if(isset($params['company']))
				$companyWhere="c.company_id=".$params['company'];
			else $companyWhere="1=1";
			if(isset($params['customer']))
				$cWhere="c.customer_id='".$params['customer']."'";
			else 
			if(isset($params['order_no']) && $params['order_no'] !='')
				$orderidwhere="o.order_id='".$params['order_no']."'";
			else $cWhere="1=1";
			
			$query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id join company co ON c.company_id=co.company_id WHERE o.order_status != 0 and  o.order_status != 99 and ".$fromWhere." AND ".$toWhere." AND ".$companyWhere." AND ".$cWhere." ".$orderidwhere." ORDER BY ".$order_by);
			return $query->result();
		}
	}
	public function fetch_order_info($order_id)
	{
		$query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v on o.coupon_id=v.coupon_id LEFT JOIN company co ON co.company_id=c.company_id LEFT JOIN department d ON d.department_id=c.department_id WHERE o.order_id=".$order_id);
		return $query->result();
	}
	public function fetch_user_info($user_id)
	{
	   $query=$this->db->query("SELECT * FROM tbl_user WHERE user_id=".$user_id);
		
		return $query->result();
		
	}
	public function fetch_order_products($order_id)
	{
		$query=$this->db->query("SELECT * FROM order_product op join product p on op.product_id=p.product_id where order_id=".$order_id." order by op.sort_order asc ");
		return $query->result();
	}
	public function fetch_order_product_options($order_id)
	{
		$query=$this->db->query("SELECT * FROM order_product op join order_product_option opo on op.order_product_id=opo.order_product_id join product_option po on po.product_option_id=opo.product_option_id join option_value ov on ov.option_value_id=po.option_value_id where op.order_id=".$order_id);
		return $query->result();
	}
	public function fetch_standing_order_history($params)
	{
		if(empty($params))
		{
			$query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id join company co ON c.company_id=co.company_id WHERE o.order_status != 0 and standing_order=1 ORDER BY order_id desc");
			return $query->result();
		}
		else{
			if(!empty($params['sort_order'])){
				if($params['sort_order']==0){
					$order_by='delivery_date_time desc';
				}
				else if($params['sort_order']==1){
					$order_by='delivery_date_time asc';
				}
				else if($params['sort_order']==2){
					$order_by='order_id asc';
				}
				else $order_by='order_id desc';
			}
			else{
				$order_by='delivery_date_time asc';
			}
			if(!empty($params['date_from']))
				$fromWhere="delivery_date_time>='".date("Y-m-d",strtotime($params['date_from']))." 00:00:01'";
			else $fromWhere="1";
			if(!empty($params['date_to']))
				$toWhere="delivery_date_time<='".date("Y-m-d",strtotime($params['date_to']))." 23:59:59'";
			else $toWhere="1";
			if(isset($params['company']))
				$companyWhere="c.company_id=".$params['company'];
			else $companyWhere="1";
			if(isset($params['customer']))
				$cWhere="c.customer_id=".$params['customer'];
			else $cWhere="1=1";
			$query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id LEFT JOIN coupon v ON o.coupon_id=v.coupon_id WHERE o.order_status != 0 and ".$fromWhere." AND ".$toWhere." AND ".$companyWhere." AND ".$cWhere." AND standing_order=1 ORDER BY ".$order_by);
			return $query->result();
		}
	}
	public function fetch_active_coupons()
	{
		$query=$this->db->query("SELECT * FROM coupon WHERE status=1");
		return $query->result();
	}
	public function fetch_archived_coupons()
	{
		$query=$this->db->query("SELECT * FROM coupon WHERE status=0");
		return $query->result();
	}
	public function archive_coupon($coupon_id)
	{
		$query=$this->db->query("UPDATE coupon SET status=0 WHERE coupon_id=".$coupon_id);
	}
	public function activate_coupon($coupon_id)
	{
		$query=$this->db->query("UPDATE coupon SET status=1 WHERE coupon_id=".$coupon_id);		
	}
	public function new_order($data)
	{
		$delivery_notes=empty($data['delivery_notes'])||$data['delivery_notes']=='null'?'null':$this->db->escape($data['delivery_notes']);
		$cost_centre=empty($data['cost_centre'])||$data['cost_centre']=='null'?'null':$this->db->escape($data['cost_centre']);
		$order_comments=empty($data['order_comments'])||$data['order_comments']=='null'?'null':$this->db->escape($data['order_comments']);
		$delivery_fee=empty($data['delivery_fee'])||$data['delivery_fee']=='null'?0:$data['delivery_fee'];
		$delivery_phone=empty($data['phone'])||$data['phone']=='null'?'null':$this->db->escape($data['phone']);
		$delivery_address=empty($data['delivery_address'])||$data['delivery_address']=='null'?'null':$this->db->escape($data['delivery_address']);
		$delivery_email=empty($data['email'])||$data['email']=='null'?'null':$this->db->escape($data['email']);
		
		if(empty($data['coupon'])||$data['coupon']=='null')
			$coupon_id='null';
		else
		{
			$code=$this->db->escape($data['coupon']);
			$query=$this->db->query("SELECT * FROM coupon WHERE coupon_code=".$code);
			if(empty($query->result()))
				$coupon_id='null';
			else $coupon_id=$query->result()[0]->coupon_id;
		}
		
		
		
		$query=$this->db->query("SELECT * FROM company co left join customer cu on cu.company_id = co.company_id left join department d on d.department_id =cu.department_id WHERE cu.customer_id=".$data['customer']);
			if(!empty($query->result()))
			{
		
			 
			 	$comp_name =empty($query->result()[0]->company_name)||$query->result()[0]->company_name =='null'?'null':$this->db->escape($query->result()[0]->company_name);
			 	
			 	$department_name=empty($query->result()[0]->department_name)||$query->result()[0]->department_name =='null'?'null':$this->db->escape($query->result()[0]->department_name);
			 		
			 	$comp_addr =empty($query->result()[0]->company_address)||$query->result()[0]->company_address =='null'?'null':$this->db->escape($query->result()[0]->company_address );
			 

			}else{
			    $comp_name = 'null';
			      $comp_addr = 'null';
			        $department_name = 'null';
			    
			}
		
		
		
		
		
		
		if($data['shipping_method']==1)
		{
			//Insert 0 for total before calculating in backend
			$this->db->query("INSERT INTO orders (customer_id,customer_company_name,customer_company_addr,	customer_department_name,shipping_method,pickup_delivery_notes,order_total,order_status,date_added,date_modified,delivery_date_time,standing_order,marrondah_order,cost_centre,order_comments,coupon_id,delivery_fee,delivery_phone,delivery_address,delivery_email) VALUES (".$data['customer'].",".$comp_name .",".$comp_addr .",".$department_name .",".$data['shipping_method'].",".$delivery_notes.",".(0).",15,'".date("Y-m-d H:i:s",strtotime("now"))."','".date("Y-m-d H:i:s",strtotime("now"))."','".date("Y-m-d H:i",strtotime($data['delivery_date_time']))."',".$data['standing_order'].",".$data['marrondah_order'].",".$cost_centre.",".$order_comments.",".$coupon_id.",".$delivery_fee.",".$delivery_phone.",".$delivery_address.",".$delivery_email.")");
		}
		else
		{
			$this->db->query("INSERT INTO orders (customer_id,customer_company_name,customer_company_addr,	customer_department_name,shipping_method,pickup_delivery_notes,order_total,order_status,date_added,date_modified,delivery_date_time,standing_order,marrondah_order,cost_centre,order_comments,coupon_id,delivery_fee,delivery_phone,delivery_email,selected_location) VALUES (".$data['customer'].",".$comp_name .",".$comp_addr .",".$department_name .",".$data['shipping_method'].",".$delivery_notes.",".(0).",15,'".date("Y-m-d H:i:s",strtotime("now"))."','".date("Y-m-d H:i:s",strtotime("now"))."','".date("Y-m-d H:i",strtotime($data['delivery_date_time']))."',".$data['standing_order'].",".$data['marrondah_order'].",".$cost_centre.",".$order_comments.",".$coupon_id.",".$delivery_fee.",".$delivery_phone.",".$delivery_email.",".$data['pickup_location'].")");
		}
		$order_id=$this->db->insert_id();
		//Process products
		$total=0;
		if(!empty($data['products']))
		{
			foreach($data['products'] as $product=>$qty)
			{
				$query=$this->db->query("SELECT product_price from product where product_id=".$product);
				$res=$query->result();
				$res=$res[0]->product_price;
				
				if(isset($data['order_product_comment'][$product]) && !empty($data['order_product_comment'][$product])){
				    $ordr_prd_comnt = $data['order_product_comment'][$product];
			  
				$this->db->query("INSERT INTO order_product(order_id,order_product_comment,product_id,quantity,price,total) VALUES (".$order_id.",'".$ordr_prd_comnt."',".$product.",".$qty.",".$res.",".($qty*$res).")");  
				
				}else{
				    
				$this->db->query("INSERT INTO order_product(order_id,product_id,quantity,price,total) VALUES (".$order_id.",".$product.",".$qty.",".$res.",".($qty*$res).")");
				
				}
				
				
				
				$total+=($qty*$res);			
			}
		}
		if(!empty($data['option']))
		{
			//Options present, process those too
			foreach($data['option'] as $prod_opt=>$opt_qty)
			{
				$query=$this->db->query("SELECT * FROM product_option po JOIN option_value ov ON ov.option_value_id=po.option_value_id WHERE po.product_option_id=".$prod_opt);
				$res=$query->result();
				
				//Find the product, update base price * opt_qty
				$q2=$this->db->query("SELECT * FROM product WHERE product_id=".$res[0]->product_id);
				$r2=$q2->result();
				
				//Check if order_product has entry for this product with this order number
				$q2=$this->db->query("SELECT * FROM order_product WHERE order_id=".$order_id." AND product_id=".$res[0]->product_id);
				$r_ord_prod=$q2->result();
				
				$order_product_id=$r_ord_prod[0]->order_product_id;
				$this->db->query("INSERT INTO order_product_option (order_product_id,product_option_id,option_quantity,option_price,option_total) VALUES (".$order_product_id.",".$res[0]->product_option_id.",".$opt_qty.",".(float)($res[0]->option_price_prefix.$res[0]->option_price).",".($opt_qty*(float)($res[0]->option_price_prefix.$res[0]->option_price)).")");
				$total+=($opt_qty*(float)($res[0]->option_price_prefix.$res[0]->option_price));
				
			}
		}
		$this->db->query("UPDATE orders SET order_total=".$total." WHERE order_id=".$order_id);
		return $order_id;
	}
	public function add_product_to_order($order_id,$prod,$qty)
	{
		$query=$this->db->query("SELECT product_price from product where product_id=".$prod);
		$res=$query->result();
		$res=$res[0]->product_price;
		$this->db->query("INSERT INTO order_product(order_id,product_id,quantity,price,total) VALUES (".$order_id.",".$prod.",".$qty.",".$res.",".($qty*$res).")");
	}
	public function add_option_to_order($order_id,$option,$qty)
	{
		$query=$this->db->query("SELECT * FROM product_option po JOIN option_value ov ON ov.option_value_id=po.option_value_id WHERE po.product_option_id=".$option);
		$res=$query->result();
		//Find the product, update base price * opt_qty
		$q2=$this->db->query("SELECT * FROM product WHERE product_id=".$res[0]->product_id);
		$r2=$q2->result();
		//Check if order_product has entry for this product with this order number
		$q2=$this->db->query("SELECT * FROM order_product WHERE order_id=".$order_id." AND product_id=".$res[0]->product_id);
		$r_ord_prod=$q2->result();
		$order_product_id=$r_ord_prod[0]->order_product_id;
		$this->db->query("INSERT INTO order_product_option (order_product_id,product_option_id,option_quantity,option_price,option_total) VALUES (".$order_product_id.",".$res[0]->product_option_id.",".$qty.",".(float)($res[0]->option_price_prefix.$res[0]->option_price).",".($qty*(float)($res[0]->option_price_prefix.$res[0]->option_price)).")");
	}
	public function fetch_all_op_details($order_id)
	{
		$query=$this->db->query("SELECT * FROM order_product op join product p on op.product_id=p.product_id where order_id=".$order_id." ORDER BY sort_order asc");
		$res=$query->result();
		foreach($res as $product){
			$query=$this->db->query("SELECT * FROM order_product op join order_product_option opo on op.order_product_id=opo.order_product_id join product_option po on po.product_option_id=opo.product_option_id join option_value ov on ov.option_value_id=po.option_value_id where op.order_product_id=".$product->order_product_id);
			$product->options=$query->result();
		}
		return $res;
	}
	public function delete_option_from_order($option){
		//Before delete, fetch details and update total
		$query=$this->db->query("SELECT * FROM order_product_option opo join order_product op ON op.order_product_id=opo.order_product_id join product_option po on po.product_option_id=opo.product_option_id where order_product_option_id=".$option);
		$res=$query->result();
		$total_update=$res[0]->option_total;
		//If option_required==1, also update order_product
		if($res[0]->option_required==1){
			$this->db->query("UPDATE order_product SET quantity=quantity-".$res[0]->option_quantity.", total=total-".$res[0]->price*$res[0]->option_quantity);
		}
		$this->db->query("DELETE FROM order_product_option WHERE order_product_option_id=".$option);
	}
	public function delete_product_from_order($product){
		$query=$this->db->query("SELECT * FROM order_product op left join order_product_option opo on op.order_product_id=opo.order_product_id where op.order_product_id=".$product);
		$res=$query->result();
		if(empty($res->order_product_option_id)){
			//No options, update total and delete
			$this->db->query("DELETE FROM order_product WHERE order_product_id=".$product);
		}
	}
	public function update_product_comment($product,$comment)
	{
	    
		$this->db->query("UPDATE order_product SET order_product_comment='".$comment."' WHERE order_product_id=".$product);
	}
		public function add_productcomment_to_order($order_id,$prod,$cmnt)
	{
	
		$this->db->query("INSERT INTO order_product(order_id,product_id,order_product_comment) VALUES (".$order_id.",".$prod.",'".$cmnt."')");
	}
	public function update_product_quantities($product,$qty)
	{
		$this->db->query("UPDATE order_product SET quantity=".$qty.",total=price*".$qty." WHERE order_product_id=".$product);
	}
	public function update_option_quantities($option,$qty)
	{
		$this->db->query("UPDATE order_product_option SET option_quantity=".$qty.", option_total=option_price*".$qty." WHERE order_product_option_id=".$option);
	}
	public function update_order_details($comp_id,$company_name,$department_name,$cust_id,$order_id,$coupon_code,$delivery_date_time,$delivery_notes,$order_comments,$cost_centre,$delivery_fee,$standing_order,$marrondah_order,$cust_firstname,$cust_email,$cust_telephone,$delivery_addr,$comp_addr)
	{
	    	
	    
	    $cust_firstname=empty($cust_firstname)||$cust_firstname=='null'?'null':$this->db->escape($cust_firstname);
	    
	    $cust_email=empty($cust_email)||$cust_email=='null'?'null':$this->db->escape($cust_email);
	    
	    $cust_telephone=empty($cust_telephone)||$cust_telephone=='null'?'null':$this->db->escape($cust_telephone);
	    
	    $delivery_addr=empty($delivery_addr)||$delivery_addr=='null'?'null':$this->db->escape($delivery_addr);
	    
	    $company_name=empty($company_name)||$company_name=='null'?'null':$this->db->escape($company_name);
	    
	    $department_name =empty($department_name)||$department_name=='null'?'null':$this->db->escape($department_name);
	    
	    $comp_addr=empty($comp_addr)||$comp_addr=='null'?'null':$this->db->escape($comp_addr);
	    
	   
	 	$this->db->query("UPDATE customer SET customer_email = ".$cust_email.", firstname=".$cust_firstname.", customer_telephone=".$cust_telephone." WHERE customer_id=".$cust_id);

		$delivery_notes=empty($delivery_notes)||$delivery_notes=='null'?'null':$this->db->escape($delivery_notes);
		$cost_centre=empty($cost_centre)||$cost_centre=='null'?'null':$this->db->escape($cost_centre);
		$order_comments=empty($order_comments)||$order_comments=='null'?'null':$this->db->escape($order_comments);
		$delivery_fee=empty($delivery_fee)||$delivery_fee=='null'?0:$delivery_fee;
		if(empty($coupon_code)||$coupon_code=='null')
			$coupon_id='null';
		else
		{
			$code=$this->db->escape($coupon_code);
			$query=$this->db->query("SELECT * FROM coupon WHERE coupon_code=".$code);
			if(empty($query->result()))
				$coupon_id='null';
			else $coupon_id=$query->result()[0]->coupon_id;
		}
		$delivery_date_time=date("Y-m-d H:i",strtotime($delivery_date_time));
		
		$this->db->query("UPDATE orders SET customer_company_name = ".$company_name.", customer_company_addr= ".$comp_addr." , customer_department_name = ".$department_name." , delivery_address=".$delivery_addr.",coupon_id=".$coupon_id.",delivery_date_time='".$delivery_date_time."',pickup_delivery_notes=".$delivery_notes.",cost_centre=".$cost_centre.",order_comments=".$order_comments.",delivery_fee=".$delivery_fee.",standing_order=".$standing_order.",marrondah_order=".$marrondah_order." WHERE order_id=".$order_id);
	}
	public function recalculate_total($order_id)
	{
		$total=0;
		$query=$this->db->query("SELECT * FROM order_product WHERE order_id=".$order_id);
		$res=$query->result();
		foreach($res as $row){
			$total+=$row->total;
			$q2=$this->db->query("SELECT * FROM order_product_option WHERE order_product_id=".$row->order_product_id);
			$r2=$q2->result();
			foreach($r2 as $opt){
				$total+=$opt->option_total;
			}
		}
		$this->db->query("UPDATE orders SET order_total=".$total." WHERE order_id=".$order_id);
	}
	public function reorder($order_id,$date_time)
	{
		$this->db->query("INSERT INTO orders (customer_id,shipping_method,pickup_delivery_notes,order_total,order_status,date_added,date_modified,delivery_date_time,selected_location,standing_order,cost_centre,order_comments,coupon_id,delivery_fee,delivery_phone,delivery_address,delivery_email) SELECT customer_id,shipping_method,pickup_delivery_notes,order_total,15,date_added,date_modified,'".date("Y-m-d H:i",strtotime($date_time))."',selected_location,standing_order,cost_centre,order_comments,coupon_id,delivery_fee,delivery_phone,delivery_address,delivery_email FROM orders WHERE order_id=".$order_id);
		$new_order_id=$this->db->insert_id();
		//Select all products and then the subproducts for $order_id and insert as $new_order_id
		//Can't do as above because then can't insert into order_product_options
		$query=$this->db->query("SELECT * FROM order_product WHERE order_id=".$order_id);
		$res=$query->result();
		foreach($res as $row){
			$this->db->query("INSERT INTO order_product (order_id,product_id,quantity,price,total) VALUES (".$new_order_id.",".$row->product_id.",".$row->quantity.",".$row->price.",".$row->total.")");
			$order_product_id=$this->db->insert_id();
			$query=$this->db->query("SELECT * FROM order_product_option WHERE order_product_id=".$row->order_product_id);
			$this->db->query("INSERT INTO order_product_option (order_product_id,product_option_id,option_quantity,option_price,option_total) SELECT ".$order_product_id.", product_option_id,option_quantity,option_price,option_total FROM order_product_option WHERE order_product_id=".$row->order_product_id);
		}
		//Mark older order as non standing
		$this->db->query("UPDATE orders SET standing_order=0 WHERE order_id=".$order_id);
	}
	public function fetch_running_sheet($orders)
	{
		$final_res=[];
		foreach($orders as $order)
		{
			$query=$this->db->query("SELECT * FROM orders o JOIN customer c ON o.customer_id=c.customer_id JOIN company co ON c.company_id=co.company_id LEFT JOIN store s ON s.location_id=o.selected_location WHERE order_id=".$order);
			$res=$query->result();
			$res=$res[0];
			$query=$this->db->query("SELECT * FROM order_product op join product p on op.product_id=p.product_id where order_id=".$order." order by sort_order asc");
			$res->products=$query->result();
			foreach($res->products as $product){
				$query=$this->db->query("SELECT * FROM order_product op join order_product_option opo on op.order_product_id=opo.order_product_id join product_option po on po.product_option_id=opo.product_option_id join option_value ov on ov.option_value_id=po.option_value_id where op.order_product_id=".$product->order_product_id);
				$product->options=$query->result();
			}
			$final_res[]=$res;
		}
		return $final_res;
	}
	
	public function generate_report($date_from,$date_to,$cost_centre,$cost_centre_list,$company,$status,$marondah='')
	{
		$dateWhere="(delivery_date_time BETWEEN '".$date_from." 00:00:01' AND '".$date_to." 23:59:59')";
		if($cost_centre==0){
			$ccWhere='1';
		}
		else if($cost_centre==1){
			$ccWhere='cost_centre IS NULL';
		}
		else{
			$list=explode(",", $cost_centre_list);
			$inVar=[];
			foreach($list as $cc){
				$inVar[]="'".$cc."'";
			}
			if($list[count($list)-1]=='')
				array_pop($list);
			$inVar=implode(",", $inVar);
			$ccWhere="cost_centre IN (".$inVar.")";
		}
		if($company==0){
			$companyWhere="1";
		}
		else $companyWhere="c.company_id=".$company;
		if($status==0){
			$statusWhere="1";
		}
		else $statusWhere="order_status=".$status;
	

		if(isset($marondah) && $marondah != ''){
	$query=$this->db->query("SELECT * FROM orders o left JOIN customer c ON o.customer_id=c.customer_id left JOIN company co ON c.company_id=co.company_id left JOIN department d ON c.department_id=d.department_id LEFT JOIN coupon cu ON o.coupon_id=cu.coupon_id WHERE ".$dateWhere." AND ".$ccWhere." AND  ".$statusWhere." AND ".$companyWhere." AND  o.order_status != 0 and o.marrondah_order = 1");	    
		    
		}else{
	$query=$this->db->query("SELECT * FROM orders o left JOIN customer c ON o.customer_id=c.customer_id left JOIN company co ON c.company_id=co.company_id left JOIN department d ON c.department_id=d.department_id LEFT JOIN coupon cu ON o.coupon_id=cu.coupon_id WHERE ".$dateWhere." AND ".$ccWhere." AND ".$companyWhere." AND ".$statusWhere." AND o.order_status != 0");	    
		}
		
		return $query->result();
	}
}
