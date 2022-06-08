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

            <h3>Expired Documents <!--a class="btn btn-info" style="float: right;" href="<?php echo base_url('workflow/add'); ?>">Add Workflow</a--></h3>

            <div class="item-wrap item-list-table">
                <table id="expiredDocumentsTable" class="table table-bordered" cellspacing="0" width="100%" >
					
					<div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="category-filter">
                                <select id="companySearch" class="form-control" name="companySearch">
                                    <option value="">Select Company</option>
                                    <?php if(count($company) > 0): ?>
                                        <?php foreach($company as $key => $value): ?>
                                            <option value="<?php //echo $value['companyName'] ?> <?php echo $value['id'] ?>"><?php echo $value['companyName'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                 </select>
                            </div>
                        </div>

                   
                    <thead class="thead-dark">
                        <tr>
                             <th>Document file</th>
                            <th>Document Name</th>
                            <th>User Type</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Company</th>
                            <th>Comments</th>
                            <th>Expire Date</th>
                            <!--th style="width: 15%">Action</th-->
                        </tr>
                    </thead>
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
    $('.Reporting-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersTable.js') ?>"></script>


