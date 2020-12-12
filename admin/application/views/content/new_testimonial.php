
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
								<p class="card-title">New Testimonial</p>
							</div>
							<div class="card-body">
								<form action="<?php echo base_url();?>index.php/content/add_new_testimonial" method="POST" enctype="multipart/form-data">
								
									<div class="form-group row new_cat">
										<label class="col-sm-3 col-form-label">Testimonial UserName</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="username" placeholder="New Testimonial Name">
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Comment</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="textareaChars" name="comment" placeholder="Comment" ></textarea>
											 <span class="words-left">125 words remaining</span> 
										</div>
									</div>
									
									<!--<div class="form-group row">-->
									<!--	<label class="col-sm-3 col-form-label">Testimonial Image</label>-->
									<!--	<div class="col-sm-9">-->
									<!--		<input type="file" class="form-control" name="image">-->
									<!--	</div>-->
									<!--</div>-->
									
									<div class="form-group row">
										<div class="col-12 text-center">
											<button type="submit" class="btn btn-primary">Add Testimonial</button>
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
//     var maxLength = 200;
// $('textarea').keyup(function() {
//   var length = $(this).val().length;
//   var length = maxLength-length;
//   $('#chars').text(length);
// });

var wordLen = 125,
		len; // Maximum word length
$('textarea').keydown(function(event) {	
	len = $('textarea').val().split(/[\s]+/);
	if (len.length > wordLen) { 
		if ( event.keyCode == 46 || event.keyCode == 8 ) {// Allow backspace and delete buttons
    } else if (event.keyCode < 48 || event.keyCode > 57 ) {//all other buttons
    	event.preventDefault();
    }
	}
	console.log(len.length + " words are typed out of an available " + wordLen);
	wordsLeft = (wordLen) - len.length;
	$('.words-left').html(wordsLeft+ ' words remaining');
	if(wordsLeft == 0) {
		$('.words-left').css({
		}).prepend('<i class="fa fa-exclamation-triangle"></i>');
	}
});
</script>
