<div id="content-page" class="content-page">
            

			<!-- Section -->
			<div class="container-fluid">
				<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<p class="card-title" style="display:inline">Teachers</p>
								<span class="pull-right"><a class="btn btn-info" href="<?php echo base_url();?>index.php/courses/new_teacher">New Teacher</a></span>
							</div>
						<div class="card-body">
							    <div class="row">
										
												<div class="col-12 col-md-4">
												
													
														<input type="text" class="form-control" id="search" placeholder="Search for Teacher">
												
													</div>
								<table class="table table-sm table-striped">
									<thead>
										<tr>
											<th>Teacher Name</th>
											<th>Email</th>
											<th>Contact</th>
											<th>Course</th>
											<th>Image</th>
											<!--<th>Status</th>-->
											<th>Actions</th>
										</tr>
									</thead>
									<tbody id="Courses_list">
									    <?php if(!empty($teachers)) { ?>
										<?php foreach($teachers as $teacher){
										
										echo "<td width=\"20%\">".$teacher->firstname." ".$teacher->lastname."</td>";
										echo "<td width=\"20%\">".$teacher->email."</td>";
										echo "<td width=\"20%\">".$teacher->contact."</td>";
										echo "<td width=\"20%\">".$teacher->course_name."</td>";
										if((isset($teacher->image)) && ($teacher->image !='') && (file_exists("./uploaded_files/".$teacher->image))) {  
											echo "<td width=\"10%\"><img src=\"".base_url()."uploaded_files/".$teacher->image."\" class=\"avatar-40\"></td>";
											}
											else{
											    echo "<td width=\"10%\"></td>";
											}
								// 		if($teacher->status == '1'){
										    
									
								// 		echo "<td width=\"20%\">Active</td>";
								// 		}
								// 		else{
								// 		 echo "<td>Disabled</td>";   
								// 		}
										echo "<td width=\"5%\"><a href=\"".base_url()."index.php/courses/edit_teacher/".$teacher->user_id."\" class=\"btn btn-danger btn-sm\">Edit</a></td>";
										echo "<td width=\"5%\"><button class=\"btn btn-danger btn-sm\" onClick=\"deletemodal(".$teacher->user_id.")\">Delete</button></td>";
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
	        function deletemodal(teacher_id){
				    
                        $("#delete_teacher_id").val(teacher_id);
                        $("#deleteTeacherModal").modal('show');
                        
                    }
                    
                $(document).ready(function() {  
                    
                   
                    $("#delete_teacher").on('click',function(){
                        
                        var data1 = $("#delete_teacher_id").val();
                		
                		$.ajax({
                			type: "POST",
                			enctype: 'multipart/form-data',
                		    url: "<?php echo base_url(); ?>index.php/courses/delete_teacher/",
                		    data: {"teacher_id":data1},
                		    success: function(data){
                		        
                		    }
                		});
                        location.reload();
                    });
                });
				</script>
	<!-- Delete Modal HTML -->
	<div id="deleteTeacherModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Teacher</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete the Teacher?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_teacher">
						<input type="hidden" class="btn btn-danger" value="" id="delete_teacher_id">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>