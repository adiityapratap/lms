<?php $referrer=explode("/",$_SERVER['PATH_INFO'])[2];?>
<!-- header_End -->
<style>
    .efe-header.main-header {
    z-index: 0;
    width: 81%;
    margin: 0;
    border: 0;
    padding: 0 15px;
    background-color: transparent;
    box-shadow: none;
    position: relative;
    float: right;
    min-height: 70px;
}
</style>
<!-- Content_right -->
<div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body">
                           <div class="text-center mb-2">
                           <div class="rounded-circle iq-card-icon iq-bg-primary"><i class="ri-rocket-2-line"></i></div></div>
                           <div class="clearfix"></div>
                           <div class="text-center">
                              <h2 class="mb-0"><span class="counter"><?php echo $deliveries_today;?></span></h2>
                              <h6 class="mb-2">Deliveries Due Today</h6>
                              <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">0%</span> Increased</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body">
                           <div class="text-center mb-2">
                           <div class="rounded-circle iq-card-icon iq-bg-danger"><i class="ri-rocket-2-line"></i></div></div>
                           <div class="clearfix"></div>
                           <div class="text-center">
                              <h2 class="mb-0"><span class="counter"><?php echo $deliveries_this_month;?></span></h2>
                              <h6 class="mb-2">Deliveries This Month</h6>
                              <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">0%</span> Increased</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body">
                           <div class="text-center mb-2">
                           <div class="rounded-circle iq-card-icon iq-bg-success"><i class="ri-exchange-dollar-line"></i></div></div>
                           <div class="clearfix"></div>
                           <div class="text-center">
                              <h2 class="mb-0"><span class="counter"><?php echo $revenue_this_month;?></span></h2>
                              <h6 class="mb-2">Revenue This Month</h6>
                              <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">0%</span> Increased</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body">
                           <div class="text-center mb-2">
                           <div class="rounded-circle iq-card-icon iq-bg-info"><i class="ri-exchange-dollar-line"></i></div></div>
                           <div class="clearfix"></div>
                           <div class="text-center">
                              <h2 class="mb-0"><span class="counter"><?php echo $total_unpaid?></span></h2>
                              <h6 class="mb-2">Total Unpaid Dues</h6>
                              <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">0%</span> Increased</p>
                           </div>
                        </div>
                     </div>
                  </div>
                </div>
			<!-- breadcrumb 
			<div class="page-heading">
				<div class="row d-flex align-items-center">
					<div class="col-md-6">
						<div class="page-breadcrumb">
							<h1>Dashboard</h1>
						</div>
						
					</div>
					<div class="col-md-6 justify-content-md-end d-md-flex"> 
						<div class="breadcrumb_nav">
							<ol class="breadcrumb">
								<li>
									<i class="fa fa-home"></i>
									<a class="parent-item" href="#!">Home</a>
									<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">
									Dashboard
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<!-- breadcrumb_End -->

			<!-- Section -->
			<section class="chart_section">
			<!--	<div class="row">
					<div class="col-xl-3 col-sm-6 mb-4">
						<div class="card border-0 text-light">
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<div class="homepage_single">
											<span class="sec_icon"><i class="fa fa-rocket" aria-hidden="true"></i></span>
											<div class="homepage_fl_right">
												<h4 class="mt-0">Deliveries Due Today</h4>
												<h3><?php echo $deliveries_today;?></h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-sm-6 mb-4">
						<div class="card border-0 text-light">
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<div class="homepage_single">
											<span class="sec_icon"><i class="fa fa-rocket" aria-hidden="true"></i></span>
											<div class="homepage_fl_right">
												<h4 class="mt-0">Deliveries This Month</h4>
												<h3><?php echo $deliveries_this_month;?></h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-sm-6 mb-4">
						<div class="card border-0 text-light">
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<div class="homepage_single">
											<span class="sec_icon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
											<div class="homepage_fl_right">
												<h4 class="mt-0">Revenue This Month</h4>
												<h3><?php echo $revenue_this_month;?></h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-3 col-sm-6 mb-4">
						<div class="card border-0 text-light">
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<div class="homepage_single">
											<span class="sec_icon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
											<div class="homepage_fl_right">
												<h4 class="mt-0">Total Unpaid Dues</h4>
												<h3><span class="single-count"><?php echo $total_unpaid?></span></h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
-->

			</section>
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
					2020 © lms
				</p>
			</div>
			<a id="back-to-top" href="#"> <i class="ion-android-arrow-up"></i> </a>
		</div>
	</div>
</footer>
<!-- Footer_End -->
</div>
<!-- Reorder modal -->
<div class="modal fade" id="reorder_modal" tabindex="-1" role="dialog" aria-labelledby="reorder_title" aria-hidden="true">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="reorder_title">Delivery date and time</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="<?php echo base_url();?>index.php/orders/reorder" method="POST" id="reorder_form">
				<input type="hidden" name="order_id" id="reorder_id">
				<div class="row">
					<div class="col-12">
						<label>Delivery Date</label>
						<input type="text" class="form-control datepicker" name="delivery_date" required>
					</div>
					<div class="col-12 mt-3">
						<label>Delivery Time</label>
						<input type="text" class="form-control timepicker" name="delivery_time" required>
					</div>
				</div>
				<div class="row mt-2">
					<div class='col-12'>
						<button type="submit" class="btn btn-info">Proceed</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- chart js -->
<script src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
<?php $colors=array(
'January'=>'#ecb965',
'February'=>'#f8996e',
'March'=>'#fc7579',
'April'=>'#fc5a85',
'May'=>'#eb5892',
'June'=>'#b76da1',
'July'=>'#768fb2',
'August'=>'#44abbc',
'September'=>'#35b9be',
'October'=>'#35beb8',
'November'=>'#35beae',
'December'=>'#3bbea6'
);?>
<script>
$(function(){
$(".datepicker").datetimepicker({
	format:'YYYY-MM-DD'
})
$(".timepicker").datetimepicker({
	format:'hh:mm a'
})
})
var ctx = document.getElementById('myChart3').getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
	labels: [<?php $a=[];foreach($company_order as $c){$a[]="'".$c->month.", ".$c->year."'";}echo implode(",",$a);?>],
	datasets: [{
		label: 'Monthly sales',
		data: [<?php $a=[];foreach($company_order as $c){$a[]=$c->order_count;}echo implode(",",$a);?>],
		backgroundColor: [
			<?php foreach($company_order as $c) echo "'".$colors["$c->month"]."',";?>
		],
		borderWidth: 0
	}]
},
options: {
	maintainAspectRatio: false,
	legend: {
		display: true
	},
	scales: {
		xAxes: [{
			display: true
		}],
		yAxes: [{
			display: true
		}]
	},
	height:'300px',
	titles:{
		display:false
	}

}
});
function reorder(order_id){
	$("#reorder_id").val(order_id);
	$("#reorder_modal").modal('show');
}
$("#reorder_form").on('submit',function(){
	$("#reorder_modal").modal('hide');
})
</script>