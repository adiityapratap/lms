<div id="content-page" class="content-page">
            

			<!-- Section -->
			<div class="container-fluid">
				<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<p class="card-title" style="display:inline">Testimonials</p>
							
								<span class="pull-right"><a class="btn btn-info" href="<?php echo base_url();?>index.php/content/new_testimonial">New Testimonials</a></span>
							 
							</div>
						<div class="card-body">
							    <div class="row">
										
								<table class="table table-sm table-striped">
									<thead>
										<tr>
											<th>Username</th>
											<th>Comment</th>
											<!--<th>Image</th>-->
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
									    <?php if(!empty($testimonials)) { ?>
										<?php foreach($testimonials as $testimonial){
										
										echo "<td width=\"20%\">".$testimonial->username."</td>";
										echo "<td width=\"70%\">".$testimonial->comment."</td>";
										
								// 		if((isset($testimonial->course_image)) && ($testimonial->course_image !='') && (file_exists("./uploaded_files/".$testimonial->course_image))) {  
								// 			echo "<td width=\"10%\"><img src=\"".base_url()."uploaded_files/".$testimonial->course_image."\" class=\"avatar-40\"></td>";
								// 			}
								// 			else{
								// 			    echo "<td width=\"10%\"></td>";
								// 			}
										
								// 		echo "<td width=\"5%\"><a href=\"".base_url()."index.php/courses/edit_course/".$testimonial->testimonial_id."\" class=\"btn btn-danger btn-sm\">Edit</a></td>";
										echo "<td width=\"5%\"><button class=\"btn btn-danger btn-sm\" onClick=\"deletemodal(".$testimonial->testimonial_id.")\">Delete</button></td>";
										
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
	        function deletemodal(testimonial_id){
				    
                        $("#delete_testimonial_id").val(testimonial_id);
                        $("#deletetestimonialModal").modal('show');
                        
                    }
                    
                $(document).ready(function() {  
                    
                   
                    $("#delete_testimonial").on('click',function(){
                        
                        var data1 = $("#delete_testimonial_id").val();
                		
                		$.ajax({
                			type: "POST",
                			enctype: 'multipart/form-data',
                		    url: "<?php echo base_url(); ?>index.php/content/delete_testimonial/",
                		    data: {"testimonial_id":data1},
                		    success: function(data){
                		    }
                		});
                        
                    });
                });
				</script>
	<!-- Delete Modal HTML -->
	<div id="deletetestimonialModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Testimonial</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
  					
						<p>Are you sure you would like to delete the Testimonial?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete" id="delete_testimonial">
						<input type="hidden" class="btn btn-danger" value="" id="delete_testimonial_id">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>