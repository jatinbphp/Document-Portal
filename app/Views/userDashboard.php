

<?php
if($_SESSION['user_type'] == 3){ ?>
	<div class="wrapper">
		<div class="row stats">
			
			<div class="col-md-6 col-lg-3 col-xl-3">
				<div class="box coleql_height">
					<div class="media">
						<div class="media-body">
							<h3><?php echo $compTotal; ?></h3>
							<?php echo strtoupper('Company'); ?>
						</div>
						<div class="icon"><a href="<?php echo base_url('/userDocuments');?>"><img src="<?php echo base_url('assets/images/company.png'); ?>" alt=""></a></div>
					</div>
				</div>
			</div>
			
			
		<!--/div-->
	<!--/div-->
	
	
			<div class="col-md-6 col-lg-3 col-xl-3">
				<div class="box coleql_height">
					<div class="media">
						<div class="media-body">
							<h3><?php echo $workflowTotal; ?></h3>
							<?php echo strtoupper('Workflow'); ?>
						</div>
						<div class="icon"><a href="<?php echo base_url('/userDocuments');?>"><img src="<?php echo base_url('assets/images/document.png'); ?>" alt=""></a></div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
<?php }else{ ?>
		<div class="wrapper">
		<div class="row stats">
			
			<div class="col-md-6 col-lg-3 col-xl-3">
				<div class="box coleql_height">
					<div class="media">
						<div class="media-body">
							<h3><?php echo $tatalDoc; ?></h3>
							<?php echo strtoupper('Documents'); ?>
						</div>
						<div class="icon"><a href="<?php echo base_url('/userDocuments');?>"><img src="<?php echo base_url('assets/images/document.png'); ?>" alt=""></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
