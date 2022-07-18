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
            <?php 
            $sesVal =  $_SERVER['REQUEST_URI'];
            $ses_id = explode("/",$sesVal);

            $company_id = end($ses_id);

            $db      = \Config\Database::connect();
            $builder = $db->table('Company');
            $builder->select('companyName');
            $builder->where('id', $company_id);
            $queryResult = $builder->get()->getResult('array');
            $company_name = $queryResult[0]['companyName'];
             ?>
            <h3>
                Manage Workflow  <br> <h6> <b>Company Name : </b> <?php echo $company_name;?> </h6><br>
            </h3>
             <div class="item-wrap item-list-table">
                <input type="hidden" value="<?php echo $company_id; ?>" id="company_id_pass">
                <table id="subaddworkflowTable" class="table table-bordered display responsive nowrap" cellspacing="0" width="100%" >

                  
                    <thead class="thead-dark">
                        <tr>
                             
                            <th>Document Name</th>
                            <th>User Type</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Company</th>
                            <th>Comments</th>
                            <th>2nd Approval Comments</th>
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

       $(document).ready(function () {
        new bootstrap.Tooltip(document.body, {
            selector: '.tip'
        });
    });
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
<script src="<?php echo base_url('assets/js/usersTable.js?v='.time()) ?>"></script>
