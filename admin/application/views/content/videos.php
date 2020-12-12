<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
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
								<p class="card-title">Video URLs</p>
							</div>
							<div class="card-body">
								<form action="<?php echo base_url();?>index.php/content/update_video_content/" method="POST" enctype="multipart/form-data">
								
<br>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Video Url For Slider</label>
										<div class="col-sm-9">
										    
										     
											<input type="text" class="form-control" name="video_url1" value="<?php echo $video_content_slider[0]->video_url1 ;?>" ><br>
											<input type="text" class="form-control" name="video_url2" value="<?php echo $video_content_slider[0]->video_url2 ;?>" ><br>
											<input type="text" class="form-control" name="video_url3" value="<?php echo $video_content_slider[0]->video_url3 ;?>" ><br>
											<input type="text" class="form-control" name="video_url4" value="<?php echo $video_content_slider[0]->video_url4 ;?>" ><br>
											<input type="text" class="form-control" name="video_url5" value="<?php echo $video_content_slider[0]->video_url5 ;?>" ><br>
											
											   
										</div>
									</div><hr>
									<br>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Why choose us</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="why_choose_us" value="<?php echo $video_content[0]->video_url1 ;?>" >
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</div>
							</div>
						</div>
					</div>
				
					</form>
					
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
					2020 © LMS
				</p>
			</div>
			<a id="back-to-top" href="#"> <i class="ion-android-arrow-up"></i> </a>
		</div>
	</div>
</footer>
<!-- Footer_End -->
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script>
			$(document).ready(function() {
				$("#txtEditor").Editor();
			});
		</script>