<style>
	.table tr,.table td,.table th{
		padding:5px;
		font-size:0.96em;
	}
</style>
<?php $referrer=explode("/",$_SERVER['PATH_INFO'])[2];?>
<!-- header_End -->
<!-- Content_right -->
<div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">

			<!-- Section -->
			<div class="container-fluid">
				<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card card-shadow mb-4">
							<div class="card-header">
								<h3 class="card-title">Filters</h3>
							</div>
							<div class="card-body">
								<form id="order_filters">
									<div class="row">
										<div class="col-12 col-md-2">
											<input class="form-control datepicker" id="date_from" type="text" placeholder="Date From">
										</div>
										<div class="col-12 col-md-2">
											<input class="form-control datepicker" id="date_to" type="text" placeholder="Date To">
										</div>
										<div class="col-12 col-md-4">
											<select class="form-control" id="company">
												<option value="0" selected>All Companies</option>
												<?php if(!empty($companies)){
													foreach($companies as $company){
														echo "<option value=\"".$company->company_id."\">".$company->company_name."</option>";
													}
												}?>
											</select>
										</div>
										<div class="col-12 col-md-4">
											<select class="form-control" id="customer">
												<option value="0" selected>All Customers</option>
												<?php if(!empty($customers)){
													foreach($customers as $customer){
														echo "<option value=\"".$customer->customer_id."\">".$customer->firstname." ".$customer->lastname."</option>";
													}
												}?>
											</select>
										</div>
										<div class="col-12 col-md-2">
											<input class="form-control " id="order_id" type="text" placeholder="Order Id">
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-12"><p><strong>Sort By:</strong></p></div>
									</div>
									<div class="row">
										<div class="col-auto">
											<label class="control control-solid control--radio control-solid-info">Delivery Date (Ascending)
												<input type="radio" name="sort_order" checked="checked" value="0">
												<span class="control__indicator"></span>
											</label>
										</div>
										<div class="col-auto">
											<label class="control control-solid control--radio control-solid-info">Delivery Date (Descending)
												<input type="radio" name="sort_order" value="1">
												<span class="control__indicator"></span>
											</label>
										</div>
										<div class="col-auto">
											<label class="control control-solid control--radio control-solid-info">Order # (Ascending)
												<input type="radio" name="sort_order" value="2">
												<span class="control__indicator"></span>
											</label>
										</div>
										<div class="col-auto">
											<label class="control control-solid control--radio control-solid-info">Order # (Descending)
												<input type="radio" name="sort_order" value="3">
												<span class="control__indicator"></span>
											</label>
										</div>
										<div class="col-auto">
											<div class="col-12 col-md-1">
												<button class="btn btn-primary">Go</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="card card-shadow mb-4">
							<div class="card-body">
								<div class="table-responsive">
									<ul class="nav nav-pills nav-pills-info mb-4 mt-3 ml-3"  id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="unpaid-tab" data-toggle="tab" href="#unpaid" role="tab" aria-controls="unpaid" aria-selected="true">Outstanding Orders</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="paid-tab" data-toggle="tab" href="#paid" role="tab" aria-controls="paid" aria-selected="false">Paid Orders</a>
										</li>
									</ul>
									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="unpaid" role="tabpanel" aria-labelledby="unpaid-tab">
											<table class="table table-sm table-bordered">
												<thead>
													<tr>
														<th><label class="control control-solid control-solid-info control--checkbox mb-4" style="display:inline;"><input type="checkbox" id="check_all_unpaid"><span class="control__indicator"></span></label><button class="btn btn-info btn-sm" onclick="download_running_unpaid()"><i class="fa fa-download"></i></button><button class="btn btn-info btn-sm" onclick="download_running_unpaid('mark_paid')">MP</button></th>
														<th>Order #</th>
														<th>Customer</th>
														<th>Cost Centre</th>
														<th>Company</th>
														<th>Delivery Date &amp; Time</th>
														<th>Balance</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php if(!empty($orders)){
														foreach($orders as $order)
														{
															if($order->order_status==15)
															{
																echo "<tr>";
																echo "<td><label class=\"control control-solid control-solid-info control--checkbox\"><input type=\"checkbox\" class=\"running_sheet_check_unpaid\" id=\"order_".$order->order_id."\"><span class=\"control__indicator\"></span></label></td>";
																echo "<td>".$order->order_id."</td>";
																echo "<td>".$order->firstname." ".$order->lastname."</td>";
																echo "<td>".$order->cost_centre."</td>";
																echo "<td>".$order->company_name."</td>";
																echo "<td>".date("h:i A, d M Y",strtotime($order->delivery_date_time))."</td>";
																if($order->order_status==15){
																	if(empty($order->coupon_id))
																		echo "<td>$".number_format($order->order_total+$order->delivery_fee,2)."</td>";
																	else{
																		if($order->type=='F')
																			$discount=$order->coupon_discount;
																		else $discount=$order->order_total*$order->coupon_discount*0.01;
																		echo "<td>$".number_format($order->order_total+$order->delivery_fee-$discount,2)."</td>";
																	}
																}
																else echo "<td>$0.00</td>";
																if($order->order_status == 99){
											    echo "<td>Outstanding</td>";
											}else{
											    	echo $order->order_status==15?"<td>Outstanding</td>":"<td>Paid</td>";
											    
											}
																echo "<td>";
																echo "<a href=\"".base_url()."index.php/orders/view_order/".$order->order_id."\" class=\"btn btn-info btn-sm\">View</a>";
															echo "<button class=\"btn btn-danger btn-sm ml-1\" onclick=\"delete_order('".$order->order_id."','".$referrer."','".$orders_identity."')\">Cancel</button>";

																
																if($order->order_status==15){
																	echo "<a href=\"".base_url()."index.php/orders/edit_order/".$order->order_id."\" class=\"btn btn-primary btn-sm ml-1\">Edit</a>";
																	
																	$amt=number_format($order->order_total+$order->delivery_fee-$discount,2)*100;
																	?>
																	<form action="https://payment.securepay.com.au/secureframe/invoice" method="POST" style="display:inline">
																		<input type="hidden" name="bill_name" value="transact">
																		<input type="hidden" name="merchant_id" value="2Q40231">
																		<input type="hidden" name="txn_type" value="0">
																		<input type="hidden" name="amount" value="<?php echo (int)($amt);?>">
												<input type="hidden" name="card_types" value="VISA|MASTERCARD|AMEX">
																		<input type="hidden" name="primary_ref" value="<?php echo $order->order_id;?>">
																		<input type="hidden" name="fp_timestamp" value="<?php echo gmdate("YmdHis");?>">
																		<input type="hidden" name="fingerprint" value="<?php echo sha1("2Q40231|Roberta123|0|".$order->order_id."|".(int)($amt)."|".gmdate("YmdHis"));?>">
																		<input type="hidden" name="return_url" value="<?php echo base_url();?>index.php/orders/payment_process">
																		<input type="hidden" name="return_url_text" value="Continue">
																		<button class="btn btn-success btn-sm" type="submit">Payment</button>
																	</form>
																	<?php
echo "<button class=\"btn btn-danger btn-sm ml-1\" onclick=\"mark_paid_trigger('".$order->order_id."','".$referrer."')\">Mark Paid</button>";																}
																if($order->standing_order==1){
																	echo "<button class=\"btn btn-dark btn-sm ml-1\" onclick=\"reorder('".$order->order_id."')\">Reorder</button>";
																}
																echo "</td>";
																echo "</tr>";	
															}
														}
													}?>
												</tbody>
											</table>
										</div>
										<div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
											<table class="table table-sm table-bordered">
												<thead>
													<tr>
														<th><label class="control control-solid control-solid-info control--checkbox mb-4" style="display:inline;"><input type="checkbox" id="check_all_paid"><span class="control__indicator"></span></label><button class="btn btn-info btn-sm" onclick="download_running_paid()"><i class="fa fa-download"></i></button></th>
														<th>Order #</th>
														<th>Customer</th>
														<th>Cost Centre</th>
														<th>Company</th>
														<th>Delivery Date &amp; Time</th>
														<th>Balance</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php if(!empty($orders)){
														foreach($orders as $order)
														{
															if($order->order_status!=15)
															{
																echo "<tr>";
																echo "<td><label class=\"control control-solid control-solid-info control--checkbox\"><input type=\"checkbox\" class=\"running_sheet_check_paid\" id=\"order_".$order->order_id."\"><span class=\"control__indicator\"></span></label></td>";
																echo "<td>".$order->order_id."</td>";
																echo "<td>".$order->firstname." ".$order->lastname."</td>";
																echo "<td>".$order->cost_centre."</td>";
																echo "<td>".$order->company_name."</td>";
																echo "<td>".date("h:i A, d M Y",strtotime($order->delivery_date_time))."</td>";
																if($order->order_status==15){
																	if(empty($order->coupon_id))
																		echo "<td>$".number_format($order->order_total+$order->delivery_fee,2)."</td>";
																	else{
																		if($order->type=='F')
																			$discount=$order->coupon_discount;
																		else $discount=$order->order_total*$order->coupon_discount*0.01;
																		echo "<td>$".number_format($order->order_total+$order->delivery_fee-$discount,2)."</td>";
																	}
																}
																else echo "<td>$0.00</td>";
																echo $order->order_status==15?"<td>Outstanding</td>":"<td>Paid</td>";
																echo "<td>";
																echo "<a href=\"".base_url()."index.php/orders/view_order/".$order->order_id."\" class=\"btn btn-info btn-sm\">View</a>";
																
															echo "<button class=\"btn btn-danger btn-sm ml-1\" onclick=\"delete_order('".$order->order_id."','".$referrer."')\">Cancel</button>";

																if($order->order_status==15){
																	echo "<a href=\"".base_url()."index.php/orders/edit_order/".$order->order_id."\" class=\"btn btn-primary btn-sm ml-1\">Edit</a>";
																	?>
																	<form action="https://payment.securepay.com.au/secureframe/invoice" method="POST" style="display:inline">
																		<input type="hidden" name="bill_name" value="transact">
																		<input type="hidden" name="merchant_id" value="2Q40231">
																		<input type="hidden" name="txn_type" value="0">
																		<input type="hidden" name="amount" value="<?php echo (int)($order->order_total*100);?>">
																		<input type="hidden" name="primary_ref" value="<?php echo $order->order_id;?>">
																		<input type="hidden" name="fp_timestamp" value="<?php echo gmdate("YmdHis");?>">
																		<input type="hidden" name="fingerprint" value="<?php echo sha1("2Q40231|Roberta123|0|".$order->order_id."|".(int)($order->order_total*100)."|".gmdate("YmdHis"));?>">
																		<input type="hidden" name="return_url" value="<?php echo base_url();?>index.php/orders/payment_process">
																		<input type="hidden" name="return_url_text" value="Continue">
																		<button class="btn btn-success btn-sm" type="submit">Payment</button>
																	</form>
																	<?php
echo "<button class=\"btn btn-danger btn-sm ml-1\" onclick=\"mark_paid_trigger('".$order->order_id."','".$referrer."')\">Mark Paid</button>";
}
																if($order->standing_order==1){
																	echo "<button class=\"btn btn-dark btn-sm ml-1\" onclick=\"reorder('".$order->order_id."')\">Reorder</button>";
																}
																echo "</td>";
																echo "</tr>";	
															}
														}
													}?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Report widget end-->
				</div>
			</div>
			<!-- Section_End -->
		</div>
	</div>
</div>
<!-- Content_right_End -->
<!-- Footer -->
<footer class="footer ptb-20">
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="copy_right">
				<p>
					2018 © Zouki East
				</p>
			</div>
			<a id="back-to-top" href="#"> <i class="ion-android-arrow-up"></i> </a>
		</div>
	</div>
</footer>
<!-- Footer_End -->
</div>
<div class="modal fade" id="delete_order_modal" tabindex="-1" role="dialog" aria-labelledby="delete_order_title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="delete_order_title">Are you sure, You want to delete this order</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url();?>index.php/orders/delete_order" method="POST" id="delete_order_form">
					<input type="hidden" name="order_id" id="delete_order_id">
					<input type="hidden" name="referrer" id="delete_order_referrer">
				
					
					<div class="row mt-2">
						<div class='col-12'>
							<button type="submit" class="btn btn-info">Delete</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="mark_paid_modal" tabindex="-1" role="dialog" aria-labelledby="mark_paid_title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mark_paid_title">Mark Paid Comments</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url();?>index.php/orders/mark_as_paid" method="POST" id="mark_paid_form">
					<input type="hidden" name="order_id" id="mark_paid_id">
					<input type="hidden" name="referrer" id="mark_paid_referrer">
				
					
					<div class="row">
						<div class="col-12">
							<label>Comments</label>
							<textarea class="form-control" name="mark_paid_comments"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class='col-12'>
							<button type="submit" class="btn btn-info">Mark Paid</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="reorder_modal" tabindex="-1" role="dialog" aria-labelledby="reorder_title" aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="reorder_title">Delivery date and time</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="<?php echo base_url();?>index.php/orders/reorder" method="POST" id="reorder_form">
				<input type="hidden" name="order_id" id="reorder_id">
				<div class="row">
					<div class="col-12">
						<label>Delivery Date</label>
						<input type="text" class="form-control datepicker" name="delivery_date" required>
					</div>
					<div class="col-12 mt-3">
						<label>Delivery Time</label>
						<input type="text" class="form-control timepicker" name="delivery_time" required>
					</div>
				</div>
				<div class="row mt-2">
					<div class='col-12'>
						<button type="submit" class="btn btn-info">Proceed</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="group_mark_paid_modal" tabindex="-1" role="dialog" aria-labelledby="mark_paid_title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mark_paid_title">Mark Paid Comments</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form   id="mark_paid_form">
				
					
					<div class="row">
						<div class="col-12">
							<label>Comments</label>
							<textarea id="group_mark_paid_comments" class="form-control" name="mark_paid_comments"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class='col-12'>
							<button type="submit" class="btn btn-info" onclick="group_mark_paid()">Mark Paid</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$(".datepicker").datetimepicker({
		format:'YYYY-MM-DD'
	})
	$(".timepicker").datetimepicker({
		format:'hh:mm a'
	})
	$("#order_filters").on('submit',function(e){
		e.preventDefault();
		if($.trim($("#date_from").val())=='')
			date_from='unset';
		else date_from=$("#date_from").val();
		if($.trim($("#date_to").val())=='')
			date_to='unset';
		else date_to=$("#date_to").val();
		if($.trim($("#cost_centre").val())=='')
			cost_centre='unset';
		else cost_centre=$("#cost_centre").val();
		if($.trim($("#order_id").val())=='')
			order_id='unset';
		else order_id=$("#order_id").val();
		sort_order=$("[name='sort_order']:checked").val();
		window.location.href="<?php echo base_url();?>index.php/orders/past_orders/"+date_from+"/"+date_to+"/"+$("#company").val()+"/"+$("#customer").val()+"/"+sort_order+"/"+order_id;
	})
	$("#check_all_paid").on('change',function(e){
		if($("#check_all_paid").is(":checked")){
			$(".running_sheet_check_paid").prop('checked',true);
		}
		else{
			$(".running_sheet_check_paid").prop('checked',false);
		}
	})
	$("#check_all_unpaid").on('change',function(e){
		if($("#check_all_unpaid").is(":checked")){
			$(".running_sheet_check_unpaid").prop('checked',true);
		}
		else{
			$(".running_sheet_check_unpaid").prop('checked',false);
		}
	})
})

function group_mark_paid(){
    
   comment = $("#group_mark_paid_comments").val();
    var running_sheet=[];
    
      $(".running_sheet_check_unpaid").each(function(){
	      
		if($(this).is(':checked')){
			running_sheet.push($(this).prop('id'));
		}
	})
	 
	 	running_sheet=running_sheet.join('.');
	 	
	 
	    
       window.open('<?php echo base_url();?>index.php/orders/group_mark_as_paid/'+running_sheet+'/'+comment);
    
}

function download_running_paid()
{
	var running_sheet=[];
	$(".running_sheet_check_paid").each(function(){
		if($(this).is(':checked')){
			running_sheet.push($(this).prop('id').split('_')[1]);
		}
	})
	running_sheet=running_sheet.join('.');
	window.open('<?php echo base_url();?>index.php/orders/running_sheet/'+running_sheet);
}
function download_running_unpaid(name)
{
	var running_sheet=[];
	
	if(name=="mark_paid"){
	    
          $("#group_mark_paid_modal").modal('show');
	    
	  
    }else{
	$(".running_sheet_check_unpaid").each(function(){
		if($(this).is(':checked')){
			running_sheet.push($(this).prop('id').split('_')[1]);
		}
	})
	running_sheet=running_sheet.join('.');
	window.open('<?php echo base_url();?>index.php/orders/running_sheet/'+running_sheet);
}
}
function reorder(order_id){
	$("#reorder_id").val(order_id);
	$("#reorder_modal").modal('show');
}

function delete_order(order_id,referrer){
			$("#delete_order_id").val(order_id);
			$("#delete_order_referrer").val(referrer);
		
			$("#delete_order_modal").modal('show');
		}
		
			function mark_paid_trigger(order_id,referrer){
			$("#mark_paid_id").val(order_id);
			$("#mark_paid_referrer").val(referrer);
		
			$("#mark_paid_modal").modal('show');
		}
</script>