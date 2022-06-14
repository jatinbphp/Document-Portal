<style type="text/css">
	.media-body.company {
    padding-left: 10px;
    color: white;
}
img.company {
    padding-left: 90px;
}
img.user {
    padding-left: 73px;
}
</style>

<?php
if($_SESSION['user_type'] == 3){ ?>
	<div class="wrapper">
		<div class="row stats">
			
			<div class="col-md-6 col-lg-3 col-xl-3">
				<div class="box coleql_height">
					<div class="media">
						<a href="<?php echo base_url('/subadminworkflow');?>">
						<div class="media-body company">
							<h3><?php echo $compTotal; ?></h3>
							<?php echo strtoupper('Company'); ?>
						</div>
						<div class="icon"><a href="<?php echo base_url('/subadminworkflow');?>"><img  class ="company"src="<?php echo base_url('assets/images/company.png'); ?>" alt=""></a></div>
					</div>
				</a>
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
						<a href="<?php echo base_url('/userDocuments');?>">
						<div class="media-body company">
							<h3><?php echo $tatalDoc; ?></h3>
							<?php echo strtoupper('Documents'); ?>
						</div>
						<div class="icon"><a href="<?php echo base_url('/userDocuments');?>"><img class ="user" src="<?php echo base_url('assets/images/document.png'); ?>" alt=""></a></div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>