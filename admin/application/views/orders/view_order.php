><style>.borderless tr td, .borderless tr th {border: none;padding-top:0;padding-bottom:0;} </style>
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
								<p class="card-title">Actions</p>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<button class="btn btn-info" onclick="print_window(<?php echo $order_info->order_id;?>)">Print <i class="fa fa-print"></i></button>
										<button class="btn btn-info" onclick="open_modal()">Email <i class="fa fa-send"></i></button>
										<?php 
										if($order_info->order_status==15){
											if(!is_null($order_info->coupon_id)){
												if($order_info->type=='F')
													$coupon_discount=$order_info->coupon_discount;
												else{
													$total_so_far=$order_info->order_total+$order_info->delivery_fee;
													$coupon_discount=($order_info->coupon_discount*($order_info->order_total+$order_info->delivery_fee))/100;
												}
											}
											else $coupon_discount=0;
											$amt=number_format($order_info->order_total+$order_info->delivery_fee-$coupon_discount,2,'.','')*100;?>

											<form action="https://payment.securepay.com.au/secureframe/invoice" method="POST" style="display:inline">
												<input type="hidden" name="bill_name" value="transact">
												<input type="hidden" name="merchant_id" value="2Q40231">
												<input type="hidden" name="txn_type" value="0">
												<input type="hidden" name="amount" value="<?php echo (int)($amt);?>">
												<input type="hidden" name="primary_ref" value="<?php echo $order_info->order_id;?>">
												<input type="hidden" name="fp_timestamp" value="<?php echo gmdate("YmdHis");?>">
												<input type="hidden" name="card_types" value="VISA|MASTERCARD|AMEX">
												<input type="hidden" name="fingerprint" value="<?php echo sha1("2Q40231|Roberta123|0|".$order_info->order_id."|".(int)($amt)."|".gmdate("YmdHis"));?>">
												<input type="hidden" name="return_url" value="<?php echo base_url();?>index.php/orders/payment_process">
												<input type="hidden" name="return_url_text" value="Continue">
												<button class="btn btn-info" type="submit">Payment <i class="fa fa-credit-card"></i></button>
											</form>
											<?php }?>
												<button class="btn btn-warning" onclick="open_modal_link()">Send Payment Link <i class="fa fa-send"></i></button>
										</div>
									</div>
								</div>
							</div>
							<div class="card card-shadow mb-4">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th colspan="4" class="text-center bg-success text-light"><?php if($order_info->order_status==15) echo "Tax Invoice";else echo "Tax Invoice";?></th>
										</tr>
									</thead>
									<tr>
										<td colspan="2" width="50%">
											<strong class="mr-2">Invoice No: </strong>#<?php echo $order_info->order_id;?><br>
											<strong class="mr-2">Delivery: </strong><?php echo date("h:i A, d M Y",strtotime($order_info->delivery_date_time));?>
										</td>
										<td colspan="2" width="50%">
											<strong class="mr-2">Name: </strong><?php echo $order_info->firstname." ".$order_info->lastname;?><br>
											<strong class="mr-2">Email: </strong><?php echo $order_info->customer_email;?><br>
											<strong class="mr-2">Phone: </strong><?php echo $order_info->customer_telephone;?><br><hr>
											<strong class="mr-2">Delivery Notes: </strong><?php echo nl2br($order_info->pickup_delivery_notes);?><br>
											<strong class="mr-2">Cost Centre: </strong><?php echo $order_info->cost_centre;?><br>
											<strong class="mr-2">Shipping Method: </strong><?php echo $order_info->shipping_method==1?"Delivery":"Pickup";?>
										</td>
									</tr>
									<thead>
										<tr>
											<th colspan="2" width="50%">Company Information</th>
											<th colspan="2" width="50%">Delivery/Pickup Location</th>
										</tr>
									</thead>
									<tr>
										<td colspan="2">
										    <?php if(isset($order_info->customer_company_name) && $order_info->customer_company_name !='') { ?>
											<?php echo $order_info->customer_company_name; ?><br>
											<?php echo $order_info->department_name;?><br>
											<?php echo $order_info->customer_company_addr;?>
											<?php }else { ?>
											
											<?php echo $order_info->company_name; ?><br>
											<?php echo $order_info->department_name;?><br>
											<?php echo $order_info->company_address;?>
											<?php }  ?>
										
										</td>
										<td colspan="2">
											<?php echo $order_info->firstname." ".$order_info->lastname;?><br>
											<?php echo $order_info->company_name;?><br>
											<?php if(is_null($order_info->delivery_address)) echo $order_info->company_address; else echo $order_info->delivery_address;?><br>
											<?php if(!is_null($order_info->delivery_phone)) echo "<i class=\"fa fa-phone\"></i> ".$order_info->delivery_phone;?>
										</td>
									</tr>
								</table>
								<table class="table table-bordered table-sm">
									<thead>
										<tr class="bg-success text-light">
											<th>Product Name</th>
											<th>Product Comment</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>Total</th>
										</tr>
									</thead>
									<?php if(!empty($order_products)){
									    
									   
									    
										foreach($order_products as $product){
											$product=(array)$product;
											echo "<tr>";
											echo "<td width=\"50%\">".$product['product_name']."<br>";
											echo "<ul>";
											for($i=1;$i<=5;$i++){
												if(!empty($product['product_desc_'.$i])){
													echo "<li>".$product['product_desc_'.$i]."</li>";
												}
											}
											echo "</ul>";
											
											echo "</td>";
											echo "<td width=\"20%\">".$product['order_product_comment']."</td>";
											echo "<td width=\"10%\">".$product['quantity']."</td>";
											echo "<td width=\"10%\">$".number_format($product['price'],2,'.','')."</td>";
											echo "<td width=\"10%\">$".number_format($product['total'],2,'.','')."</td>";
											echo "</tr>";
											if(!empty($order_product_options)){
												foreach($order_product_options as $opo){
													if($product['order_product_id']==$opo->order_product_id){
														echo "<tr>";
														echo "<td>Option: ".$opo->name."</td>";
															echo "<td></td>";
														echo "<td>".$opo->option_quantity."</td>";
														echo "<td> $".number_format((float)$opo->option_price,2,'.','')."</td>";
														echo "<td> $".number_format($opo->option_quantity*(float)($opo->option_price),2,'.','')."</td>";
														echo "</tr>";
													}
												}
											}
										}
									}?>
									<thead>
										<tr class="bg-success text-light">
										<th colspan="5">Comments</th>
										</tr>
									</thead>
									<tr>
										<td colspan="5"><?php echo trim($order_info->order_comments)==''?"&nbsp;":nl2br($order_info->order_comments);?></td>
									</tr>
									<tr>
										<td width="70%">&nbsp;</td>
											<td colspan="3" width="20%"><strong>Subtotal (Incl. GST)</strong></td>
										<td>$<?php echo number_format($order_info->order_total,2,'.','');?></td>
									</tr>
									<tr>
										<td width="70%">&nbsp;</td>
										<td colspan="3" width="30%"><strong>Delivery Charges</strong></td>
										<td>$<?php echo number_format($order_info->delivery_fee,2,'.','');?></td>
									</tr>
									<?php if(!is_null($order_info->coupon_id)){
										if($order_info->type=='F')
											$coupon_discount=$order_info->coupon_discount;
										else{
											$total_so_far=$order_info->order_total+$order_info->delivery_fee;
											$coupon_discount=($order_info->coupon_discount*($order_info->order_total+$order_info->delivery_fee))/100;
										}
										?>
										<tr>
											<td width="70%">&nbsp;</td>
											<td colspan="3" width="30%"><strong>Coupon Discount</strong></td>
											<td>$<?php echo number_format($coupon_discount,2,'.','');?></td>
										</tr>
										<?php } else $coupon_discount=0;?>
										<tr>
											<td width="70%">&nbsp;</td>
											<td colspan="3" width="30%"><strong>Total (Incl. GST)</strong></td>
											<td>$<?php echo number_format($order_info->order_total+$order_info->delivery_fee-$coupon_discount,2,'.','');?></td>
										</tr>
										<tr>
											<td width="70%">&nbsp;</td>
											<td colspan="3" width="30%"><strong>GST (10%)</strong></td>
											<td>$<?php echo number_format(($order_info->order_total+$order_info->delivery_fee-$coupon_discount)/11,2,'.','');?></td>
										</tr>
										<?php  if($order_info->order_status==1 || $order_info->order_status== 3){ ?>
										<tr>
											<td width="70%">&nbsp;</td>
											<td colspan="3" width="30%"><strong>Amount Paid</strong></td>
											<td>$<?php echo number_format($order_info->order_total+$order_info->delivery_fee-$coupon_discount,2,'.','');?></td>
										</tr>
										<tr>
											<td width="70%">&nbsp;</td>
											<td colspan="3" width="30%"><strong>Balance Due</strong></td>
											<td>$0.00</td>
										</tr>
										<?php } ?>
									</table>
									<table class="table table-sm mt-3">
										<tr class="bg-success text-light">
											<td width="50%">
												<table class="table table-sm borderless bg-success">
													<tr>
														<td class="text-right"><strong>Account Name:</strong></td>
														<td>Hoscat Pty Ltd</td>
													</tr>
													<tr>
														<td class="text-right"><strong>BSB:</strong></td>
														<td>033 157</td>
													</tr>
													<tr>
														<td class="text-right"><strong>Account Number:</strong></td>
														<td>538 432</td>
													</tr>
													<tr>
														<td class="text-right"><strong>Reference:</strong></td>
														<td>&lt;Company Name&gt; &lt;Invoice No&gt;</td>
													</tr>
													<tr>
														<td class="text-right"><strong>Payment Terms:</strong></td>
														<td>Please Pay within 7 days</td>
													</tr>
												</table>
											</td>
											<td>
												<strong>Zouki East</strong> <br>Hoscat Pty Ltd<br><strong>ABN: </strong>63 603 953 000
											</td>
										</tr>
									</table>
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
	<div class="modal fade" id="email_modal" tabindex="-1" role="dialog" aria-labelledby="email_modal_title">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="email_modal_title">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-auto">
							Please enter the email ID to send to:
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<input type="email" class="form-control" id="email"><div class="invalid-feedback">Please enter an email address!</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Close
					</button>
					<button type="button" onclick="send_mail()" class="btn btn-primary">
						Send Mail
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="payment_link" tabindex="-1" role="dialog" aria-labelledby="email_modal_title" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="email_modal_title">Send payment link</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-auto">
							Please enter the email ID to send to:
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<input type="email" class="form-control" id="email_payment"><div class="invalid-feedback">Please enter an email address!</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Close
					</button>
					<button type="button" onclick="send_link()" class="btn btn-primary">
						Send Mail
					</button>
				</div>
			</div>
		</div>
	</div>
	<script>
	
	function open_modal_link()
		{
			$("#payment_link").modal('show');
		}
		
		function send_link()
		{
			$("#email_payment").removeClass('is-invalid');
			if($.trim($("#email_payment").val())=='')
			{
				$("#email_payment").addClass('is-invalid');
				return 0;
			}
			$.ajax({
				url:'<?php echo base_url();?>index.php/orders/send_link/<?php echo $order_info->order_id;?>/<?php echo str_replace(',','',number_format($order_info->order_total+$order_info->delivery_fee-$coupon_discount,2));?>',
				method:"POST",
				data:{"email_payment":$("#email_payment").val()},
				success:function(data){
					console.log(data);
					$("#payment_link").modal('hide');
				}
			})
		}
		
		function print_window(order_id)
		{
			window.open("<?php echo base_url();?>index.php/orders/print_order/"+order_id+"/"+<?php echo "'".$fingerprint."'";?>);
		}
		function open_modal()
		{
			$("#email_modal").modal('show');
		}
		function send_mail()
		{
			$("#email").removeClass('is-invalid');
			if($.trim($("#email").val())=='')
			{
				$("#email").addClass('is-invalid');
				return 0;
			}
			$.ajax({
				url:'<?php echo base_url();?>index.php/orders/send_email/<?php echo $order_info->order_id;?>/<?php echo $fingerprint;?>',
				method:"POST",
				data:{"email":$("#email").val()},
				success:function(data){
					console.log(data);
					$("#email_modal").modal('hide');
				}
			})
		}
		</script>