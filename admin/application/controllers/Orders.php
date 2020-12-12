<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('orders_model');
			$this->load->model('products_model');
		
	}
	public function index()
	{
		$this->load->view('general/login');
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
		public function add_new_product()
	{
	    	redirect('orders/order_history');
		$product_name=$_POST['product_name'];
		$product_price=$_POST['product_price'];
		$product_category=$_POST['product_category'];
		$description=$_POST['product_description'];
		
		if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !=''){
                   
                  $image = $this->file_upload_code('image');
               }else{
                   $image ='';
               }
		$data = array(
	        'product_name' =>$product_name,
	        'product_price'=> $product_price,
	        'product_category'=>$product_category,
	        'product_description'=>$description,
	        'product_image'=>$image
	        );
	       //echo "<pre>";
	       //print_r($data);
	       //exit;
	       
		$this->products_model->add_new_product($data);
		redirect('orders/order_history');
	}
	
		public function myoborders(){
	    
	    $this->order_history('','','','','','','myob');
	    
	}
	
	   	public function myob($order_id)
	      {
	         
	        $this->orders_model->myob($order_id);
	      
	     	redirect('orders/order_history');
		
	
		
         	}
         	
	public function order_history($date_from='',$date_to='',$company=0,$fname='',$lname='',$sort_order=0,$myob='',$order_no='')
	{
		if(!empty($this->session->userdata('username')))
		{
		    $params=array();
			if($date_from!=''&&$date_from!='unset')
				$params['date_from']=$date_from;
			if($date_to!=''&&$date_to!='unset')
				$params['date_to']=$date_to;
			if($company!=0)
				$params['company']=$company;
			if($fname!='')
		
				$params['fname']=$fname;
			if($lname!='')
				$params['lname']=$lname;
			if($order_no!='')
				$params['order_no']=$order_no;	
				
			
			
		
	    
			if($sort_order!=0)
				$params['sort_order']=$sort_order;
			$this->load->model('general_model');
			$data['orders']=$this->orders_model->fetch_order_history($params,$myob,'future_order');
			$data['customers']=$this->general_model->fetch_customers();
			$data['companies']=$this->general_model->fetch_companies();
			$this->load->view('general/header'); 			$this->load->view('general/sidebar');
			$this->load->view('orders/order_history',$data);
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	public function past_orders($date_from='',$date_to='',$company=0,$customer=0,$sort_order=0,$order_no ='')
	{
		if(!empty($this->session->userdata('username')))
		{
			$this->load->model('general_model');
			$data['companies']=$this->general_model->fetch_companies();
			$data['customers']=$this->general_model->fetch_customers();
			$params=array();
			if($date_from !=''&&$date_from !='unset')
				$params['date_from']=$date_from;
			if($date_to !='' && $date_to !='unset')
				$params['date_to']=$date_to;
			if($company!=0)
				$params['company']=$company;
			if($customer!=0)
				$params['customer']=$customer;
			if($sort_order!=0)
				$params['sort_order']=$sort_order;
				if($order_no !='' && $order_no !='unset')
				$params['order_no']=$order_no;
			$data['orders']=$this->orders_model->fetch_past_orders($params);
			$this->load->view('general/header'); 			$this->load->view('general/sidebar');
			$this->load->view('orders/past_orders',$data);
			$this->load->view('general/footer');			
		}
		else redirect('general/index');
	}
	public function view_order($order_id)
	{
		//Order ID, Delivery Timing, Customer name, email, phone, delivery notes, cost centre, shipping method, company name, address, delivery info,
		//product names,quantity,unit price,total,comments,order total
		$data['order_info']=$this->orders_model->fetch_order_info($order_id)[0];
		$data['order_products']=$this->orders_model->fetch_order_products($order_id);
		$data['order_product_options']=$this->orders_model->fetch_order_product_options($order_id);
		//echo "<pre>".print_r($data,1);exit;
		$auth=sha1($data['order_info']->firstname."|".$data['order_info']->lastname."|".$data['order_info']->order_id."|".$data['order_info']->order_total);
		$data['fingerprint']=$auth;
		$this->load->view('general/header'); 			$this->load->view('general/sidebar');
		$this->load->view('orders/view_order',$data);
		$this->load->view('general/footer');
	}
	
		public function send_link($order_id,$total)
	{
	   
	   $order_info=$this->orders_model->fetch_order_info($order_id)[0];  
	      $data['customer_name']   = $order_info->firstname;
	      $customer_id   = $order_info->customer_id;
	      $data['ofrom']   = 'backend';
	      
	       $data['download_link']   =  base_url().'index.php/orders/order_inv_download/'.$order_id.'/'.$customer_id.'/';
	    
	     
		$email=$_POST["email_payment"];
		$data['order_id'] = $order_id;
		$data['total'] = $total;
		$config['protocol'] = 'sendmail';
		$config['smtp_host'] = 'localhost';
		$config['smtp_user'] = '';
		$config['smtp_pass'] = '';
		$config['smtp_port'] = 25;
// 		$this->load->library('email', $config);
		$config=array(
            'charset'=>'utf-8',
            'wordwrap'=> TRUE,
            'mailtype' => 'html'
            );
            
           $this->load->library('email', $config);

$this->email->from('noreply@zoukieastonline.com.au', 'Zouki East');

            $this->email->subject('Zoukieast');
		$this->email->to($email);
		
		 $body = $this->load->view('orders/payment_link_email', $data,TRUE);
	
		$this->email->message($body);
			$this->email->send();
	}
	
		public function securepay_customer_link($order_id)
	{
	   $o=$this->orders_model->fetch_order_info($order_id)[0];
	
		if(empty($o->coupon_id))
			$discount=0;
		else{
			if($o->type=='F')
				$discount=$o->coupon_discount;
			else $discount=($o->order_total+$o->delivery_fee)*$o->coupon_discount/100;
		}
		$total=(int)(($o->order_total+$o->delivery_fee-$discount)*100);
		echo $total;
		
		$elem="<form id=\"securepay_form\" action=\"https://payment.securepay.com.au/secureframe/invoice\" method=\"post\">";
		$elem.="<input type=\"hidden\" name=\"bill_name\" value=\"transact\">";
		$elem.="<input type=\"hidden\" name=\"merchant_id\" value=\"45W0031\">";
		$elem.="<input type=\"hidden\" name=\"primary_ref\" value=\"".$order_id."\">";
		$elem.="<input type=\"hidden\" name=\"fp_timestamp\" value=\"".gmdate("YmdHis")."\">";
		$elem.="<input type=\"hidden\" name=\"fingerprint\" value=\"".sha1('45W0031|Roberta123|0|'.$order_id."|".$total."|".gmdate("YmdHis"))."\">";
		$elem.="<input type=\"hidden\" name=\"amount\" value=\"".$total."\">";
		$elem.="<input type=\"hidden\" name=\"txn_type\" value=\"0\">";
		$elem.="<input type=\"hidden\" name=\"currency\" value=\"AUD\">";
		$elem.="<input type=\"hidden\" name=\"return_url\" value=\"".base_url()."index.php/orders/payment_process_customer\">";
		$elem.="<input type=\"hidden\" name=\"return_url_target\" value=\"parent\">";
		$elem.="<input type=\"hidden\" name=\"cancel_url\" value=\"".base_url()."index.php/orders/payment_process_customer\">";
		$elem.="<input type=\"hidden\" name=\"callback_url\" value=\"".base_url()."index.php/orders/payment_process_customer\">";
		$elem.="<input type=\"hidden\" name=\"template\" value=\"default\">";
		$elem.="<input type=\"hidden\" name=\"card_types\" value=\"VISA|MASTERCARD|AMEX\">";
		$elem.="<input type=\"hidden\" name=\"display_receipt\" value=\"no\">";
		$elem.="<input type=\"hidden\" name=\"display_cardholder_name\" value=\"no\">";
		$elem.="</form>";
		$data['elem']=$elem;
		$this->load->view('orders/process_payment',$data); 
	}
	
		public function payment_process_customer()
	{
	    
	    
		if($_POST['rescode']=='00'||$_POST['rescode']=='08'||$_POST['rescode']=='11'){
			$this->orders_model->mark_paid($_POST['refid']);
			
			$this->send_mark_paid_email($_POST['refid']);
			
			$this->load->view('orders/pay_sucess');
			
		}
		else{
		  	$this->load->view('orders/pay_error');

		}
	}
	
		public function group_mark_as_paid($orders,$comment,$pathh)
           	{
	   
	   
	   if(!empty($orders))
		{
		    
			$orders=explode(".",$orders);
			
			
			
		$this->orders_model->group_mark_as_paid($orders,$comment);
		
			
		}
	   	 
	     
	     if($pathh  == "myoborders"){
	         redirect('orders/myoborders');
	     } else{
	         redirect('orders/order_history');
	     }
		
	
		
         	}
		public function delete_order()
	{ 
	         $referrer = $_POST['referrer'];
	  
	        $this->orders_model->delete_order($_POST['order_id']);
	    
		  
			redirect('orders/'.$referrer);
	}
	
		public function mark_as_paid()
	{
	       $this->orders_model->mark_paid($_POST['order_id'],$_POST['mark_paid_comments']);
	        
	       $referrer =  $_POST['referrer'];
	       
	       // $this->send_mark_paid_email($_POST['order_id']);
	     
		 redirect('orders/'.$referrer);
		 
         	}
         	
         	public function send_mark_paid_email($order_id)
	{

          
          $order_info = $this->orders_model->fetch_order_info($order_id)[0];
             
               $user_info = $this->orders_model->fetch_user_info(1);
               
                  $manager_email = $user_info[0]->email;
             
          
        
         $auth=sha1($order_info->firstname."|".$order_info->lastname."|".$order_info->order_id."|".$order_info->order_total);
       
		  $auth_token=$auth;
         
		    $toemail = $order_info->customer_email;
		      
		    $data['customer_name'] = $order_info->firstname;
          
      
          
		   $data['ofrom'] = 'backend';
		   
            $data['order_id'] = $order_id;
          
            $data['auth_token'] = $auth_token;
          
            $config=array(
            'charset'=>'utf-8',
            'wordwrap'=> TRUE,
            'mailtype' => 'html'
            );
             
           	$this->load->library('email', $config);
          
            // $this->email->to($toemail,$manager_email);
            $list = array(
                  
                $toemail,
                
                $manager_email
                
                );
            
           
            $this->email->to($list);

            $this->email->from('noreply@zoukieastonline.com.au', 'Zouki East');
            $this->email->subject('Zoukieast');
            $this->email->message("Order ID ".$order_id." has been marked paid");
            $mail = $this->email->send();
            if($mail) {
                return true;
            } 
            
			
	}
	public function standing_orders($date_from='',$date_to='',$company=0,$customer=0,$sort_order=0)
	{
		if(!empty($this->session->userdata('username')))
		{
			$params=array();
			if($date_from!=''&&$date_from!='unset')
				$params['date_from']=$date_from;
			if($date_to!=''&&$date_to!='unset')
				$params['date_to']=$date_to;
			if($company!=0)
				$params['company']=$company;
			if($customer!=0)
				$params['customer']=$customer;
			if($sort_order!=0)
				$params['sort_order']=$sort_order;
			$this->load->model('general_model');
			$data['orders']=$this->orders_model->fetch_standing_order_history($params);
			$data['companies']=$this->general_model->fetch_companies();
			$data['customers']=$this->general_model->fetch_customers();
			$this->load->view('general/header'); 			$this->load->view('general/sidebar');
			$this->load->view('orders/order_history',$data);
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	public function active_coupons()
	{
		if(!empty($this->session->userdata('username')))
		{
			$data['coupons']=$this->orders_model->fetch_active_coupons();
			$data['title']="Active Coupons";
			$this->load->view('general/header'); 			$this->load->view('general/sidebar');
			$this->load->view('general/coupons',$data);
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	public function archived_coupons()
	{
		if(!empty($this->session->userdata('username')))
		{
			$data['coupons']=$this->orders_model->fetch_archived_coupons();
			$data['title']="Archived Coupons";
			$this->load->view('general/header'); 			$this->load->view('general/sidebar');
			$this->load->view('general/coupons',$data);
			$this->load->view('general/footer');	
		}
		else redirect('general/index');
	}
	public function archive_coupon($coupon_id)
	{
		if(!empty($this->session->userdata('username')))
		{
			$this->orders_model->archive_coupon($coupon_id);
			redirect('orders/active_coupons');
		}
		else redirect('general/index');
	}
	public function activate_coupon($coupon_id)
	{
		if(!empty($this->session->userdata('username')))
		{
			$this->orders_model->activate_coupon($coupon_id);
			redirect('orders/archived_coupons');
		}
		else redirect('general/index');
	}
	public function open_dash()
	{
		if(!empty($this->session->userdata('username')))
		{
			$this->load->model('general_model');
			$data=$this->general_model->fetch_dash_data();
			$this->load->view('general/header-dash'); 			
			$this->load->view('general/sidebar');
			$this->load->view('orders/dash',$data);
			$this->load->view('general/footer-dash');
		}
		else redirect('general/index');
	}
	public function new_order_customer_details($company='',$customer='',$phone='',$email='',$cost_centre='',$delivery_date_time='',$delivery_notes='',$shipping_method='',$delivery_address='',$pickup_location='',$delivery_fee='')
	{
		if(!empty($this->session->userdata('username')))
		{
			$data=array(
				'pre_company'=>$company,
				'pre_customer'=>$customer,
				'pre_phone'=>$phone,
				'pre_email'=>$email,
				'pre_cost_centre'=>$cost_centre,
				'pre_delivery_date_time'=>$delivery_date_time,
				'pre_delivery_notes'=>$delivery_notes,
				'pre_shipping_method'=>$shipping_method,
				'pre_delivery_address'=>$delivery_address,
				'pre_pickup_location'=>$pickup_location,
				'pre_delivery_fee'=>$delivery_fee
			);
			$this->load->model('general_model');
			$data['companies']=$this->general_model->fetch_companies();
			$data['departments']=$this->general_model->fetch_departments();
			$data['customers']=$this->general_model->fetch_customers();
			$data['stores']=$this->general_model->fetch_stores();
			$this->load->view('general/header'); 			$this->load->view('general/sidebar'); 			$this->load->view('general/sidebar');
			$this->load->view('orders/new_order_page',$data);
			$this->load->view('general/footer');
		}
		else redirect('general/index');
	}
	public function new_order()
	{
		if(!empty($this->session->userdata('username')))
		{
			$data['company']=htmlspecialchars($_POST['company_id']);
			$data['customer']=htmlspecialchars($_POST['customer_id']);
			$data['phone']=empty($_POST['phone'])?'null':htmlspecialchars($_POST['phone']);
			$data['email']=empty($_POST['email'])?'null':htmlspecialchars($_POST['email']);
			$data['cost_centre']=empty($_POST['cost_centre'])?'null':htmlspecialchars($_POST['cost_centre']);
			$data['delivery_date_time']=empty($_POST['delivery_date']." ".$_POST['delivery_time'])?'null':$_POST['delivery_date']." ".$_POST['delivery_time'];
			$data['delivery_notes']=empty($_POST['delivery_notes'])?'null':htmlspecialchars($_POST['delivery_notes']);
			$data['shipping_method']=empty($_POST['shipping_method'])?'null':htmlspecialchars($_POST['shipping_method']);
			$data['delivery_address']=empty($_POST['delivery_address'])?'null':htmlspecialchars($_POST['delivery_address']);
			$data['pickup_location']=empty($_POST['pickup_location'])?'null':htmlspecialchars($_POST['pickup_location']);
			$data['delivery_fee']=empty($_POST['delivery_fee'])?0:$_POST['delivery_fee'];
			//First 20 products that aren't blank and don't start with a '*'
			$this->load->model('general_model');
			$data['products']=$this->general_model->fetch_products(1);
			$data['page']=1;
			$data['max_page']=$this->general_model->fetch_max_pages('product');
			$data['categories']=$this->general_model->fetch_categories();
			//echo "<pre>".print_r($data,1);exit;
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			$this->load->view('orders/new_order_products',$data);
			$this->load->view('general/footer');
		}
		else redirect('general/index');
	}
	public function fetch_products_page($page)
	{
		$res=[];
		$res[0]='';
		$this->load->model('general_model');
		$max_page=$this->general_model->fetch_max_pages('product');
		$products=$this->general_model->fetch_products($page);
		if(!empty($products)){
			foreach($products as $product){
				$res[0].="<input type=\"hidden\" id=\"price-".$product->product_id."\" value=\"".$product->product_price."\">";
				$res[0].="<tr id=\"product-row-".$product->product_id."\">";
				$res[0].="<td>".$product->product_name."</td>";
				$res[0].="<td>".ucwords($product->category_name)."</td>";
				$res[0].="<td>$".number_format($product->product_price,2)."</td>";
				$res[0].="<td>";
				if(empty($product->options)){
					$res[0].="<input class=\"form-control\" type=\"text\" id=\"qty-".$product->product_id."\" placeholder=\"0\">";
				}
				else{
					$res[0].="<button type=\"button\" class=\"btn btn-primary\" onclick=\"open_modal(".$product->product_id.")\">Options</button>";
				}
				$res[0].="</td>";
				$res[0].="<td>";
				if(empty($product->options))
					$res[0].="<button type=\"button\" class=\"btn btn-info new-product-form\" id=\"new-product-".$product->product_id."\">Add</button>";
				$res[0].="</td>";
				$res[0].="</tr>";
			}
			$res[1]='';
			if($page!=1&&$page!=2){
				$res[1].="<li class=\"page-item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page-1)."\">Previous</a></li>";
				$res[1].="<li class=\"page-item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page-2)."\">".($page-2)."</a></li>";
				$res[1].="<li class=\"page-item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page-1)."\">".($page-1)."</a></li>";
			} else if($page!=1){
				$res[1].="<li class=\"page-item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page-1)."\">Previous</a></li>";
				$res[1].="<li class=\"page-item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page-1)."\">".($page-1)."</a></li>";
			} else {
				$res[1].="<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\" disabled>Previous</a></li>";
			}
			$res[1].="<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">".$page."</a></li>";
			if($page!=$max_page&&$page!=$max_page-1){
				$res[1].="<li class=\"page_item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page+1)."\">".($page+1)."</a></li>";
				$res[1].="<li class=\"page_item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page+2)."\">".($page+2)."</a></li>";
				$res[1].="<li class=\"page-item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page+1)."\">Next</a></li>";
			} else if($page!=$max_page){
				$res[1].="<li class=\"page_item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page+1)."\">".($page+1)."</a></li>";
				$res[1].="<li class=\"page-item\"><a class=\"page-link\" href=\"".base_url()."index.php/orders/fetch_products_page/".($page+1)."\">Next</a></li>";
			} else {
				$res[1].="<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\" disabled>Next</a></li>";
			}
		}
		echo json_encode($res);
	}
	public function new_order_products()
	{
		
		$data['company']=$_POST['company'];
		$data['customer']=$_POST['customer'];
		$data['phone']=$_POST['phone'];
		$data['email']=$_POST['email'];
		$data['delivery_date_time']=$_POST['delivery_date_time'];
		$data['delivery_notes']=$_POST['delivery_notes'];
		$data['shipping_method']=$_POST['shipping_method'];
		$data['delivery_fee']=$_POST['delivery_fee'];
		$data['coupon']=empty($_POST['coupon_code'])?'null':$_POST['coupon_code'];
		$data['order_comments']=empty($_POST['order_comments'])?'null':$_POST['order_comments'];
		$data['standing_order']=empty($_POST['standing_order'])?0:1;
		$data['marrondah_order']=empty($_POST['marrondah_order'])?0:1;
		
	
		if(!empty($_POST['option'])){
			$data['option']=$_POST['option'];
		}
		if($data['shipping_method']==1){
			$data['delivery_address']=$_POST['delivery_address'];
		}
		else{
			$data['pickup_location']=$_POST['pickup_location'];
		}
		$data['cost_centre']=$_POST['cost_centre'];
		if(!empty($_POST['qty'])) $data['products']=$_POST['qty'];
		else $data['products']=null;
		
			if(!empty($_POST['order_product_comment'])) $data['order_product_comment']=$_POST['order_product_comment'];
		else $data['order_product_comment']=null;
		
		
	
		
		$order_id=$this->orders_model->new_order($data);
		redirect('orders/view_order/'.$order_id);
		
	}
	public function edit_order($order_id)
	{
		$data['order_product_options']=$this->orders_model->fetch_all_op_details($order_id);
		$data['order_info']=$this->orders_model->fetch_order_info($order_id)[0];
		$data['delivery_date_time']=$data['order_info']->delivery_date_time;
		$this->load->model('general_model');
		$data['products']=$this->general_model->fetch_products(1);
		$data['page']=1;
		$data['max_page']=$this->general_model->fetch_max_pages('product');
		$data['categories']=$this->general_model->fetch_categories();

		$this->load->view('general/header'); 
		$this->load->view('general/sidebar');
		$this->load->view('orders/edit_order',$data);
		$this->load->view('general/footer');
	}
	public function edit_order_process($order_id)
	{
		if(!empty($_POST['delete_option'])){
			foreach($_POST['delete_option'] as $option){
				$this->orders_model->delete_option_from_order(explode("_",$option)[1]);
			}
		}
		if(!empty($_POST['delete'])){
			foreach($_POST['delete'] as $product){
				$this->orders_model->delete_product_from_order($product);
			}
		}
		if(!empty($_POST['existing_qty'])){
			foreach($_POST['existing_qty'] as $product=>$qty){
				$this->orders_model->update_product_quantities($product,$qty);
			}
		}
		
		
			if(isset($_POST['existing_order_product_comment']) && !empty($_POST['existing_order_product_comment'])){
			    
			foreach($_POST['existing_order_product_comment'] as $product_com=>$comment){
			    
			    if(!empty($comment)){
			       
			      	$this->orders_model->update_product_comment($product_com,$comment);  
			    }
			
			 }
		      }
		    
		      
		      if(isset($_POST['order_product_comment']) && !empty($_POST['order_product_comment'])){
		          
		      	foreach($_POST['order_product_comment'] as $prod_comment=>$cmnt){
		      	   if(!empty($cmnt)){
				$this->orders_model->add_productcomment_to_order($order_id,$prod_comment,$cmnt);
		      	    }
			  }
		     }
		
		
		
		if(!empty($_POST['existing_option'])){
			foreach($_POST['existing_option'] as $option=>$qty){
				$this->orders_model->update_option_quantities($option,$qty);
			}
		}
		if(!empty($_POST['qty'])){
			foreach($_POST['qty'] as $prod=>$qty){
				$this->orders_model->add_product_to_order($order_id,$prod,$qty);
			}
		}
		if(!empty($_POST['option'])){
			foreach($_POST['option'] as $option=>$qty){
				$this->orders_model->add_option_to_order($order_id,$option,$qty);
			}
		}
		//Recalculate Total
		$this->orders_model->recalculate_total($order_id);
		
		$cust_id =empty($_POST['cust_id'])?'null':$_POST['cust_id'];
		
		$cust_firstname =empty($_POST['cust_firstname'])?'null':$_POST['cust_firstname'];
		
		$cust_email = empty($_POST['cust_email'])?'null':$_POST['cust_email'];
		
		$cust_telephone =empty($_POST['cust_telephone'])?'null':$_POST['cust_telephone'];
		
		$delivery_addr =empty($_POST['delivery_addr'])?'null':$_POST['delivery_addr'];
		
		$delivery_addr =empty($_POST['delivery_addr'])?'null':$_POST['delivery_addr'];

		$company_id =empty($_POST['comp_addr_id'])?'null':$_POST['comp_addr_id'];
		
		$company_name =empty($_POST['company_name'])?'null':$_POST['company_name'];
		
		$comp_addr =empty($_POST['comp_addr'])?'null':$_POST['comp_addr'];
		
		$department_name =empty($_POST['department_name'])?'null':$_POST['department_name'];
	
		$coupon_code=empty($_POST['coupon_code'])?'null':$_POST['coupon_code'];
		$delivery_date_time=$_POST['delivery_date']." ".$_POST['delivery_time'];
		$delivery_notes=empty($_POST['delivery_notes'])?'null':$_POST['delivery_notes'];
		$order_comments=empty($_POST['order_comments'])?'null':$_POST['order_comments'];
		$cost_centre=empty($_POST['cost_centre'])?'null':$_POST['cost_centre'];
		$delivery_fee=empty($_POST['delivery_fee'])?0:$_POST['delivery_fee'];
		$standing_order=empty($_POST['standing_order'])?0:1;
		
		$marrondah_order =empty($_POST['marrondah_order'])?0:1;
		
		$this->orders_model->update_order_details($company_id,$company_name,$department_name,$cust_id,$order_id,$coupon_code,$delivery_date_time,$delivery_notes,$order_comments,$cost_centre,$delivery_fee,$standing_order,$marrondah_order,$cust_firstname,$cust_email,$cust_telephone,$delivery_addr,$comp_addr);
		
		redirect('orders/view_order/'.$order_id);
	}
	
		public function chnage_product_sort_order()
     	{
        	$i = 0;

         foreach ($_POST['cart-existing-item'] as $value) {
     
        
        $this->db->query("UPDATE order_product SET sort_order=".$i." WHERE order_product_id=".$value);
         $i++;
      
         }
     	}
	public function reorder()
	{
		$order_id=$_POST['order_id'];
		$date_time=date("Y-m-d H:i",strtotime($_POST['delivery_date']." ".$_POST['delivery_time']));
		$this->orders_model->reorder($order_id,$date_time);
		redirect('orders/standing_orders');
	}
	public function running_sheet($orders)
	{
	    
	   
		if(!empty($orders))
		{
		    
			$orders=explode(".",$orders);
			
	
			$data=$this->orders_model->fetch_running_sheet($orders);
			
		
			
	    $csvStr="Order ID,Customer ,Order Comments,Delivery Date,Delivery Notes,Delivery Address,Quantity,Product,Description,Options,Product Comment\n";

			  $i= 0;
			    
			    
		
			foreach($data as $order){
			   
			    if($i != 0){
			     $csvStr.= "\n";
			     $csvStr.= "===========================================================================================================================================================";
			     $csvStr.= "===========================================================================================================================================================";
			     $csvStr.= "\n";
			     $csvStr.="Order ID,Customer ,Order Comments,Delivery Date,Delivery Notes,Delivery Address,Quantity,Product,Description,Options,Product Comment\n";
			    }
			    
			  
			    
			     $i++;
			   
			    $csvStr .="\"".$order->order_id."\",\"".$order->firstname." ".$order->lastname."\",\"".$order->order_comments."\",\"".date("d-m-Y",strtotime($order->delivery_date_time))."\",\"";

			    if(isset($order->pickup_delivery_notes)){
				    $string = preg_replace('/\s+/', '', $order->pickup_delivery_notes);    
				    $csvStr.= $string."\",\"";
 
				      }
				      else{
				          
		       	    $csvStr.= " "."\",\"".''."\",\"";
       
				      }
			    
			    	 $csvStr.= $order->delivery_address."\",\"";
			         $i = 0;
			         $blank = '';
			    
			  
			    
				if(!empty($order->products)){
					foreach($order->products as $product){
					    
					    
					    if($i == 0){
					        
					     $csvStr.= $product->quantity."\",\"";
					    }else{
					        
				     $csvStr.= "\"". $blank."\",\"". $blank."\",\"".$blank."\",\"".$blank."\",\"".$blank."\",\"".$blank."\",\"".$product->quantity; 
				 
					    }
					    
						if(isset($product->product_description) && !empty($product->product_description)){
						
							$desc=$product->product_description;
					      }else{
					          $desc = '';
					      }
				// 		else if(isset($product->name) && !empty($product->name)){
				// 		    $desc= $product->name;
				// 		} 
						if(isset($product->product_desc_1) && !empty($product->product_desc_1)){
							 if(!empty($product->product_desc_1)){
							$desc1="\n".$product->product_desc_1;
						    }else{
						       $desc1=''; 
						    }
						
						
						if(!empty($product->product_desc_2)){
							$desc2="\n".$product->product_desc_2;
						}
						else $desc2='';
						if(!empty($product->product_desc_3)){
							$desc3="\n".$product->product_desc_3;
						}
						else $desc3='';
						
						if(!empty($product->product_desc_4)){
							$desc4="\n".$product->product_desc_4;
						}
						else $desc4='';
						if(!empty($product->product_desc_5)){
							$desc5="\n".$product->product_desc_5;
						}
						else $desc5='';
						}
						else if(isset($product->desc) && !empty($product->desc)){
						   
						   
						   if(!empty($product->desc[0]->desc_1)){
							$desc1="\n".$product->desc[0]->desc_1;
						   }
						else $desc1='';
						
						if(!empty($product->desc[0]->desc_2)){
							$desc2="\n".$product->desc[0]->desc_2;
						   }
						else $desc2='';
						
						if(!empty($product->desc[0]->desc_3)){
							$desc3="\n".$product->desc[0]->desc_3;
						   }
						else $desc3='';
						
						if(!empty($product->desc[0]->desc_4)){
							$desc4="\n".$product->desc[0]->desc_4;
						   }
						else $desc4='';
						
					if(!empty($product->desc[0]->desc_5)){
							$desc5="\n".$product->desc[0]->desc_5;
						   }
						else $desc5='';
						
						}else{
						    
						$desc1='';  
						$desc2='';
						$desc3='';
						$desc4='';
						$desc5='';
						    
						}
						
						if(isset($product->product_name)){
						    
						    $prd_name = $product->product_name;
						    
						  // $prd_name =  wordwrap($prd_name,15,"<br>\n");
						}else{
						    
						    $prd_name = $product->name;
						    
						  //  $prd_name =  wordwrap($prd_name,15,"<br>\n");
						    
						}
						
						
						
						if($i == 0){
						    
						 $csvStr.= $prd_name."\",\"".$desc.$desc1.$desc2.$desc3.$desc4.$desc5."\",\"";   
						    
						}else{
						   
						   $csvStr.= "\",\"".$prd_name."\",\"".$desc.$desc1.$desc2.$desc3.$desc4.$desc5."\",\""; 
						}
						
						$i++;
						$j =0;
						if(!empty($product->options)){
							foreach($product->options as $option){
							    if(isset($option->option_quantity)){
							        $opt_qty = $option->option_quantity;
							    }else{
							        
							       $opt_qty = $option->option_qty; 
							    }
							    
							     //$csvStr.=$option->name." - Qty : ".$opt_qty."\"\n"; 
							    if($j == 0){
							        
							      $csvStr.=$option->name." - Qty : ".$opt_qty."\"\n";  
							        
							    }else{
							        
							     $csvStr.= "\"". $blank."\",\"". $blank."\",\"".$blank."\",\"".$blank."\",\"".$blank."\",\"".$blank."\",\"".$blank."\",\"".$blank."\",\"".$blank."\",\"".$option->name." - Qty : ".$opt_qty."\"\n";     
							        
							    }
							    
								
								$j++;
							}
							
							$csvStr.="\",\"";

						}
					
				     $csvStr.= $product->order_product_comment."\"\n";
					}
				}
				
			
			}
		}
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"Running Sheet ".date("d-m-Y",strtotime("today")).".csv\"");
		echo $csvStr;
	}
	public function print_order($order_id,$auth_token)
	{
		
		$data['order_info']=$this->orders_model->fetch_order_info($order_id)[0];
		$data['order_products']=$this->orders_model->fetch_order_products($order_id);
		$data['order_product_options']=$this->orders_model->fetch_order_product_options($order_id);
		//Fingerprinting auth
		//sha1 hash of firstname|lastname|order_id|total
		$auth=sha1($data['order_info']->firstname."|".$data['order_info']->lastname."|".$data['order_info']->order_id."|".$data['order_info']->order_total);
		if($auth==$auth_token){
			$this->load->view('general/header_print');
			$this->load->view('orders/print_order',$data);
			$this->load->view('general/footer_print');
		}
		else echo "Oops! You do not have the correct authentication token to see this invoice. Please get in touch with us at the earliest to resolve this issue.";
	}
	
	public function payment_process()
	{
		if($_POST['rescode']=='00'||$_POST['rescode']=='08'||$_POST['rescode']=='11'){
			$this->orders_model->mark_paid($_POST['refid']);
			redirect('orders/view_order/'.$_POST['refid']);
		}
		else{
			//Payment failed, show failure page
			$this->load->view('general/header'); 
			$this->load->view('general/sidebar');
			$this->load->view('general/payment_error');
			$this->load->view('general/footer');
		}
	}
	public function reports()
	{
		if(!empty($this->session->userdata('username')))
		{
			$this->load->model('general_model');
			$data['companies']=$this->general_model->fetch_companies();
			$this->load->view('general/header');
			$this->load->view('general/sidebar');
			
			$this->load->view('orders/report',$data);
			$this->load->view('general/footer');
		}
		else redirect('general/index');
	}
	public function generate_report()
	{
		if(!empty($this->session->userdata('username')))
		{ 
			if(isset($_POST["date_from"]))
				$date_from=trim($_POST["date_from"])==''?"1000-01-01":date("Y-m-d",strtotime($_POST["date_from"]));
			else $date_from="0000-00-00";
			if(isset($_POST["date_to"]))
				$date_to=trim($_POST["date_to"])==''?"9999-12-31":date("Y-m-d",strtotime($_POST["date_to"]));
			else $date_to="9999-99-99";
			$cost_centre=$_POST["cost_centre"];
			$cost_centre_list=empty($_POST["cost_centre_list"])?'null':$_POST['cost_centre_list'];
			$company=$_POST["company"];
			$status = $_POST["status"];
			$marondah = $_POST["marondah"];
			$res['data']=$this->orders_model->generate_report($date_from,$date_to,$cost_centre,$cost_centre_list,$company,$status,$marondah);
			$data=$res['data'];
			$csvStr="Order #,Order Date,Delivery Date,Customer,Company,Cost Centre,Phone,Email,Subtotal,Discount,Delivery,Total,GST,Status\n";
			$res['params']['date_from']=$date_from;
			$res['params']['date_to']=$date_to;
			$res['params']['cost_centre']=$cost_centre;
			$res['params']['cost_centre_list']=$cost_centre_list;
			$res['params']['company']=$company;
			$res['params']['status']=$status;
			$res['params']['marondah']=$marondah;
			
			$this->load->view('general/header'); 
			$this->load->view('general/sidebar');
			$this->load->view('orders/generated_report',$res);
			$this->load->view('general/footer');
		}
		else redirect('general/index');
	}
	public function get_report_csv()
	{
		if(isset($_POST["date_from"]))
			$date_from=trim($_POST["date_from"])==''?"1000-01-01":date("Y-m-d",strtotime($_POST["date_from"]));
		else $date_from="0000-00-00";
		if(isset($_POST["date_to"]))
			$date_to=trim($_POST["date_to"])==''?"9999-12-31":date("Y-m-d",strtotime($_POST["date_to"]));
		else $date_to="9999-99-99";
		$cost_centre=$_POST["cost_centre"];
		$cost_centre_list=empty($_POST["cost_centre_list"])?'null':$_POST['cost_centre_list'];
		$company=$_POST["company"];
		$status=$_POST["status"];
		
		$marondah=$_POST["marondah"];
		
		$res['data']=$this->orders_model->generate_report($date_from,$date_to,$cost_centre,$cost_centre_list,$company,$status,$marondah);
		$data=$res['data'];
		$csvStr="Order #,Order Date,Delivery Date,Customer,Department,Company,Cost Centre,Phone,Email,Subtotal,Discount,Delivery,Total,GST,Status\n";
		$subtotal=0.0;
		$delivery_total=0.0;
		$discount_total=0.0;
		$total=0.0;
		$gst_total=0.0;
		if(!empty($data)){
			foreach($data as $row){
				if(empty($row->delivery_phone))
					$phone=$row->customer_telephone;
				else 
					$phone=$row->delivery_phone;
				if(empty($row->delivery_email))
					$email=$row->customer_email;
				else
					$email=$row->delivery_email;
				if(empty($row->coupon_id)){
					$discount=0;
				}
				else{
					if($row->type=='F')
						$discount=$row->coupon_discount;
					else if($row->type=='P')
						$discount=($row->order_total*$row->coupon_discount/100);	
				}
				if($row->order_status==1)
				{
					$status="Paid";
				}
				else
				{
					$status="Outstanding";
				}
				$csvStr.="\"".$row->order_id."\",\"".date('d-m-Y',strtotime($row->date_added))."\",\"".date("d-m-Y",strtotime($row->delivery_date_time))."\",\"".$row->firstname." ".$row->lastname."\",\"".$row->department_name."\",\"".$row->company_name."\",\"".$row->cost_centre."\",\"".$phone."\",\"".$email."\",\"$".number_format($row->order_total,2)."\",\"$".$discount."\",\"$".number_format($row->delivery_fee,2)."\",\"$".number_format($row->order_total-$discount+$row->delivery_fee,2)."\",\"$".number_format(($row->order_total-$discount+$row->delivery_fee)/11,2)."\",\"".$status."\"\n";
				$subtotal+=$row->order_total;
				$delivery_total+=$row->delivery_fee;
				$discount_total+=$discount;
				$total+=($row->order_total-$discount+$row->delivery_fee);
				$gst_total+=(($row->order_total-$discount+$row->delivery_fee)*0.1);
			}
			$csvStr.="\n";
			$csvStr.=",,,,,,,,Totals,\"$".number_format($subtotal,2)."\",\"$".number_format($discount_total,2)."\",\"$".number_format($delivery_total,2)."\",\"$".number_format($total,2)."\",\"$".number_format($gst_total,2)."\",\n";
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=\"Report ".date("d-m-Y",strtotime("today")).".csv\"");
			echo $csvStr;
		}
	}
	public function send_email($order_id,$auth_token)
	{
		$email=$_POST["email"];
		$config['protocol'] = 'sendmail';
		$config['smtp_host'] = 'localhost';
		$config['smtp_user'] = '';
		$config['smtp_pass'] = '';
		$config['smtp_port'] = 25;
		$this->load->library('email', $config);
		$this->email->from('noreply@zoukieastonline.com.au', 'Zouki East');
		$this->email->to($email);
		$this->email->subject('Details of your order at Zouki East');
		$this->email->message("The details for your order at Zouki East Online (Order #".$order_id.") can be viewed at:http://zoukieastonline.com.au/portal/index.php/orders/print_order/".$order_id."/".$auth_token."\r\nThank you, and have a great day!\r\nRegards,\r\nTeam Zouki East");
			$this->email->send();
		}
		
		public function order_inv_download($order_id,$cust_id){ 
	    
	      if (isset($order_id)) {
	     
	
		$order_info =$this->orders_model->fetch_order_info($order_id);
	
		
		$order_info = (array)$order_info[0];
		


	
		$order_prods =$this->orders_model->fetch_order_products($order_id);
		
		
		
	
		$order_product_options =$this->orders_model->fetch_order_product_options($order_id);
			
		
		
		foreach($order_prods as $order_prod){
		        
		    	$order_prd = $order_prod;
		    	
			    $order_prd = (array)$order_prd;
			    
			    
			    for ($i = 1; $i < 6; $i++){
			        
                 	$all_prod_descs[] = array(
                         
                 'desc_'.$i => $order_prd['product_desc_'.$i]
                        
                     );

             }
             
		    
		    
		    $allproducts[] = array(
		   'name' => $order_prod->product_name,
		   'order_product_comment' => $order_prod->order_product_comment,
		  
		   'quantity' => $order_prod->quantity,
		   'desc' => $all_prod_descs,
		   'price' => $order_prod->price,
		   'total' => $order_prod->total,
		   'option' => $order_prod->options,
		   'product_description'=> $order_prod->product_description
		    );
		    
		    unset($all_prod_descs);
		}
		
		
		
		
	if(file_exists(getcwd().'/application/controllers/fpdf.php')){
		    
		  require(getcwd().'/application/controllers/fpdf.php');
		    
		  
		}
	   

	   	
        $pdf = new FPDF();
         
       
      $pdf->AddPage();
	 $pdf->SetAutoPageBreak(15,true);    
	    if (isset($order_id)) {
	        
	        if (isset($cust_id)) {
	            
	            $this->session->data['customer_id'] = $cust_id;
	        }
	        
	      
	       
$pdf->SetFont('Times','',9);

$pdf->Image(getcwd().'/application/controllers/logo.jpg',80,10,55,10,'jpg');

$pdf->SetTextColor(0,0,0);

$pdf->Cell(189 ,10,'',0,1);

$pdf->SetFont('Times','B',13);

$pdf->Cell(170,26,'TAX INVOICE',0,0,'R');




//set font to arial, regular, 12pt

$pdf->SetFont('Times','B',13);
$pdf->Cell(70 ,10,'',0,1);

 $pdf->Cell(100 ,5,'Hoscat Pty Ltd',0,1);

$cpmanyaddress = '';


$addd_text = '8 Arnold St, Boxhill, VIC 3128';

$cpmanyaddressr_data[] = array(
    'comp_addr' => $addd_text
    
    );

$pdf->BasicTable($cpmanyaddress,$cpmanyaddressr_data,'multicell');



$pdf->SetFont('Times','',14);

$pdf->Cell(189 ,3,'',0,1);

$pdf->Cell(170 ,5,'Invoice #'.$order_info['order_id'],0,1,'R');

$pdf->SetFont('Times','',9);

// $phpdate = strtotime( $order_info['date_added'] );
// $mysqldate = date( 'd/m/y ', $phpdate );



//  $pdf->Cell(189 ,1,'',0,1);
//  $pdf->Cell(189 ,1,'',0,1);
// $pdf->Cell(170 ,3,'Order Date : '.$mysqldate,0,1,'R');
//  $pdf->Cell(189 ,1,'',0,1);

if($order_info['order_status'] == 1){
    
$paiddate = strtotime( $order_info['date_modified'] );

$paiddate = date( 'd/m/y ', $paiddate );

$pdf->Cell(170 ,3,'Paid Date : '.$paiddate,0,1,'R');

}


$pdf->Cell(80 ,5,'Telephone :  0447028980',0,1,'L'); 


$pdf->Cell(189 ,3,'',0,1);

$pdf->Cell(60 ,5,'ABN: 63 603 953 000',0,1);




if((isset($order_info['customer_company_name']) || $order_info['company_name']) && ($order_info['customer_company_name'] != ''  || $order_info['company_name'] !='')){
  $addr = array('Company Information','Delivery Address');  
}else{
    
   $addr = array('','Delivery Address'); 
}

if(isset($order_info['customer_company_name']) && $order_info['customer_company_name'] !=''){
  
    $com_name_addr =  $order_info['customer_company_name'].' '.$order_info['customer_company_addr']; 
    
}elseif(isset($order_info['company_name']) && $order_info['company_name'] !=''){
    
    $com_name_addr =  $order_info['company_name'].' ,'.$order_info['department_name'].''.$order_info['company_address']; 
}


$addr_data[] = array(
    'comp_addr' => $com_name_addr,
    'addr'=> ucfirst($order_info['firstname']). ' '. ucfirst($order_info['lastname']).', '.
    $order_info['delivery_address'].''
    .$order_info['shipping_country'].''
    .$order_info['shipping_postcode']
   
    
    );
    
    	
   
$pdf->BasicTable($addr,$addr_data,'multicell');



$dept = array('');
 $dept_dta[] = array(
   
    'dept'=> $order_info['customer_department_name'],
    
    );



 $pdf->BasicTable($dept,$dept_dta,'no border');
 

if(isset($order_info['pickup_delivery_notes']) && $order_info['pickup_delivery_notes'] !=''){
  $deliveryheader = array('Delivery Note');
 $del_dta[] = array(
    
    'deliv_not'=> $order_info['pickup_delivery_notes'],
    
    );


$pdf->Cell(189 ,5,'',0,1);


$pdf->BasicTableforlongtext($deliveryheader,$del_dta,'no border');  

$pdf->Cell(189 ,5,'',0,1);
    
$pdf->SetFillColor(255, 255, 255);
}


if(isset($order_info['order_comments']) && $order_info['order_comments'] != '')
{ 
   $header = array('Order Comments');
  $order_dta[] = array(
    
    'order_comments'=> $order_info['order_comments'],
    
    );
  
$pdf->Cell(189 ,5,'',0,1);


 $pdf->BasicTableforlongtext($header,$order_dta,'no border');  
    
$pdf->SetFillColor(255, 255, 255);
    
}




$pdf->SetFont('Times','',9);

$pdf->SetFillColor(255, 255, 255);


$pdf->Cell(189 ,7,'',0,1);





$header = array('Payment Method', 'Shipping Method ', 'Delivery Date', 'Phone');

if($order_info['shipping_method'] == 1){
    $sm =  "Delivery";
}else{
    
    $sm =  "Pickup";
}

if($order_info['cost_centre'] != ''){
    $pm =  "Cost Center";
}
if($order_info['order_status'] == 3){
    
    $pm =  "Credit Card";
}


$phpdate = strtotime( $order_info['delivery_date_time'] );
$delivery_date_time = date( 'd/m/y H:i:s', $phpdate );



   $dta[] = array(
    
    'pm'=> $pm,
    'sm'=> $sm,
    'dd'=> $delivery_date_time,
    'tel'=> $order_info['customer_telephone'],
    
    );

 $pdf->BasicTable2($header,$dta);



$pdf->SetFont('Times','',10);
$header = array('Product Name', 'Product Comments', 'Quantity', 'Price','Total');

 $pdf->SetFillColor(255, 255, 255);


       foreach ($allproducts as $key=> $product) { 
               
                 if(!empty($product['option']) ){
                     $prices = 0;
                     $option_tot = 0;
                     foreach ($product['option'] as $opt){
                         
                         $opt=(array)$opt;
                         $prices +=$opt['option_price'];
                         
                         $option_tot += ($opt['option_price']*$opt['option_quantity']);
                     }
                     
                     
                   }else if($product['price'] > 0){
                     $prices = $product['price'];
                     $option_tot = $product['total'];
                     
                   }else{
                     $prices = '';
                     $option_tot = '';
                   }
                   
                   
                   
                 
                 
                 
                 if(!empty($product['product_description'])){
                      
                      $prd_desc_dta[] = array(
    
                     'descname'=> $product['product_description'],
                     'descname_1' => '',
                     'descname_2' => '',
                     'descname_3' => '',
                     'descname_4' => '',
                      );
                      }
                 
                  
                  if(isset($product['desc']) && !empty($product['desc'][0]['desc_1'])){
                     
                 
                     $i =1;
                     foreach($product['desc'] as $all_prod_desc){
                       
                         if(!empty($all_prod_desc['desc_'.$i])){
                             
                             $prd_desc_dta[] = array(
    
                               'product_mini_desc'=> $all_prod_desc['desc_'.$i],
                               'product_mini_desc_1' => '',
                               'product_mini_desc_2' => '',
                               'product_mini_desc_3' => '',
                               'product_mini_desc_4' => '',
                              );
                           
                              }
                         $i++;
                       }
                     
                 }
                 
                 
           
                 
                 
                  
           if(!empty($product['option']) ){
                 
                 
               foreach ($product['option'] as $option) {
                 
                 $option=(array)$option;
                 
               $prdct_option_dta[] = array(
    
                'name'=> $option['option_name'],
                'blank'=> '',
                'quantity'=> $option['option_quantity'],
               'price'=> number_format($option['option_price'],2),
               'total'=> number_format($option['option_price']*$option['option_quantity'],2),
                
                );
               }
             
                
                      
                }
                
                
                 $prdct_dta[] = array(
    
                 'name'=> $product['name'],
                 'order_product_comment'=> $product['order_product_comment'],
                 'quantity'=> $product['quantity'],
                 'price'=> number_format($prices,2),
                 'total'=> number_format($option_tot,2),
                 'prd_desc_dta'=> $prd_desc_dta,
                 'all_prd_option' => $prdct_option_dta
                 
    
                );
                
                unset($prdct_option_dta);
                unset($prd_desc_dta);
                
             
                } 
          

$pdf->Cell(189 ,10,'',0,1);
$pdf->BasicProducttable($header,$prdct_dta);

 $pdf->Ln('11');
 
  
$pdf->Cell(32, 10, '' ,'T',0,'C',0); 
$pdf->Cell(31, 10, '' ,'T',0,'C',0); 
$pdf->Cell(32, 10, '' ,'T',0,'C',0); 
$pdf->Cell(36, 10, '' ,'T',0,'C',0);


$pdf->Cell(31, 10, 'Subtotal' ,1,0,'C',1);

$pdf->Cell(32, 10, '$ '.number_format($order_info['order_total'],2) ,1,1,'C',1);



if(isset($order_info['delivery_fee']) && $order_info['delivery_fee'] != 0 )
{
    
$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(31, 10, '' ,0,0,'C',0); 
$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(36, 10, '' ,0,0,'C',0);


$pdf->Cell(31, 10, 'Delivery Charge' ,1,0,'C',1);

$pdf->Cell(32, 10, '$ '.number_format($order_info['delivery_fee'],2) ,1,1,'C',1);


}



if(!is_null($order_info['coupon_discount'])){
										if($order_info['type']=='F')
											$coupon_discount=$order_info['coupon_discount'];
										else{
											$total_so_far=$order_info['order_total']+$order_info['delivery_fee'];
											$coupon_discount=($order_info['coupon_discount']*($order_info['order_total']+$order_info['delivery_fee']))/100;
										}

}else{
    
    $coupon_discount = 0;
}


if(isset($coupon_discount) && $coupon_discount != '' )
{
$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(31, 10, '' ,0,0,'C',0); 
$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(36, 10, '' ,0,0,'C',0);


$pdf->Cell(31, 10, 'Discount' ,1,0,'C',1);

$pdf->Cell(32, 10, '$ '.number_format($coupon_discount,2) ,1,1,'C',1);


}


$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(31, 10, '' ,0,0,'C',0); 
$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(36, 10, '' ,0,0,'C',0);

$pdf->Cell(31, 10, 'Total' ,1,0,'C',1);

$tot = ($order_info['order_total'] + $order_info['delivery_fee']) - $coupon_discount;

$pdf->Cell(32, 10, '$ '.number_format($tot,2) ,1,1,'C',1);






if($order_info['order_status']==3){
    
$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(31, 10, '' ,0,0,'C',0); 
$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(36, 10, '' ,0,0,'C',0);

$pdf->Cell(31, 10, 'Amount Paid' ,1,0,'C',1);

$pdf->Cell(32, 10, '$ '.number_format($tot,2) ,1,1,'C',1);



$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(31, 10, '' ,0,0,'C',0); 
$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(36, 10, '' ,0,0,'C',0);

$pdf->Cell(31, 10, 'Balance Due' ,1,0,'C',1);

$pdf->Cell(32, 10, '$0.00' ,1,0,'C',1);

$pdf->Cell(189 ,10,'',0,1);


}
    

$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(31, 10, '' ,0,0,'C',0); 
$pdf->Cell(32, 10, '' ,0,0,'C',0); 
$pdf->Cell(36, 10, '' ,0,0,'C',0);
$gst =  number_format(($tot/11),2);

$pdf->Cell(31, 10, 'Incl GST' ,1,0,'C',1);

$pdf->Cell(32, 10, '$'.$gst ,1,0,'C',1);




$text = "Payment can be made by neft to BSB: 033 157  Account Number: 538 432 Account Name: Hoscat Pty Ltd\nPlease note payment terms are 7 days from invoice date\nPlease email remittance to : catering@zoukieastonline.com.au";    
  

$pdf->ImprovedTable($text);

$pdf->SetFont('Times','',9);


	$pdf->Output('I',$order_id.'.pdf');        
    
	}
	}else{
	    return false;
	
	}
	}
}
