<style type="text/css">
    .mb-0 > a {
    display: block;
    position: relative;
    }
    .mb-0 > a:after {
    content: "\f078"; /* fa-chevron-down */
    font-family: 'FontAwesome';
    position: absolute;
    right: 0;
    }
    .mb-0 > a[aria-expanded="true"]:after {
    content: "\f077"; /* fa-chevron-up */
    }

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
            <h3>
                Manage Workflow
            </h3>
             <div class="item-wrap item-list-table">
                <input type="hidden" value="<?php echo $company_id; ?>" id="company_id_pass">
                <table id="ceoworkflowTable" class="table table-bordered display responsive nowrap" cellspacing="0" width="100%" >

                  
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
                            <th>Status</th>
                            <th style="width: 15%">Approval</th>
                        </tr>
                    </thead>
                         
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    // $(".manageDocuments-Menu .inner").addClass("show");
      // $(".manageDocuments-Menu .toggle").addClass("activAcc");
      // $(".manageDocuments-Menu .inner").css("display", "block")
      $('.AllDocument-Menu').addClass('active');

       $(document).ready(function () {
        new bootstrap.Tooltip(document.body, {
            selector: '.tip'
        });
    });
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<script src="<?php echo base_url('assets/js/usersTable.js?v='.time()) ?>"></script>
 <form id="waitingApprovalCeoForm" method="post" action="<?php echo base_url('ceoview/update'); ?>" enctype="multipart/form-data">
<div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Approval</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="lableTitle"for="comments"> Comments :<span class="asterisk-sign">*</span></label>

                    <textarea name="comments" id ="comments" ></textarea>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">

                                    <label class="lableTitle"for="sec_approval_status">Approval :<span class="asterisk-sign">*</span></label>
                                    <div class="form-group form-check pl-0">
                                       <p class= "apperr">
                                        <input type="radio" id="sec_approval_status" name="sec_approval_status" value="1">
                                        <label for="sec_approval_status">APPROVE</label>
                                        <input type="radio" id="sec_approval_status" name="sec_approval_status" value="2">
                                        <label for="sec_approval_status">REJECT</label><br>
                                       </p>

                                    </div>
                               
                    
                </div>
            </div>
        </div>
        <input type="hidden" name="getId" id = "getId" value= "">
            
     
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary savebtn">Save</button> -->
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
 </form>
<script>
  
  function show_dialog(id = ''){
    $("#getId").val(id);
  }
</script>
<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>