<?php 
if($_SESSION['user_type'] == 2){ ?>
<!-- USER -->

<div class="sidebar">
	<div class="sidebar-menu">
		<button type="button" class="menu-close menu-btn d-block d-xl-none"><span class="sr-only">MENU</span></button>
		<ul class="accordion">
			<li class="Dashboard-Menu"><a href="<?php echo base_url('userdashboard'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">Dashboard</a></li>

			 <li class="Document-Menu"><a href="<?php echo base_url('userDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">Manage Document</a></li> 

			<li class="UserDocument-Menu"><a href="<?php echo base_url('userdocs'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">Documents</a></li>
			
			
            
	</div>
</div>
<div class="body-overlay"></div>
<!--   SUBADMIN  -->
<?php } elseif($_SESSION['user_type'] == 3){ ?>

	<div class="sidebar">
	<div class="sidebar-menu">
		<button type="button" class="menu-close menu-btn d-block d-xl-none"><span class="sr-only">MENU</span></button>
		<ul class="accordion">
			<li class="Dashboard-Menu"><a href="<?php echo base_url('userdashboard'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">Dashboard</a></li>

			<li class="Document-Menu"><a href="<?php echo base_url('subadminworkflow'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">workflow </a></li>

			<li class="SubDocuments-Menu"><a href="<?php echo base_url('subdocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">Documents</a></li>

			<li class="All-Documents-Menu"><a href="<?php echo base_url('subadminDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">All Documents</a></li>		
  
	</div>
</div>
<div class="body-overlay"></div>

<?php }?>
