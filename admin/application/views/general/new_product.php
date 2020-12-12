
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
								<p class="card-title">New Product</p>
							</div>
							<div class="card-body">
								<form action="<?php echo base_url();?>index.php/general/add_new_product" method="POST">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Product Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="product_name" placeholder="New Product" required>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Product Price</label>
										<div class="col-sm-9">
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="text" class="form-control" name="amount" required>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category</label>
										<div class="col-sm-9">
											<select class="form-control" name="product_category" id="category">
												<?php if(!empty($categories)){
													foreach($categories as $cat){
														echo "<option value=\"".$cat->sub_sub_cat_id."\">".ucwords($cat->sub_sub_cat_name)."</option>";
													}
												}?>
												<option value="0">Create New Category</option>
											</select>
										</div>
									</div>
									<div class="form-group row new_cat">
										<label class="col-sm-3 col-form-label">Sub Category Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="category_name" placeholder="New Category Name">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Product Description</label>
										<div class="col-sm-9">
											<textarea class="form-control" name="product_description" placeholder="Description"></textarea>
										</div>
									</div>
								
									<div class="form-group row">
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-primary">Add Product</button>
										</div>
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
	$(".new_cat").hide();
	$("#category").on('change',function(){
		if($("#category option:selected").val()==0){
			$(".new_cat").show();
		}
		else $(".new_cat").hide();
	})
})
</script>