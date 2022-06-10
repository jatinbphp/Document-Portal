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
                <table id="subaddworkflowTable" class="table table-bordered" cellspacing="0" width="100%" >

                  
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
                            <th style="width: 15%">Action</th>
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
</script>
<script src="<?php echo base_url('assets/js/usersTable.js?v='.time()) ?>"></script>
