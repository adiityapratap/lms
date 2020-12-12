<div id="content-page" class="content-page">
            

			<!-- Section -->
			<div class="container-fluid">
				<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<p class="card-title" style="display:inline">Student Booking Trial</p>
							</div>
						<div class="card-body">
							    <div class="row">
										
								<table class="table table-sm table-striped">
									<thead>
										<tr>
										    <th>Student Name</th>
										    <th>Student Email</th>
										    <th>Student Phone</th>
										     <!--<th>Status</th>-->
										</tr>
									</thead>
									<tbody id="Courses_list">
									    <?php if(!empty($students)) { ?>
										<?php foreach($students as $student){
											echo "<td width=\"15%\">".$student->first_name." ".$student->last_name."</td>";
											echo "<td width=\"20%\">".$student->student_email."</td>";
											echo "<td width=\"10%\">".$student->student_phone."</td>";
								// 			$chkstatus="";
								// 			if($student->status == 1){
								// 			    $chkstatus="checked";
								// 			}
								// 			echo "<td width=\"10%\"><label class=\"switch\"> <input type=\"checkbox\" checked=\"".$chkstatus."\" onclick=\"updatestatus(this,'".$student->student_id."')\"><span class=\"slider round\"></span></td>";
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
// 	    function updatestatus(obj,student_id){
//         if ($(obj).attr('checked')) {
//         $(obj).removeAttr('checked');
//         $.ajax({
//             type: "POST",
//             url: "<?php echo base_url(); ?>index.php/courses/update_status",
//             data:'student_id='+student_id+'&status=0',
//             success: function(data){
//                  location.reload();
//             }
//         });
//         } else {
//             $(obj).attr("checked", "checked");
//             $.ajax({
//             type: "POST",
//             url: "<?php echo base_url(); ?>index.php/courses/update_status",
//             data:'student_id='+student_id+'&status=1',
//             success: function(data){
//                 location.reload();
//             }
//         });
//         }
        
        
//     }
</script>
</div>