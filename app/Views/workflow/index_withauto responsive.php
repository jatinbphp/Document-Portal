<style>
    table.dataTable tbody td .commentAdd {
        width: 100%;
        max-width: 100px;
        min-width: 100px;
        display: block;
        white-space: nowrap;
        line-clamp: 3;
        -webkit-line-clamp: 3;
        -moz-line-clamp: 3;
        -ms-line-clamp: 3;
        -o-line-clamp: 3;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0px;
    }
    table.dataTable tbody td, table.dataTable tbody td .commentAdd {
        transition: all .4s ease-in-out;
    }
    /*table.dataTable tbody td.sorting_1:hover {
        white-space: unset;
    }*/
</style>
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
            

            <div class="item-wrap item-list-table table-responsive">
                <table id="workflowTable" class="table table-bordered display responsive nowrap" cellspacing="0" width="100%" >

                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="category-filter">
                                <select id="companySearchWorkflow" class="form-control" name="companySearch">
                                    <option value="">Select Company</option>
                                        <?php if(count($company) > 0): ?>
                                            <?php foreach($company as $key => $value): ?>
                                                <option value="<?php //echo $value['companyName'] ?> <?php echo $value['id'] ?>"><?php echo $value['companyName'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>                  
                                 </select>
                            </div>
                        </div>
                    
                    </div>

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
                            
                            <th style = "width:8%">Document Name</th>
                            <th style = "width:5%">User Type</th>
                            <th style = "width:8%">Category</th>
                            <th style = "width:8%">Sub Category</th>
                            <th style = "width:8%">Company</th>
                            <th style = "width:4%">Comments</th>
                            <!-- <th style = "width:8%">Start Date</th> -->
                            <th style = "width:8%">Expire Date</th>
                            <th style = "width:8%">Status</th>
                            <th style = "width:8%">Action</th>
                             <th style = "width:5%">File</th>
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

     // Tooltips
    $(document).ready(function () {
        new bootstrap.Tooltip(document.body, {
            selector: '.tip'
        });
    });
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>



