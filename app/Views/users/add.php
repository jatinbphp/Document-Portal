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

            <h3>Add Users</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="userFormAdd" method="post" action="<?php echo base_url('users/add'); ?>" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="userTypeID">User Type :<span class="asterisk-sign">*</span></label>
                                        <select name="userTypeID" id="userTypeID" class="form-control" REQUIRED>
                                            <option value="">-- Select User Type --</option>
                                            
                                            <?php if(count($user_types)>0): ?>
                                                <?php foreach ($user_types as $key => $value): ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['userTypeName']; ?></option>
                                                <?php endforeach; ?>
                                               <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="email">Email Address:<span class="asterisk-sign">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="firstName">First Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lastName">Last Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="companyId ">Company :<span class="asterisk-sign">*</span></label>
                                         <!--select name="companyId" id="companyId" class="form-control" REQUIRED-->
                                         <select id="companyId" class="js-states form-control" name="companyId[]" multiple>
                                            <!--option value="">-- Select All --</option-->
                                            <?php 
                                            if(count($company)>0){
                                                foreach ($company as $key => $value) { ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['companyName']; ?></option>
                                                <?php
                                                }
                                            } ?>
                                        </select>
                                        <span id="errorToShow"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="pwd">Password :<span class="asterisk-sign">*</span></label>
                                        <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="conpassword">Confirm Password :<span class="asterisk-sign">*</span></label>
                                        <input type="password" name="conpassword" class="form-control" id="conpassword" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="profilePic">User Photo : </label>
                                        <span>(We accept .JPG / .PNG / .GIF / .JPEG)</span>
                                        <div class="kv-avatar">
                                            <div class="file-loading">
                                                <input id="profilePic" name="profilePic" type="file" accept="image/*">
                                            </div>
                                            </br>
                                            <?php
                                            $img_thumnail = '';
                                            $img_thumnail = base_url('assets/images/default.png'); ?>

                                            <img style="border: 1px solid #eee; padding: 5px;" id="thumbnail_img" width="100" height="100" src="<?php echo $img_thumnail; ?>">
                                        </div>
                                        <label class="lableTitle"id="image-error" class="error" for="profilePic"></label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="lableTitle"for="username">Active/InActive :</label>
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="isActive" class="form-check-input" id="isActive">
                                        <label class="form-check-label" for="isActive">is Active</label>
                                    </div>
                                </div>                     
                            </div>                                
                            
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="<?php echo base_url('users'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/usersFormValidation.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    // $(".manageUsers-Menu .inner").addClass("show");
    // $(".manageUsers-Menu .toggle").addClass("activAcc");
    // $(".manageUsers-Menu .inner").css("display", "block")
    $('.Users-Menu').addClass('active');
</script>
<script>
	$("#companyId").select2({
			  placeholder: "-- Select Company --",
			  allowClear: true		  
	});	  
</script>

