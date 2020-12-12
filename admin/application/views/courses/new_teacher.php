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
								<p class="card-title">New Teacher</p>
							</div>
							<div class="card-body">
								<form action="<?php echo base_url();?>index.php/courses/add_new_teacher/" method="POST" enctype="multipart/form-data">
								
                                    <div class="form-group row">
										<label class="col-sm-3 col-form-label">Teacher Username</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="teacher_username" value="" >
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Teacher First Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="teacher_first_name" value="" >
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Teacher Last Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="teacher_last_name" value="" >
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Teacher Email</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="teacher_email" value="" >
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Contact</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="teacher_contact" value="" >
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Course</label>
										<div class="col-sm-9">
											<select class="form-control" name="course" id="course">
												<?php if(!empty($courses)){
												    
												 
													foreach($courses as $course){
													echo "<option value=\"".$course->course_id."\">".ucwords($course->course_name)."</option>";
													}
												}?>
											
											</select>
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" name="password" value="" >
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Confirm Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" name="confirm_password" value="" >
										</div>
									</div>
								
								<div class="form-group row">
										<label class="col-sm-3 col-form-label">Teacher Image</label>
										<div class="col-sm-9">
											<input type="file" id="teacher_img" class="form-control" name="image">
											<span id="teacher_img_err" style="color:#f00;"></span>
										</div>
									</div>
									
									<div class="form-group row">
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-primary">Add Teacher</button>
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
<script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> 
    </script> 
<script>
$('#teacher_img').on('change', function() { 
            if (this.files[0].size > 2097152) { 
                //alert("Try to upload file less than 2MB!"); 
				 $('#teacher_img_err').html("Try to upload file less than 2MB!"); 
				 $(this).val('');
            } 
			else{
				 $('#teacher_img_err').html("");
			}
});
</script>