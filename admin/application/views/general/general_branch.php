<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Zoukieast</title>
	
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
        
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css">
	<link rel="stylesheet" href="<?php echo base_url(""); ?>assets/js/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"> 
	
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(""); ?>assets/js/jquery.validation.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app.css">
	<script src="<?php echo base_url(""); ?>assets/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/handleCounter.js"></script>
	 <script type="text/javascript">	
		$(document).ready(function() {
			$('.datatable').DataTable( {
		        'paging':false,
		        'bInfo':false
		    } );
		} );
	</script> 
  
</head>
<body>
	<div class="gradient"></div>

	<!--navigation-bar-->
	

<div class="col-md-12 page-head border-bottom">
	<div class="col-md-3"></div>
		<div class="col-md-6" style="margin-top: 50px;max-width: 100%">
			<span class="text-center">
				<h3>Sites</h3>
			</span>
		</div>
		<div class="btn-div col-md-3">
		</div>
</div><!--.col-md-12 -->
	
<div class="container-fluid main-container">
    <?php if(null !==$this->session->flashdata('permissionmessage')) { ?>  
    <div id='hideMe'>
       <p class="alert alert-danger"><?php echo $this->session->flashdata('permissionmessage'); ?></p>
    </div>
    <?php } ?>
    <?php if(null !==$this->session->userdata('feedback')) { ?>
	<div class="alert alert-success" id="success-alert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php echo $this->session->flashdata('feedback'); ?>
    </div>
    <?php } ?> 
  
	<?php if(null !==$this->session->userdata('email_sent')) { ?>  
	<div id='hideMe'>
		<p class="alert alert-success"><?php echo $this->session->flashdata('email_sent'); ?></p>
	</div>
	<?php } ?>
 	<?php if(null !==$this->session->userdata('email_notsent')) { ?>  
	<div id='hideMe'>
		<p class="alert alert-danger"><?php echo $this->session->flashdata('email_notsent'); ?></p>
	</div>
 	<?php } ?>
	 	
	<?php if(null !==$this->session->userdata('message_success')) { ?>
	  <div class="alert alert-success">
	      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	      <?php echo $this->session->userdata('message_success');?>
      </div>
	<?php } ?>
	<div class="col-md-12">
		<div class="panel">
      		<div class="panel-body">
      			<div class="modules-wrapper">
      			    <div class="row" style="margin-left: 400px;">
					<?php foreach($branches_list as $branches){ ?>
					    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6" style="max-width: 32.666667%;">
					        <a href="<?php echo $branches['url'];?>">
					            <div class="modules" style="text-align: center;">
    							 	<div class="modules-box">
    							 		<img class="modules-images" src="<?php echo base_url(); ?>/shop2.png">
    							 	</div>
							 	    <p><?php echo $branches['branch_name'];?></p>
							    </div>
							</a>
					    </div>
					<?php }?>
					</div>
				</div>
      		</div>
      	</div>
	</div>
</div>
<br>