<div id="content-page" class="content-page">
            

			<!-- Section -->
			<div class="container-fluid">
				<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<p class="card-title" style="display:inline">Categories</p>
								 <?php  if($this->session->userdata('useracc') != '2'){  ?>
								<span class="pull-right"><a class="btn btn-info" href="<?php echo base_url();?>index.php/courses/new_course">New Category</a></span>
							    <?php } ?>
							</div>
						<div class="card-body">
							    <div class="row">
										
												<div class="col-12 col-md-4">
												
													
														<input type="text" class="form-control" id="search" placeholder="Search for Course">
												
													</div>
								<table class="table table-sm table-striped">
									<thead>
										<tr>
											<th>Category Name</th>
											<th>Category Heading</th>
											<th>Course Overview</th>
											<th>Image</th>
											
											<th>Actions</th>
										</tr>
									</thead>
									<tbody id="Courses_list">
									    <?php if(!empty($courses)) { ?>
										<?php foreach($courses as $course){
										
										echo "<td width=\"20%\">".$course->course_name."</td>";
										echo "<td width=\"20%\">".$course->course_custom_heading."</td>";
										echo "<td width=\"20%\">".$course->course_short_description."</td>";
										
										if((isset($course->course_image)) && ($course->course_image !='') && (file_exists("./uploaded_files/".$course->course_image))) {  
											echo "<td width=\"10%\"><img src=\"".base_url()."uploaded_files/".$course->course_image."\" class=\"avatar-40\"></td>";
											}
											else{
											    echo "<td width=\"10%\"></td>";
											}
										
										echo "<td width=\"5%\"><a href=\"".base_url()."index.php/courses/edit_course/".$course->course_id."\" class=\"btn btn-danger btn-sm\">Edit</a></td>";
										echo "<td width=\"5%\"><button class=\"btn btn-danger btn-sm\" onClick=\"deletemodal(".$course->course_id.")\">Delete</button></td>";
										
										echo "</tr>";
										
										} 
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
	<script>
	        function deletemodal(course_id){
				    
                        $("#delete_course_id").val(course_id);
                        $("#deleteCourseModal").modal('show');
                        
                    }
                    
                $(document).ready(function() {  
                    
                   
                    $("#delete_course").on('click',function(){
                        
                        var data1 = $("#delete_course_id").val();
                		
                		$.ajax({
                			type: "POST",
                			enctype: 'multipart/form-data',
                		    url: "<?php echo base_url(); ?>index.php/courses/delete_course/",
                		    data: {"course_id":data1},
                		    success: function(data){
                		        location.reload();
                		    }
                		});
                        
                    });
                });
				</script>
	<!-- Delete Modal HTML -->
	<div id="deleteCourseModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete the Category?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_course">
						<input type="hidden" class="btn btn-danger" value="" id="delete_course_id">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>