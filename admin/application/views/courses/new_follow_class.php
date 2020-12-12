<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

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
								<p class="card-title">New Follow Class</p>
							</div>
							<div class="card-body">
							  <form role="form" method="post" id="hack_submit" action="<?php echo base_url();?>index.php/courses/add_new_follow_slot"  enctype="multipart/form-data">
                                    
                                    <div class="form-group row">
										<label class="col-sm-3 col-form-label"> Class Name</label>
    							        <div class="col-sm-9">
    								      <input type='text' class="form-control" name="class_name" > 
    								    </div>
    								</div>
    								<?php  if($this->session->userdata('useracc') != '2'){  ?>
                                    <div class="form-group row">
										<label class="col-sm-3 col-form-label"> Select Course</label>
										<div class="col-sm-9">
											<select class="form-control" name="follow_course">
                									<?php if(!empty($courses)) { ?>
                									<?php foreach($courses as $course){ ?>
                									<option value="<?php echo $course->course_id; ?>"><?php echo $course->course_name; ?></option>
                									<?php }} ?>
                							</select>
							            </div>
								
							        </div>
									<?php }
									else
									{	?>
									<input type='hidden' class="form-control" name="follow_course" value="<?php echo $this->session->userdata('usercourse'); ?>" >
									<?php } ?>
							         <div class="form-group row">
										<label class="col-sm-3 col-form-label"> No Of Students</label>
    							        <div class="col-sm-9">
    								      <input type='text' class="form-control" name="no_of_students" > 
    								    </div>
    								</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Class Short Description</label>
										<div class="col-sm-9">
											
											<textarea class="form-control" id="textareaChars" name="class_short_description" placeholder="Short Description" maxlength="150"></textarea>
											 <span id="chars">150</span> characters remaining
										</div>
									</div>
    								<div class="form-group row">
										<label class="col-sm-3 col-form-label">Class Description</label>
    							        <div class="col-sm-9">
    								      <textarea class="form-control" name="class_description" placeholder="Description"> </textarea>
    								    </div>
    								</div>
    								
    								<div class="form-group row">
										<label class="col-sm-3 col-form-label">Class Image</label>
    							        <div class="col-sm-9">
    								      <input type='file' id="img-file" class="form-control" name="image" > 
										  <span id="img_err" style="color:#f00;"></span>
    								    </div>
    								</div>
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
							        
						<div class="weekday_line_parent">
                          
                                                    	 <div class="form-group row">
                                                    	     <label class="col-sm-3 col-form-label">Follow Date:</label>
                            							        <div class="col-sm-9">
                            								     <div class='input-group date datetimepicker1'>
                                                                        <input type='text' class="form-control" name="follow_date[]" style="height: 33px;" autocomplete="off" required >
                                                                        <span class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                                        </span>
                                                                    </div>
                            								    </div>
                                                          
                                                                    </div>
                    <div class="container">                                	            
                         <div class="row" style="margin-bottom:30px;margin-top:30px;align-items: center;">	
                                <div class="col-sm-11 ct-col-left">
                                    <div class="ct-scroll">
                                       <table id="week_days" class="weekday_line">
                                        <thead>
                                                            	<tr> <th> </th><th> Slot 1</th>   <th> Slot 2 </th>  <th> Slot 3 </th>  <th> Slot 4 </th>  <th> Slot 5 </th> </tr>
                                                            		</thead>
                                       <tbody>
                                        <tr>
                                                            	
                                                    <td class="ct-w"> Start </td> 
                                                                                    
                                                      <?php 
                                                       $slot_times = array('slotone','slottwo','slotthree','slotfour','slotfive');
                                                                                    
                                                        for ($i = 0; $i < 5; $i++) {
                                                         $name = $slot_times[$i].'_start[]';  ?>
                                                       <td>  
                                                     <div class='input-group date datetimepicker3'>
                                                      <input type='text' class="form-control" name="<?php echo $name;  ?>">
                                                      <span class="input-group-addon" >
                                                      <span class="glyphicon glyphicon-time"></span>
                                                      </span>
                                                       </div>
                                                   </td> 
                                                      <?php } ?>                               
                                                 </tr>
                                                    <tr>
                                                     <td class="ct-w">End</td> 
                                                          <?php 
                                                                                    
                                                  for ($i = 0; $i < 5; $i++) {
                                                       $name = $slot_times[$i].'_end[]';
                                                    ?>
                                                  <td>  
                                                <div class='input-group date datetimepicker3'>
                                                 <input type='text' class="form-control" name="<?php echo $name;  ?>" >
                                                <span class="input-group-addon">
                                              <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                            </div>
                                            </td> 
                                                                                    
                                                     <?php } ?>
                                             </tr>
                                    <tbody>
                                </table></div>
                                
                                    
                                </div>
                                <!--<div class="col-sm-1 ct-col-right ct-btns">-->
                                <!--<span class=""><a href="javascript:void(0)" class="add_field_button" >+</a></span>-->
                                <!--  </div>	-->
                                 
                        </div>
                    </div>
              </div>
              
              <div class="form-group row">
                  <div class="col-12 text-center">
              <button type="submit" id="nextBtn" class="btn btn-primary" >Submit</button>
                </div></div>
                
              </div>
              
              </form>
               </div>
            <script>
             function validateForm() {
                                      // This function deals with validation of the form fields
                                      var x, y, i, valid = true;
                                      x = document.getElementsByClassName("tab");
                                      y = x[currentTab].getElementsByTagName("input");
                                      // A loop that checks every input field in the current tab:
                                      for (i = 0; i < y.length; i++) {
                                        // If a field is empty...
                                        if (y[i].value == "") {
                                          // add an "invalid" class to the field:
                                          y[i].className += " invalid";
                                          // and set the current valid status to false
                                          valid = false;
                                        }
                                      }
                                      // If the valid status is true, mark the step as finished and valid:
                                      if (valid) {
                                        document.getElementsByClassName("step")[currentTab].className += " finish";
                                      }
                                      return valid; // return the valid status
                                    }
        
                                    </script>
							    
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	
	function hack(){
	var form = $("#hack_submit");
	var formdata =  form.serialize();
	
	 $.ajax({
				type: "POST",
		        url: "<?php echo base_url();?>index.php/courses/add_new_follow_slot",
		        data:formdata,
		        beforeSend: function(){
                $("#loader").show();
                 },
                complete:function(data){
                $("#loader").hide();
                 },
		        success: function(data){
		        if(data=='Sucess'){
		        var msg = "Follow data Added Succesfully";
		        var icon = "success";
		        }
		        swal({
		            
                text: 'Follow time slots added Succesfully',
                 icon: 'success',
          }).then((value) => {
          if(data=='Sucess'){
          
       }
       });
		  }
	       });
	}
	
	$(document).on("click", ".add_field_button" , function() {
	 var wrapper  = $(".weekday_line_parent");
	
   $(wrapper).append('<div class="tab" style="display: block;"><div class="form-group row">'+
            '<label class="col-sm-3 col-form-label"><b>Follow Date:</b></label><div class="col-sm-9"><div class="input-group date datetimepicker1">'+
             '<input type="text" class="form-control" name="follow_date[]" style="height: 33px;" autocomplete="off" required="">'+
             '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div></div>'+
              '<div class="container"><div class="row " style="margin-bottom:30px;align-items: center;"><div class="col-sm-11 ct-col-left"><div class="ct-scroll">'+
              '<table id="week_days" class="weekday_line"><thead><tr> <th> </th><th> Slot 1</th>   <th> Slot 2 </th>  <th> Slot 3 </th>  <th> Slot 4 </th>  <th> Slot 5 </th> </tr>'+
             '</thead><tbody><tr><td class="ct-w"> Start </td> <td>'+  
              '<div class="input-group date datetimepicker3"><input type="text" class="form-control" name="slotone_start[]">'+
             '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td><td>'+  
            '<div class="input-group date datetimepicker3"><input type="text" class="form-control" name="slottwo_start[]">'+
             '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td>'+
           '<td><div class="input-group date datetimepicker3"><input type="text" class="form-control" name="slotthree_start[]">'+
            '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td><td>'+  
            '<div class="input-group date datetimepicker3"><input type="text" class="form-control" name="slotfour_start[]">'+
            '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td>'+ 
            '<td> <div class="input-group date datetimepicker3"><input type="text" class="form-control" name="slotfive_start[]">'+
            '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td></tr>'+
            '<tr><td class="ct-w">End</td> <td> <div class="input-group date datetimepicker3">'+
            '<input type="text" class="form-control" name="slotone_end[]"><span class="input-group-addon">'+
            '<span class="glyphicon glyphicon-time"></span></span></div></td>'+ 
           '<td>  <div class="input-group date datetimepicker3"><input type="text" class="form-control" name="slottwo_end[]">'+
             '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td>'+ 
            '<td><div class="input-group date datetimepicker3"><input type="text" class="form-control" name="slotthree_end[]">'+
           '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td>'+ 
        '<td> <div class="input-group date datetimepicker3"><input type="text" class="form-control" name="slotfour_end[]">'+
           '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td>'+ 
            '<td> <div class="input-group date datetimepicker3"><input type="text" class="form-control" name="slotfive_end[]">'+
            '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span></div></td>'+ 
            '</tr></tbody><tbody></tbody></table></div></div><div class="col-sm-1 ct-col-right ct-btns">'+
          '<span class=""><a href="javascript:void(0)" class="add_field_button">+</a></span>'+
             '</div>	</div></div></div></div>');

 $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm A'
                });
                
             
                $('.datetimepicker1').datetimepicker({
					format: 'DD-MM-YYYY',
					//minDate:new Date()
				});
          
  
    });
        
         $(document).on("click", ".remove_field_button" , function() {
        
        
         $(this).parent().parents('.container:first').remove();
       
        
        });
        
            $(document).ready(function(){
             $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm A'
                });
             });
              
           </script>
	<script type="text/javascript">
            $(function () {
                $('.datetimepicker1').datetimepicker({
					format: 'DD-MM-YYYY',
					//minDate:new Date()
				});
            });
       
    var maxLength = 150;
$('textarea').keyup(function() {
  var length = $(this).val().length;
  var length = maxLength-length;
  $('#chars').text(length);
});
</script>
	<style>
 	label.error, label>span{
 		color:red;
 	}
    </style>
	<script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> 
    </script> 
<script>
$('#img-file').on('change', function() { 
            if (this.files[0].size > 2097152) { 
                //alert("Try to upload file less than 2MB!"); 
				 $('#img_err').html("Try to upload file less than 2MB!"); 
				 $(this).val('');
            } 
			else{
				 $('#img_err').html("");
			}
});
</script>
