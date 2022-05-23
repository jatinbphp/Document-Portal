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

            <h3>Edit Customers</h3>

            <div class="item-wrap item-list-table">

                <div class="card">
                    <div class="card-body">
                        <form id="customerFormEdit" method="post" action="<?php echo base_url('customers/edit/'.$user_info['id']); ?>" enctype="multipart/form-data">
                            <div class="row">
                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="email">Email Address :<span class="asterisk-sign">*</span></label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $user_info['email']; ?>">
                                        <input type="hidden" name="old_email" id="old_email" value="<?php echo $user_info['email']; ?>">
                                    </div>

                                </div>
                                <?php $new_date = date('Y-m-d', strtotime($user_info['dateadd']));?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="dateadd">Birth Date: <span class="asterisk-sign"></span></label>
                                        <input type="date" name="dateadd" class="form-control" id="dateadd" placeholder="Date" value="<?php echo $new_date; ?>">
                                    </div>
                                </div>
                                
                            </div>
                       
                            <input type="hidden" name="id" value="<?php echo $user_info['id']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="firstName">First Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name" value="<?php echo $user_info['firstName']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lastName">Last Name :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name" value="<?php echo $user_info['lastName']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label class="lableTitle"for="billadd">Billing Address :<span class="asterisk-sign">*</span></label>
                                       <textarea name="billadd" class="form-control" id="billadd" placeholder="Billing Address"> <?php echo $user_info['billadd']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="lableTitle"for="shipadd">Shipping Address :<span class="asterisk-sign">*</span></label>
                                       <textarea name="shipadd" class="form-control" id="shipadd" placeholder="Shipping Address"> <?php echo $user_info['shipadd']; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="lsorder">Last Order :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="lsorder" class="form-control" id="lsorder" placeholder="Last Order" value="<?php echo $user_info['lsorder']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="totalsp">Total Spent :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="totalsp" class="form-control" id="totalsp" placeholder="Total Spent" value="<?php echo $user_info['totalsp']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="lableTitle"for="avgorder">Average Order Value :<span class="asterisk-sign">*</span></label>
                                        <input type="text" name="avgorder" class="form-control" id="avgorder" placeholder="Average Order Value" value="<?php echo $user_info['avgorder']; ?>">
                                    </div>
                                </div>
                            </div>


                       

                            <button type="submit" class="btn btn-info">Update</button>
                            <a href="<?php echo base_url('customers'); ?>" type="button" class="btn btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".manageCustomers-Menu .inner").addClass("show");
    $(".manageCustomers-Menu .toggle").addClass("activAcc");
    $(".manageCustomers-Menu .inner").css("display", "block")
    $('.manageCustomers-Menu .Customers-Menu').addClass('active');

    function removeImg(img_name, user_id)
    {
        swal({
                title: "Are you sure?",
                text: "Delete User Image",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: "No, cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            },
        function(isConfirm) {
            if (isConfirm) {
                window.location.href = '<?php echo base_url("customers/deleteImg"); ?>'+'/'+img_name+'/'+user_id;
            } else {
                swal("Cancelled", "Your data safe!", "error");
            }
        });
    }
</script>
<script src="<?php echo base_url('assets/js/adminFormValidation.js') ?>"></script>