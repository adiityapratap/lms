
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
								<p class="card-title">New Category</p>
							</div>
							<div class="card-body">
								<form action="<?php echo base_url();?>index.php/courses/add_new_course" method="POST" enctype="multipart/form-data"  onSubmit="return validate();">
								
									<div class="form-group row new_cat">
										<label class="col-sm-3 col-form-label">Category Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="course_name" placeholder="New Category Name">
										</div>
									</div>
									
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Custom Heading</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="course_custom_heading">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Short Description</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="textareaChars" name="course_short_description" placeholder="Short Description" maxlength="150"></textarea>
											 <span id="chars">150</span> characters remaining
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Description</label>
										<div class="col-sm-9">
											<textarea class="form-control" name="course_description" placeholder="Description"></textarea>
										</div>
									</div>
									
									<div class="form-group row new_cat">
										<label class="col-sm-3 col-form-label">Other Details</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="other_details" placeholder="Other Details">
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Image</label>
										<div class="col-sm-9">
											<input type="file" id="cat_img" class="form-control file-size" name="image">
											<span id="cat_img_err" style="color:#f00;"></span>
										</div>
									</div>
									
									<!--<div class="form-group row">-->
									<!--	<label class="col-sm-3 col-form-label">Header Image</label>-->
									<!--	<div class="col-sm-9">-->
									<!--		<input type="file" class="form-control" name="course_header_image">-->
									<!--	</div>-->
									<!--</div>-->
									
									<br>
								    <hr>
								    <br>
								    <div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Features</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="feature_1"><br>
											<input type="text" class="form-control" name="feature_2"><br>
											<input type="text" class="form-control" name="feature_3"><br>
											<input type="text" class="form-control" name="feature_4"><br>
											<input type="text" class="form-control" name="feature_5">
										</div>
									</div>
									<br>
								    <hr>
								    <br>
								    <div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Videos</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="video_url1"><br>
											<input type="text" class="form-control" name="video_url2"><br>
											<input type="text" class="form-control" name="video_url3"><br>
											<input type="text" class="form-control" name="video_url4"><br>
											<input type="text" class="form-control" name="video_url5">
										</div>
									</div>
								
									
									<div class="form-group row">
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-primary">Add Category</button>
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
					2020 © LMS
				</p>
			</div>
			<a id="back-to-top" href="#"> <i class="ion-android-arrow-up"></i> </a>
		</div>
	</div>
</footer>
<!-- Footer_End -->
</div>
<script>
 var maxLength = 150;
$('textarea').keyup(function() {
  var length = $(this).val().length;
  var length = maxLength-length;
  $('#chars').text(length);
});
</script>
<script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> 
    </script> 
<script>
$('#cat_img').on('change', function() { 
            if (this.files[0].size > 2097152) { 
                //alert("Try to upload file less than 2MB!"); 
				 $('#cat_img_err').html("Try to upload file less than 2MB!"); 
				 $(this).val('');
            } 
			else{
				  $('#cat_img_err').html("");
			}
        });
</script>

