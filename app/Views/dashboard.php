<div class="wrapper">
	
	<div class="row stats">
		<div class="col-md-6 col-lg-4 col-xl-4">
			<div class="box coleql_height">
				<div class="media">
						<div class="media-body">
							<h3><?php echo $companyData; ?></h3>
							Company
						</div>
					<div class="icon"><a href="<?php echo base_url('/company');?>"><img src="<?php echo base_url('assets/images/company.png'); ?>" alt=""></a></div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6 col-lg-4 col-xl-4">
			<div class="box coleql_height">
				<div class="media">
					<div class="media-body">
						<h3><?php echo $usersData; ?></h3>
						Users
					</div>
					<div class="icon"><a href="<?php echo base_url('/users');?>"><img src="<?php echo base_url('assets/images/user.png'); ?>" alt=""></a></div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-4 col-xl-4">
			<div class="box coleql_height">
				<div class="media">
					<div class="media-body">
						<h3><?php echo $documentsData; ?></h3>
						Documents
					</div>
					<div class="icon"><a href="<?php echo base_url('/documents');?>"><img src="<?php echo base_url('assets/images/document.png'); ?>" alt=""></a></div>
				</div>
			</div>
		</div>
	</div>
</div>
