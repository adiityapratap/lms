
<style>.borderless tr td, .borderless tr th {border: none;padding-top:0;padding-bottom:0;} </style>
<!-- header_End -->
<!-- Content_right -->
<div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
			<!-- Section -->
			<div class="container-fluid">
			    <div class="row"><div class="col-md-12">	<button onclick="printContent('<?php echo $order_info->order_id;?>','<?php echo $order_info->customer_id;?>')" class="btn" style="margin-left: 614px;background-color:black !important;border:1px solid black;float:right;"><font color="#fff">Download Invoice PDF </font></button>
</div></div>
				<div class="row">
					<!--Report widget start-->
					<div class="col-12">
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
														echo "<td>".$opo->option_quantity."</td>";
														echo "<td>".$opo->option_price_prefix." $".number_format((float)$opo->option_price,2,'.','')."</td>";
														echo "<td>".$opo->option_price_prefix." $".number_format($opo->option_quantity*(float)($opo->option_price_prefix.$opo->option_price),2,'.','')."</td>";
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
										<td>$<?php echo number_format($order_info->order_total,2);?></td>
									</tr>
									<tr>
										<td width="70%">&nbsp;</td>
										<td colspan="3" width="20%"><strong>Delivery Charges</strong></td>
										<td>$<?php echo number_format($order_info->delivery_fee,2);?></td>
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
											<td colspan="3" width="20%"><strong>Coupon Discount</strong></td>
											<td>$<?php echo number_format($coupon_discount,2);?></td>
										</tr>
										<?php } else $coupon_discount=0;?>
										<tr>
											<td width="70%">&nbsp;</td>
											<td colspan="3" width="20%"><strong>Total (Incl. GST)</strong></td>
											<td>$<?php echo number_format($order_info->order_total+$order_info->delivery_fee-$coupon_discount,2);?></td>
										</tr>
										<tr>
											<td width="70%">&nbsp;</td>
											<td colspan="3" width="20%"><strong>GST (10%)</td>
												<td>$<?php echo number_format(($order_info->order_total+$order_info->delivery_fee-$coupon_discount)/11,2);?></td>
											</tr>
											
										<?php if($order_info->order_status==1){?>
										<tr>
											<td width="70%">&nbsp;</td>
											<td colspan="3" width="20%"><strong>Amount Paid</strong></td>
											<td>$<?php echo number_format($order_info->order_total+$order_info->delivery_fee-$coupon_discount,2);?></td>
										</tr>
										<tr>
											<td width="70%">&nbsp;</td>
											<td colspan="3" width="20%"><strong>Balance Due</strong></td>
											<td>$0.00</td>
										</tr>
										<?php }?>
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
		</div>
		<script>
			function print_window(order_id)
			{
				window.open("<?php echo base_url();?>index.php/orders/print_order/"+order_id+"/"+<?php echo "'".$fingerprint."'";?>);
			}
			function printContent(order_id,cust_id){   
							    
			window.open("<?php echo base_url();?>index.php/orders/order_inv_download/"+order_id+"/"+ cust_id + "/"+ <?php echo "'".$fingerprint."'";?>);
				  
				    }
		</script>