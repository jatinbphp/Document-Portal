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
                    
                    <li class="Reporting-Menu"><a class="" href="javascript:void(0)" onclick="showDiv()"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt=""> Reporting</a></li>
                    
                    <li class="UserReport-SubMenu" id="userReport" style="display: none;"><a class="" href="<?php echo base_url('reporting'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt=""> User Report</a></li>
         
					<li class="CategoryReport-SubMenu" id="categoryReport" style="display: none;"><a class="" href="<?php echo base_url('reporting/category'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Category Report</a></li>
					
					<li class="UploadsReport-SubMenu" id="uploadsReport" style="display: none;"><a class="" href="<?php echo base_url('uploadedDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Uploaded Documents</a></li>
					
					<li class="EditReport-SubMenu" id="editReport" style="display: none;"><a class="" href="<?php echo base_url('editedDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Document Edit Log</a></li>

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
   document.getElementById('userReport').style.display = "block";
   document.getElementById('categoryReport').style.display = "block";
   document.getElementById('uploadsReport').style.display = "block";
   document.getElementById('editReport').style.display = "block";
}
</script>
