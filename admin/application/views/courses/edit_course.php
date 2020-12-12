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
								<p class="card-title">Edit Category</p>
							</div>
							<div class="card-body">
								<form action="<?php echo base_url();?>index.php/courses/update_course/<?php echo $courses[0]->course_id ;?>" method="POST" enctype="multipart/form-data">
								

									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="course_name" value="<?php echo $courses[0]->course_name ;?>" >
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Custom Heading</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="course_custom_heading" value="<?php echo $courses[0]->course_custom_heading ;?>" >
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Short Description</label>
										<div class="col-sm-9">
																				
											<textarea class="form-control" id="textareaChars" name="course_short_description" placeholder="Short Description" maxlength="150"><?php echo $courses[0]->course_short_description; ?></textarea>
											 <span id="chars">150</span> characters remaining
											
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Description</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="txtEditor" name="course_description" placeholder="Description"><?php echo $courses[0]->course_description; ?></textarea>
										</div>
									</div>
									<div class="form-group row new_cat">
										<label class="col-sm-3 col-form-label">Other Details</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="other_details" placeholder="Other Details" value="<?php echo $courses[0]->other_details; ?>">
										</div>
									</div>
										
									<!--<div class="form-group row">-->
									<!--	<label class="col-sm-3 col-form-label">Assign Teacher</label>-->
									<!--	<div class="col-sm-9">-->
											<!--<select class="form-control" name="teacher_assign" id="teacher">-->
											     <?php //foreach($teachers as $teacher){  
											  //  if($teacher->teacher_id == $course[0]->course_teacher) {
											       
											    ?>
									<!--		 <option selected="selected" value="<?php echo $teacher->teacher_id; ?>"><?php echo $teacher->teacher_name; ?></option>-->
										            
										            <?php //} else { ?>
											 
									<!--		 <option  value="<?php echo $teacher->teacher_id; ?>"><?php echo $teacher->teacher_name; ?></option>-->
											 
											    <? //}} ?>
											    
											    
											
									<!--		</select>-->
									<!--	</div>-->
									<!--</div>-->
								<div class="form-group row">
								    <div class="col-sm-12">
								        <div class="form-group row">
    								        <label class="col-sm-3 col-form-label">Category Image</label>
    										<div class="col-sm-9">
    											<input type="file" id="cat_img" class="form-control" name="image">
												<span id="cat_img_err" style="color:#f00;"></span>
    											<input type="hidden" class="form-control" name="course_image_old" value="<?php echo $courses[0]->course_image; ?>"> 
    											<br>
    											<?php if((isset($courses[0]->course_image)) && ($courses[0]->course_image !='') && (file_exists("./uploaded_files/".$courses[0]->course_image))) {  
    											    echo "<img src=\"".base_url()."uploaded_files/".$courses[0]->course_image."\"></td>";
    											} ?>
    											
    										</div>
										</div>
								    </div>
								     
									</div>
										<br>
								    <hr>
								    <br>
								    <div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Features</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="feature_1" value="<?php echo $courses[0]->feature_1 ; ?>"><br>
											<input type="text" class="form-control" name="feature_2" value="<?php echo $courses[0]->feature_2 ; ?>"><br>
											<input type="text" class="form-control" name="feature_3" value="<?php echo $courses[0]->feature_3 ;?>"><br>
											<input type="text" class="form-control" name="feature_4" value="<?php echo $courses[0]->feature_4 ; ?>"><br>
											<input type="text" class="form-control" name="feature_5" value="<?php echo $courses[0]->feature_5 ; ?>">
										</div>
									</div>
									<br>
								    <hr>
								    <br>
								    <div class="form-group row">
										<label class="col-sm-3 col-form-label">Category Videos</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="video_url1" value="<?php echo $courses[0]->video_url1 ; ?>"><br>
											<input type="text" class="form-control" name="video_url2" value="<?php echo $courses[0]->video_url2 ; ?>"><br>
											<input type="text" class="form-control" name="video_url3" value="<?php echo $courses[0]->video_url3 ; ?>"><br>
											<input type="text" class="form-control" name="video_url4" value="<?php echo $courses[0]->video_url4 ; ?>"><br>
											<input type="text" class="form-control" name="video_url5" value="<?php echo $courses[0]->video_url5 ; ?>">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-primary">Update Category</button>
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