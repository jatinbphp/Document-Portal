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

            <h3>Edit Company</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="companyFormAddEdit" method="post" action="<?php echo base_url('company/edit/'.$company_info['id']); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="companyName">Company Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="companyName" class="form-control" id="companyName" placeholder="User Type Name" value="<?php echo $company_info['companyName']; ?>">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info">Update</button>
                            <a href="<?php echo base_url('company'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".Company-Menu .inner").addClass("show");
    $(".Company-Menu .toggle").addClass("activAcc");
    $(".Company-Menu .inner").css("display", "block")
    $('.Company-Menu .Company-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>