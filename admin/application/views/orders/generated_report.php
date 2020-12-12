<style>
	.table-sm th, .table-sm td{
		font-size:0.9em;
		padding:5px;
	}
</style>
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
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Report</h3>
							</div>
							<div class="card-body">
								<table class="table table-sm table-striped table-responsive">
									<thead>
										<tr>
											<th>Order #</th>
											<th>Order Date</th>
											<th>Delivery Date</th>
											<th>Customer</th>
											<th>Department</th>
											<th>Company</th>
											<th>Cost Centre</th>
											<th>Phone</th>
											<th>Email</th>
											<th>Subtotal</th>
											<th>Discount</th>
											<th>Delivery</th>
											<th>Total</th>
											<th>GST</th>
											<th>Status</th>
											<th>Paid Comment</th>
											<th>Paid Date</th>
										</tr>
									</thead>
									<tbody>
										<?php if(empty($data)){
											echo "<tr><td colspan=\"14\">No results with current parameters. Please change parameters in previous page and try agaon.</td></tr>";
										}
										else{
											$subtotal=0.0;
											$delivery_total=0.0;
											$discount_total=0.0;
											$total=0.0;
											$gst_total=0.0;
											$csvStr="Order #,Order Date,Delivery Date,Customer,Company,Cost Centre,Phone,Email,Subtotal,Discount,Delivery,Total,GST,Status\n";
											$i=0;
											foreach($data as $row){
												echo "<tr class='".$i."'>";
												echo "<td>".$row->order_id."</td>";
												echo "<td>".date('d-m-Y',strtotime($row->date_added))."</td>";
												echo "<td>".date("d-m-Y",strtotime($row->delivery_date_time))."</td>";
												echo "<td>".$row->firstname." ".$row->lastname."</td>";
												echo "<td>".$row->department_name."</td>";
												echo "<td>".$row->company_name."</td>";
												echo "<td>".$row->cost_centre."</td>";
												echo "<td>";
												if(empty($row->delivery_phone))
												{
													echo $row->customer_telephone;
													$phone=$row->customer_telephone;
												}
												else 
												{
													echo $row->delivery_phone;
													$phone=$row->delivery_phone;
												}
												echo "</td>";
												echo "<td>";
												if(empty($row->delivery_email))
												{
													echo $row->customer_email;	
													$email=$row->customer_email;
												}
												else
												{
													echo $row->delivery_email;
													$email=$row->delivery_email;
												}
												echo "</td>";
												echo "<td>$".number_format($row->order_total,2)."</td>";
												echo "<td>";
												if(empty($row->coupon_id)){
													echo "$0.00";
													$discount=0;
												}
												else{
													if($row->type=='F'){
														$discount=$row->coupon_discount;
														echo "$".$row->coupon_discount;
													}
													else if($row->type=='P'){
														$discount=($row->order_total*$row->coupon_discount/100);
														echo "$".number_format(($row->order_total*$row->coupon_discount/100),2);
													}
												}
												echo "</td>";
												echo "<td>$".number_format($row->delivery_fee,2)."</td>";
												echo "<td>$".number_format($row->order_total-$discount+$row->delivery_fee,2)."</td>";
												echo "<td>$".number_format(($row->order_total-$discount+$row->delivery_fee)/11,2)."</td>";
												echo "<td>";
												if($row->order_status == 99){
												        
												    echo "Maroondah ";
												   
												    $status="Maroondah ";
												    } else if($row->order_status==1)
												{
													echo "Paid";
													$status="Paid";
												}
												
												else
												{
													echo "Outstanding";
													$status="Outstanding";
												}
												echo "</td>";
												echo "<td>";
												$f= preg_replace('/[&%$]+/', '-', $row->mark_paid_comment);
												    echo $f;
												    echo "</td>"; 
												    
												    if($row->order_status == 1){
												    echo "<td>";
												    echo $row->date_modified;;
												    echo "</td>"; 
												    }
												echo "</tr>";
												$subtotal+=$row->order_total;
												$discount_total+=$discount;
												$delivery_total+=$row->delivery_fee;
												$total+=($row->order_total-$discount+$row->delivery_fee);
												$gst_total+=($row->order_total-$discount+$row->delivery_fee)*0.1;
												$csvStr.="\"".$row->order_id."\",\"".date('d-m-Y',strtotime($row->date_added))."\",\"".date("d-m-Y",strtotime($row->date_added))."\",\"".$row->firstname." ".$row->lastname."\",\"".$row->company_name."\",\"".$row->cost_centre."\",\"".$phone."\",\"".$email."\",\"$".number_format($row->order_total,2)."\",\"$".$discount."\",\"$".number_format($row->delivery_fee,2)."\",\"$".number_format($row->order_total-$discount+$row->delivery_fee,2)."\",\"$".number_format(($row->order_total-$discount+$row->delivery_fee)*0.1,2)."\",\"".$status."\"\n";
										$i++;
										}
											echo "<thead><tr><th colspan=\"8\">&nbsp;</th><th>Total</th><th>$".number_format($subtotal,2)."</th><th>$".number_format($discount_total,2)."</th><th>$".number_format($delivery_total,2)."</th><th>$".number_format($total,2)."</th><th>$".number_format($gst_total,2)."</th><th>&nbsp;</th></tr></thead>";
											echo "<tr><td colspan=\"15\" class=\"text-center\"><form action=\"".base_url()."index.php/orders/get_report_csv\" method=\"POST\"><input type=\"hidden\" name=\"date_from\" value=\"".$params['date_from']."\"><input type=\"hidden\" name=\"date_to\" value=\"".$params['date_to']."\"><input type=\"hidden\" name=\"cost_centre\" value=\"".$params['cost_centre']."\"><input type=\"hidden\" name=\"cost_centre_list\" value=\"".$params['cost_centre_list']."\"><input type=\"hidden\" name=\"company\" value=\"".$params['company']."\"><input type=\"hidden\" name=\"status\" value=\"".$params['status']."\"><input type=\"hidden\" name=\"marondah\" value=\"".$params['marondah']."\"><button class=\"btn btn-info\" type=\"submit\">Download <i class=\"fa fa-download\"></i></button></form></td></tr>";
										}
										?>
									</tbody>
								</table>
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