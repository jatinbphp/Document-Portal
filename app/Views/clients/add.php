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

            <h3>Add Clients</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="clientsFormAdd" method="post" action="<?php echo base_url('clients/add'); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="email">Email Address :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Email Address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="first_name">First Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="last_name">Last Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="psw">Password :<span class="asterisk-sign">*</span></label>
                                        <input type="password" name="psw" class="form-control" id="psw" placeholder="Password">
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="conpassword">Confirm Password:<span class="asterisk-sign">*</span></label>
                                        <input type="password" name="conpassword" class="form-control" id="conpassword" placeholder="Conform Password">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="lableTitle"for="is_active">Active/InActive :</label>
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="is_active" class="form-check-input" id="is_active">
                                        <label class="form-check-label" for="is_active">is Active</label>
                                    </div>
                                </div>   
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="<?php echo base_url('clients'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // $(".Clients-Menu .inner").addClass("show");
    // $(".Clients-Menu .toggle").addClass("activAcc");
    // $(".Clients-Menu .inner").css("display", "block")
    $('.Clients-Menu').addClass('active');
</script>
<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>