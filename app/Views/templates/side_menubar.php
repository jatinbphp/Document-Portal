<style>
    ul.accordion .inner {
        overflow: hidden;
        display: none;
    }
    ul.accordion li a.drpdwn {
        position: relative;
    }
    ul.accordion li a.drpdwn:before {
        position: absolute;
        content: "\f078";
        font-family: 'Font Awesome 5 Free';
        font-size: 16px;
        top: 0px;
        right: 12px;
        color: #fff;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    ul.accordion ul.inner {
        overflow: hidden;
        display: none;
        padding: 0px;
        margin: 0px;
        width: 100%;
        list-style-type: none !important;
    }
    ul.accordion li a.drpdwn.active:before {
        transform: rotate(180deg);
    }
    ul.accordion li a.drpdwn.active,
    ul.accordion li a:hover {}

    ul.accordion li a.drpdwn.active::before,
    ul.accordion li a:hover::before {}

    .sidebar-menu ul li.Reporting-Menu.active {
        background: transparent;
    }
    .sidebar-menu ul li.Reporting-Menu.active .inner a {
        background: transparent;
    }
    .sidebar-menu ul li.Reporting-Menu.active a.drpdwn.active, 
    .sidebar-menu ul li.Reporting-Menu.active .inner li.active a {
        background: #343a40;
    }

</style>
<div class="sidebar">
	<div class="sidebar-menu">
		<button type="button" class="menu-close menu-btn d-block d-xl-none"><span class="sr-only">MENU</span></button>
		<ul class="accordion">
            <li class="Dashboard-Menu">
                <a class="" href="<?php echo base_url('dashboard'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">Dashboard</a>
            </li>

            <li class="Users-Menu">
                <a class="" href="<?php echo base_url('users'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt="">Manage Users</a>
            </li>

            <li class="Company-Menu">
                <a class="" href="<?php echo base_url('company'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Company</a>
            </li>

            <li class="Category-Menu">
                <a class="" href="<?php echo base_url('category'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Category</a>
            </li>
                    
            <li class="SubCategory-Menu">
                <a class="" href="<?php echo base_url('subcategory'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Sub Category</a>
            </li>

            <li class="Document-Menu">
                <a class="" href="<?php echo base_url('documents'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Manage Document</a>
            </li>
            
            <li class="AllDocument-Menu">
                <a class="" href="<?php echo base_url('docs'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> All Documents</a>
            </li>
            
            <li class="Reporting-Menu">
                <a class="drpdwn" href="javascript:void(0)"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt=""> Reporting</a>
                <ul class="inner" id="innerUl" >
                    <li class="SubMenu" id="userReport" ><a class="" href="<?php echo base_url('reporting'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt=""> User Report</a></li>
 
                    <li class="SubMenu" id="categoryReport" ><a class="" href="<?php echo base_url('reporting/category'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Category Report</a></li>
                    
                    <li class="SubMenu" id="uploadsReport" ><a class="" href="<?php echo base_url('uploadedDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Uploaded Documents</a></li>
                    
                    <li class="SubMenu" id="editReport" ><a class="" href="<?php echo base_url('editedDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Document Edit Log</a></li>
                    
                    <li class="SubMenu" id="outstandingDocumentsReport" ><a class="" href="<?php echo base_url('outstandingDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Outstanding Documents</a></li>
                    
                    <li class="SubMenu" id="expiredocumentsReport" ><a class="" href="<?php echo base_url('Expired-Documents'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Expired Documents</a></li>
                    
                    <!--li class="SubMenu" id="complianceReport" ><a class="" href="<?php echo base_url('complianceReport'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Compliance Report</a></li-->
                </ul>
            </li>

            <li class="Workflow-Menu">
                <a class="" href="<?php echo base_url('workflow'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Manage Workflow</a>
            </li>
            <li class="OrderWorkflow-Menu">
                <a class="" href="<?php echo base_url('orderdocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Order Documents</a>
            </li>
             <li class="Clients-Menu">
                <a class="" href="<?php echo base_url('clients'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Clients</a>
            </li>

			<!-- <li class="Dashboard-Menu"><a href="<?php echo base_url('dashboard'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-1.png'); ?>" alt="">Dashboard</a></li> -->
				
			<!-- <li class="manageUsers-Menu"><a class="toggle" href="javascript:void(0)" onclick="showDiv()"><img src="<?php echo base_url('assets/images/dash-icon-5.png');?>" alt="">Manage Users</a></li> -->
					
			<!-- <li class="Users-Menu"><a class="" href="<?php echo base_url('users'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-5.png'); ?>" alt="">Manage Users</a></li>
					
            <li class="Company-Menu"><a class="" href="<?php echo base_url('company'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Company</a></li>

            <li class="Category-Menu"><a class="" href="<?php echo base_url('category'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Category</a></li>
            
            <li class="SubCategory-Menu"><a class="" href="<?php echo base_url('subcategory'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Sub Category</a></li>

            <li class="Document-Menu"><a class="" href="<?php echo base_url('documents'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Manage Document</a></li>
            
            <li class="AllDocument-Menu"><a class="" href="<?php echo base_url('docs'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> All Documents</a></li>
            
            <li class="Reporting-Menu"><a class="" href="javascript:void(0)" onclick="showDiv()"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt=""> Reporting</a></li>
            
            <li class="SubMenu" id="userReport" style="display: none;"><a class="" href="<?php echo base_url('reporting'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt=""> User Report</a></li>
 
			<li class="SubMenu" id="categoryReport" style="display: none;"><a class="" href="<?php echo base_url('reporting/category'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Category Report</a></li>
			
			<li class="SubMenu" id="uploadsReport" style="display: none;"><a class="" href="<?php echo base_url('uploadedDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Uploaded Documents</a></li>
			
			<li class="SubMenu" id="editReport" style="display: none;"><a class="" href="<?php echo base_url('editedDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Document Edit Log</a></li>
			
			<li class="SubMenu" id="outstandingDocumentsReport" style="display: none;"><a class="" href="<?php echo base_url('outstandingDocuments'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Outstanding Documents</a></li>
			
			<li class="SubMenu" id="" style="display: none;"><a class="" href="<?php echo base_url('Expired-Documents'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-4.png'); ?>" alt="">Expired Documents</a></li>

            <li class="Workflow-Menu"><a class="" href="<?php echo base_url('workflow'); ?>"><img src="<?php echo base_url('assets/images/dash-icon-9.png'); ?>" alt=""> Manage Workflow</a></li> -->

            <!-- </li> -->

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

        </ul>
	</div>
</div>
<div class="body-overlay"></div>

<!--script>
function showDiv() {
   document.getElementById('userReport').style.display = "block";
   document.getElementById('categoryReport').style.display = "block";
   document.getElementById('uploadsReport').style.display = "block";
   document.getElementById('editReport').style.display = "block";
}
</script-->
<script>
    $('.drpdwn').click(function(e) {
        e.preventDefault();
      
      let $this = $(this);
      $this.parent().parent().find('li a').removeClass('active');
      if ($this.next().hasClass('show')) {
          $this.next().removeClass('show');
          $this.next().slideUp(350);
      } else {
          $this.addClass("active");
          $this.parent().parent().find('li .inner').removeClass('show');
          $this.parent().parent().find('li').removeClass('show');
          $this.parent().parent().find('li .inner').slideUp(350);
          $this.next().toggleClass('show');
          $this.next().slideToggle(350);
      }
    });

    /*$(".Reporting-Menu").click(function() {
        $(".SubMenu").toggle();
        //$('.Reporting-Menu').addClass('active');
    });*/
</script>
