<style type="text/css">
	.media-body.dashboard {
    padding-left: 10px;
    color: white;
}
img.company {
    padding-left: 180px;
}
img.user {
    padding-left: 200px;
}
img.document {
    padding-left: 160px;
}
</style>
<div class="wrapper">
	
	<div class="row stats">
		<div class="col-md-6 col-lg-4 col-xl-4">
			<div class="box coleql_height">
				<a href="<?php echo base_url('/company');?>">
				<div class="media">
						<div class="media-body dashboard">
							<h3><?php echo $companyData; ?></h3>
							<?php echo strtoupper('Company'); ?>
						</div>
					<div class="icon"><a href="<?php echo base_url('/company');?>"><img class = "company"src="<?php echo base_url('assets/images/company.png'); ?>" alt=""></a></div>
				</div>
			</a>
			</div>
		</div>
		
		<div class="col-md-6 col-lg-4 col-xl-4">
			<div class="box coleql_height">
				<a href="<?php echo base_url('/users');?>">
				<div class="media">
					<div class="media-body dashboard">
						<h3><?php echo $usersData; ?></h3>
						<?php echo strtoupper('Users'); ?>
					</div>
					<div class="icon"><a href="<?php echo base_url('/users');?>"><img class= "user"src="<?php echo base_url('assets/images/user.png'); ?>" alt=""></a></div>
				</div>
			</a>
			</div>
		</div>

		<div class="col-md-6 col-lg-4 col-xl-4">
			<div class="box coleql_height">
				<a href="<?php echo base_url('/documents');?>">
				<div class="media">
					<div class="media-body dashboard">
						<h3><?php echo $documentsData; ?></h3>
						<?php echo strtoupper('Documents'); ?>
					</div>
					<div class="icon"><a href="<?php echo base_url('/documents');?>"><img class= "document"src="<?php echo base_url('assets/images/document.png'); ?>" alt=""></a></div>
				</div>
			</a>
			</div>
		</div>
	</div>
</div>
