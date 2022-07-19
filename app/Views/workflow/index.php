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

    tr.dt-rowReorder-moving {
    outline: 2px solid #555;
    outline-offset: -2px;
    }
   table.table.quickView {
    word-break: break-all;
}
</style>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" />
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" />
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" />
       <link rel="stylesheet" type="text/css" href="../../extensions/Editor/css/editor.dataTables.min.css"> -->

       <!-- Workflow Modal -->
<div class="modal fade" id="workflowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Workflow List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--button type="button" class="btn btn-primary">Save changes</button-->
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
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
                        <div class="col-sm-12 col-md-4">
                            <div class="category-filter">
                                <select id="clientSearchWorkflow" class="form-control" name="clientSearch">
                                    <option value="">Select Clients</option>
                                        <?php if(count($clients) > 0): ?>
                                            <?php foreach($clients as $key => $value): ?>
                                                <option value="<?php //echo $value['companyName'] ?> <?php echo $value['id'] ?>"><?php echo $value['first_name'] .' '. $value['last_name'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>                  
                                 </select>
                            </div>
                        </div>
                     <div><a href = " <?php  echo base_url( '/workflow/wait_approval/') ?>" class="btn btn-primary" style="margin: 0px 5px 5px 0px;padding: 4px 9px;font-size: 14px;" target="_blank">2nd APPROVAL</i></a></div>
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
                            <th style = "width:8%">Start Date</th>
                            <th style = "width:8%">Expire Date</th>
                            <th style = "width:8%">Status</th>
                            <th style = "width:8%">2nd Approval Comments</th>
                            <th style = "width:8%">2nd Approval Status</th>
                            <th style = "width:8%">Action</th>
                             <th style = "width:5%">File</th>
                             <!-- <th style = "width:5%">Approval</th> -->
                             
                            <!-- <th style = "width:8%">Order(Desc)</th> -->
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

 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" />
        <link rel="stylesheet" type="text/css" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">

<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>

<script>
    $(".modalButton").live('click', function(){
        
        var url = '<?php echo base_url('workflow/ajaxpopup');?>';
        var docValue = $(this).data("custom-value");
        //alert(docValue);
        $.ajax({ 
                type: "POST",
                url: url,
                data: { docValue: docValue},
                success: function(response){
                    $('.modal-body').html(response);
                    $('#workflowModal').modal('show'); 
                }
            });  
    });
</script>



