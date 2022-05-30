<style>
#companySearchTable{display:none}
#companySearchTable_length{display: none;}
#companySearchTable_filter{display: none;}
#documentsTable_info{display: none;}
#documentsTable_paginate{display: none;}
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

            <h3>Manage Documents <a class="btn btn-info" style="float: right;" href="<?php echo base_url('userDocuments/add'); ?>">Upload Documents</a></h3>

            <div class="item-wrap item-list-table">
                <table id="documentsTable" class="table table-bordered" cellspacing="0" width="100%" >
<!-- 
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
                    
                        <div class="col-sm-12 col-md-4">
                            <div class="category-filter">
                                <select id="userSearch" class="form-control" name="userSearch">
                                    <option value="">Select User</option>
                                   
                                    <?php if(count($users) > 0): ?>
                                        <?php foreach($users as $key => $value): ?>
                                            <option value="<?php //echo $value['companyName'] ?> <?php echo $value['id'] ?>"><?php echo $value['firstName']." ".$value['lastName'] ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    
                                 </select>
                            </div>
                        </div>
                    </div> -->
                    <thead class="thead-dark">
                        <tr>
                            <th>Download File</th>
                            <th>Document Name</th>
                            <th>User Name</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Company</th>
                            <th>Expire Date</th>
                            <th>Status</th>
                            <th style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="item-wrap item-list-table comapanyData">
                <table id="companySearchTable" class="table table-bordered" cellspacing="0" width="100%" >

                   
                    <thead class="thead-dark">
                       <tr>
                            <th>Photo</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Company</th>
                            <th>Date</th>
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
    $('.Document-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersDataTable.js') ?>"></script>


