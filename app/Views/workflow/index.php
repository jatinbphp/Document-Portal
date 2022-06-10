<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">

            <?php if(session()->has('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo session()->getFlashdata('success'); ?>
            </div>
            <?php elseif(session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo session()->getFlashdata('error'); ?>
            </div>
            <?php endif; ?>
            <?php if($_SESSION['user_type'] ==0){ ?>
                <h3>Manage Workflow <a class="btn btn-info" style="float: right;" href="<?php echo base_url('workflow/add'); ?>">Add Workflow</a></h3>
         <?php   } ?>
            

            <div class="item-wrap item-list-table">
                <table id="workflowTable" class="table table-bordered" cellspacing="0" width="100%" >

                   <?php if($_SESSION['user_type'] == 3) { ?>
                    <thead class="thead-dark">
                        <tr>
                             
                            <th>Document Name</th>
                            <th>User Type</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Company</th>
                            <th>Comments</th>
                            <th>Start Date</th>
                            <th>Expire Date</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                    </thead>
                  <?php  }else{ ?>
                     <thead class="thead-dark">
                        <tr>
                            
                            <th style = "width:10%">Document Name</th>
                            <th style = "width:5%">User Type</th>
                            <th style = "width:10%">Category</th>
                            <th style = "width:10%">Sub Category</th>
                            <th style = "width:10%">Company</th>
                            <th style = "width:10%">Comments</th>
                            <th style = "width:10%">Start Date</th>
                            <th style = "width:10%">Expire Date</th>
                            <th style = "width:10%">Status</th>
                            <th style = "width:10%">Action</th>
                             <th style = "width:5%">file</th>
                            <!--  <th>Document file</th> -->
                        </tr>
                    </thead>
                 <?php }?>
                   
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
  // $(".manageDocuments-Menu .inner").addClass("show");
    // $(".manageDocuments-Menu .toggle").addClass("activAcc");
    // $(".manageDocuments-Menu .inner").css("display", "block")
    $('.Workflow-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>


