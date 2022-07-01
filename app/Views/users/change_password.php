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

            <h3>Change Password</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="userFormPass" method="post" action="<?php echo base_url('change_password/updatePass'); ?>" enctype="multipart/form-data">
                           
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="pwd">New Password :<span class="asterisk-sign">*</span></label>
                                        <input type="password" name="pwd" class="form-control" id="pwd" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="conpassword">Confirm Password :<span class="asterisk-sign">*</span></label>
                                        <input type="password" name="conpassword" class="form-control" id="conpassword" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>

                           
                            

                            <button type="submit" class="btn btn-info">Save</button>
                            <a href="<?php echo base_url('change_password'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
     // change Password 
    $('#userFormPass').validate({
        rules: {
            pwd: {
                required: true,
            },
            conpassword: {
                required: false,
                equalTo: "#pwd"
            },
        },
        messages: {
            pwd: {
                required: "Please enter Password",
            },
            conpassword: {
                required: "Please enter Confirm Password",
                equalTo: "Password not Match"
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script>

