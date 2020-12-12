<div id="content-page" class="content-page">
            

			<!-- Section -->
			<div class="container-fluid">
				<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<p class="card-title" style="display:inline">Follow Classes</p>
								<span class="pull-right"><a class="btn btn-info" href="<?php echo base_url();?>index.php/courses/new_follow_class">New Follow Class</a></span>
							</div>
						<div class="card-body">
							    <div class="row">
										
												<div class="col-12 col-md-4">
												
													
														<input type="text" class="form-control" id="search" placeholder="Search for Follow Class">
												
													</div>
								<table class="table table-sm table-striped">
									<thead>
										<tr>
										    <th>Class Name</th>
											<th>Course Name</th>
											<th>Class Date</th>
											<th>Image</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="Courses_list">
									    <?php if(!empty($follow_classes)) { ?>
										<?php foreach($follow_classes as $follow_class){
										echo "<td width=\"20%\">".$follow_class->class_name."</td>";
										echo "<td width=\"20%\">".$follow_class->course_name."</td>";
										echo "<td width=\"20%\">".$follow_class->follow_date."</td>";
										if((isset($follow_class->image)) && ($follow_class->image !='') && (file_exists("./uploaded_files/".$follow_class->image))) {  
											echo "<td width=\"10%\"><img src=\"".base_url()."uploaded_files/".$follow_class->image."\" class=\"avatar-40\"></td>";
											}
											else{
											    echo "<td width=\"10%\"></td>";
											}
								// 		echo "<td width=\"5%\"><a href=\"".base_url()."index.php/courses/edit_trial_class/".$trial_class->trial_time_slot_id."\" class=\"btn btn-danger btn-sm\">Edit</a></td>";
										echo "<td width=\"5%\"><button class=\"btn btn-danger btn-sm\" onClick=\"deletemodal(".$follow_class->follow_time_slot_id.")\">Delete</button></td>";
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
	        function deletemodal(follow_time_slot_id){
				    
                        $("#delete_follow_time_slot_id").val(follow_time_slot_id);
                        $("#deleteFollowModal").modal('show');
                        
                    }
                    
                $(document).ready(function() {  
                    
                   
                    $("#delete_follow").on('click',function(){
                        
                        var data1 = $("#delete_follow_time_slot_id").val();
                		
                		$.ajax({
                			type: "POST",
                			enctype: 'multipart/form-data',
                		    url: "<?php echo base_url(); ?>index.php/courses/delete_follow_class/",
                		    data: {"follow_time_slot_id":data1},
                		    success: function(data){
                		        location.load();
                		    }
                		});
                        
                    });
                });
				</script>
	<!-- Delete Modal HTML -->
	<div id="deleteFollowModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Follow Class</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete the Follow Class?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_follow">
						<input type="hidden" class="btn btn-danger" value="" id="delete_follow_time_slot_id">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>