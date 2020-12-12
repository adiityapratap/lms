
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
								<h3 class="card-title">Reports</h3>
							</div>
							<div class="card-body">
								<form action="<?php echo base_url();?>index.php/orders/generate_report" method="POST">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label text-right">Date From</label>
										<div class="col-sm-9">
											<input type="text" class="form-control datepicker" name="date_from">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label text-right">Date To</label>
										<div class="col-sm-9">
											<input type="text" class="form-control datepicker" name="date_to">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label text-right">Cost Centre</label>
										<div class="col-sm-9">
											<select class="form-control" name="cost_centre">
												<option value="0">All</option>
												<option value="1">No Cost Centre assigned</option>
												<option value="2">Custom:</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label text-right">Enter one or more cost centres, separated by commas: </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="cost_centre_list" placeholder="1234,5678-abcd-123">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label text-right">Company</label>
										<div class="col-sm-9">
											<select class="form-control" name="company">
												<option value="0" selected>All Companies</option>
												<?php if(!empty($companies)){
													foreach($companies as $company){
														echo "<option value=\"".$company->company_id."\">".$company->company_name."</option>";
													}
												}?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label text-right">Status</label>
										<div class="col-sm-9">
											<select class="form-control" name="status">
												<option value="0" selected>All Statuses</option>
												<option value="1">Paid</option>
												<option value="15">Outstanding</option>
												
											</select>
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label text-right"> Maroondah </label>
										<div class="col-sm-9">
											<input type="checkbox" name="marondah"/>
										</div>
									</div>
									
									<div class="form-group row d-flex justify-content-center">
										<button type="submit" class="btn btn-info">Generate <i class="fa fa-bar-chart"></i>
									</div>
								</form>
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
<script>
	$(function(){
		$(".datepicker").datetimepicker({
			format:'YYYY-MM-DD'
		})	
	})
</script>