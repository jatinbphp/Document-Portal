<<<<<<< HEAD
<div class="sidebar">
	<div class="sidebar-menu">
		<button type="button" class="menu-close menu-btn d-block d-xl-none"><span class="sr-only">MENU</span></button>
		<ul class="accordion">
			<li class="Dashboard-Menu"><a href="<?php echo base_url('dashboard'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">Dashboard</a></li>
				
					<li class="manageUsers-Menu"><a class="toggle" href="javascript:void(0)" onclick="showDiv()"><img src="<?php echo base_url('assets/images/dash-icon-5.png');?>" alt="">Manage Users</a></li>
					
					<li class="Users-Menu" id="Users-Menu" style="display:none;"><a class="" href="<?php echo base_url('users'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt=""> Users</a></li>
					
                    <li class="Company-Menu"><a class="" href="<?php echo base_url('company'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Company</a></li>

                    <li class="Category-Menu"><a class="" href="<?php echo base_url('category'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Category</a></li>
                    
                    <li class="SubCategory-Menu"><a class="" href="<?php echo base_url('subcategory'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Sub Category</a></li>

                    <li class="Document-Menu"><a class="" href="<?php echo base_url('documents'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Manage Document</a></li>
                    
                    <li class="Reporting-Menu"><a class="" href="<?php echo base_url('reporting'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt=""> Reporting</a></li>
         
					<li class="Reporting-Category"><a class="" href="<?php echo base_url('reporting/category'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Category</a></li>
					
					

            </li>

           <!--  <li class="manageInvoice-Menu">
                <a class="toggle" href="javascript:void(0)"><img src="<?php echo base_url('assets/images/dash-icon-5.png');?>" alt="">Manage Invoice</a>
                <ul class="inner">
                    <li class="Invoice-Menu"><a class="" href="<?php echo base_url('invoice'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt=""> Invoice</a></li>
                </ul>
            </li> -->
             <!-- <li class="manageCustomers-Menu">
                <a class="toggle" href="javascript:void(0)"><img src="<?php echo base_url('assets/images/dash-icon-5.png');?>" alt="">Manage Customers</a>
                <ul class="inner">
                    <li class="Customers-Menu"><a class="" href="<?php echo base_url('customers'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt=""> Customers</a></li>
                </ul>
            </li>
 -->
            <!-- <li class="manageCustomers-Menu">
                    <li class="pdf-Menu"><a class="" href="<?php echo base_url('createpdf'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt=""> Create Pdf</a></li>
            </li> -->
            
	</div>
</div>
<div class="body-overlay"></div>

<script>
function showDiv() {
   document.getElementById('Users-Menu').style.display = "block";
}
</script>
=======
<div class="sidebar">
	<div class="sidebar-menu">
		<button type="button" class="menu-close menu-btn d-block d-xl-none"><span class="sr-only">MENU</span></button>
		<ul class="accordion">
			<li class="Dashboard-Menu"><a href="<?php echo base_url('dashboard'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">Dashboard</a></li>
				
					<!-- <li class="manageUsers-Menu"><a class="toggle" href="javascript:void(0)" onclick="showDiv()"><img src="<?php echo base_url('assets/images/dash-icon-5.png');?>" alt="">Manage Users</a></li> -->
					
					<li class="Users-Menu"><a class="" href="<?php echo base_url('users'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt="">Manage Users</a></li>
					
                    <li class="Company-Menu"><a class="" href="<?php echo base_url('company'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Company</a></li>

                    <li class="Category-Menu"><a class="" href="<?php echo base_url('category'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Category</a></li>
                    
                    <li class="SubCategory-Menu"><a class="" href="<?php echo base_url('subcategory'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Sub Category</a></li>

                    <li class="Document-Menu"><a class="" href="<?php echo base_url('documents'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Manage Document</a></li>
                    
                    <li class="Reporting-Menu"><a class="" href="<?php echo base_url('reporting'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt=""> Reporting</a></li>
         
					<li class="Reporting-Category"><a class="" href="<?php echo base_url('reporting/category'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt=""> Category</a></li>

            </li>

           <!--  <li class="manageInvoice-Menu">
                <a class="toggle" href="javascript:void(0)"><img src="<?php echo base_url('assets/images/dash-icon-5.png');?>" alt="">Manage Invoice</a>
                <ul class="inner">
                    <li class="Invoice-Menu"><a class="" href="<?php echo base_url('invoice'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt=""> Invoice</a></li>
                </ul>
            </li> -->
             <!-- <li class="manageCustomers-Menu">
                <a class="toggle" href="javascript:void(0)"><img src="<?php echo base_url('assets/images/dash-icon-5.png');?>" alt="">Manage Customers</a>
                <ul class="inner">
                    <li class="Customers-Menu"><a class="" href="<?php echo base_url('customers'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt=""> Customers</a></li>
                </ul>
            </li>
 -->
            <!-- <li class="manageCustomers-Menu">
                    <li class="pdf-Menu"><a class="" href="<?php echo base_url('createpdf'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt=""> Create Pdf</a></li>
            </li> -->
            
	</div>
</div>
<div class="body-overlay"></div>

<script>
function showDiv() {
   document.getElementById('Users-Menu').style.display = "block";
}
</script>
>>>>>>> 3dba451e1afdda509f1a981b903d787833b590e7
