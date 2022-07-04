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

            <h3>Edit Profile</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="userprofileFormAdd" method="post" action="<?php echo base_url('edit_profile/edit'); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="lableTitle"for="email">Email Address:<span class="asterisk-sign">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="off" value="<?php echo $user_info['email']; ?>">
                                        <input type="hidden" name="old_email" id="old_email" value="<?php echo $user_info['email']; ?>">
                                    </div>
                                </div>
                            </div>
                             <input type="hidden" name="id" value="<?php echo $user_info['id']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="firstName">First Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name" value= "<?php echo $user_info['firstName']; ?>">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lastName">Last Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name" value="<?php echo $user_info['lastName'];?>">
                                    </div>
                                </div>
                                
                                
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="pwd">Password :<span class="asterisk-sign"></span></label>
                                        <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Password" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="conpassword">Confirm Password :<span class="asterisk-sign"></span></label>
                                        <input type="password" name="conpassword" class="form-control" id="conpassword" placeholder="Confirm Password" autocomplete="off" value = "">
                                    </div>
                                </div>
                            </div>

                                                          
                            
                            <button type="submit" class="btn btn-info">Save</button>
                            <a href="<?php echo base_url('edit_profile'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>
<script>
    $(document).ready(function(){
            
            
        const myTimeout = setTimeout(myGreeting, 1000);

        function myGreeting() {

                $('#pwd').val('');
                $('#conpassword').val('');
        }
            
    });
</script>



