<style>
	.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
    margin-top: 50px;
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

            <div class="item-wrap item-list-table">
            	 <form id="workflowFormApprove" method="post" action="<?php echo base_url('workflow/approve_company/'.$id); ?>" enctype="multipart/form-data">
                
				   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="lableTitle"for="company_id">Company :<span class="asterisk-sign">*</span></label>
                            <select name="company_id" id="company_id" class="form-control" REQUIRED>
                                <option value="">-- Select Company --</option>
                                <?php 
                                    if(count($company)>0){
                                        foreach ($company as $key => $value) { ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['companyName']; ?></option>
                                <?php
                                    }
                                    } ?>
                            </select>
                        </div>
                    </div>
 				

                    
                    <div class=" justify-content-end mt-4">
                        <button type="submit" class="btn btn-info savebtn">NEXT STEP</button>
                        <a href="<?php echo base_url('workflow'); ?>" type="button" class="btn btn-warning">Back</a>
                    </div>
    
  				</form>
            </div>

        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>
