<div id="content-page" class="content-page">
            

			<!-- Section -->
			<div class="container-fluid">
				<div class="row">
					<!--Report widget start-->
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<p class="card-title" style="display:inline">Student Booking Follow</p>
							</div>
						<div class="card-body">
							    <div class="row">
										
								<table class="table table-sm table-striped">
									<thead>
										<tr>
										    <th>Student Name</th>
										    <th>Student Email</th>
										    <th>Student Phone</th>
											<th>Course Name</th>
											<th>Class Date</th>
											<th>Time Slot</th>
										</tr>
									</thead>
									<tbody id="Courses_list">
									    <?php if(!empty($student_booking_follow)) { ?>
										<?php foreach($student_booking_follow as $student_trial){
											echo "<td width=\"15%\">".$student_trial->first_name." ".$student_trial->last_name."</td>";
											echo "<td width=\"20%\">".$student_trial->student_email."</td>";
											echo "<td width=\"10%\">".$student_trial->student_phone."</td>";
    										echo "<td width=\"15%\">".$student_trial->course_name."</td>";
    										echo "<td width=\"10%\">".$student_trial->follow_date."</td>";
    										echo "<td width=\"20%\">".$student_trial->time_slot."</td>";
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
	
</div>